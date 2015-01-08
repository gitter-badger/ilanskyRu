<?php

class GalleryImages extends \Eloquent {

    protected $table = 'gallery_images';
    protected $softDelete = true;

    ### Нормализация связей
    public function ref()
    {
        return $this->morphTo();
    }

    public function textref() {
        if ($this->ref_type == '' and $this->ref_id == '') {
            return 'Фотография не связана';
        } elseif ($this->ref_type == 'GalleryAlbums') {
            return 'Альбом: '.$this->ref->name;
        }
    }

    public function user() {
        return $this->belongsTo('User','user_id');
    }

    public static function getValidationImage() {
        $validation = array(
            'album' => array(
                'required',
                'integer'
            ),
            'image' => array(
                'required',
                'image'
            )
        );
        return $validation;
    }

    public static function getEditValidation() {
        $validation = array(
            'album' => array(
                'integer'
            )
        );
        return $validation;
    }

    public static function MassValidation() {
        $validation = array(
            'action'        => array(
                'required',
                'regex:/^[a-z-]+/'
            ),
            'image_indx'    => array(
                'required',
                'array'
            )
        );
        return $validation;
    }

    public static function GoMassValid() {
        $validation = array(
            'act'    => array(
                'required',
                'regex:/^[a-z-]+/'
            ),
            'images'    => array(
                'required',
                'regex:/^[0-9|]+/'
            ),
            'album'     => array(
                'integer'
            )
        );
        return $validation;
    }

    public static $dirs = array(
        'small',
        'preview',
        'original'
        );

    public static $seite = array(
        '0'     =>  'По наибольшей стороне',
        '1'     =>  'По ширине',
        '2'     =>  'По высоте'
    );

    public static $weatermark_pos = array(
        'top-left'      =>  'Верхний левый угол',
        'top'           =>  'Вверху',
        'top-right'     =>  'Верхний правый угол',
        'left'          =>  'Слева',
        'center'        =>  'По центру',
        'right'         =>  'По правому краю',
        'bottom-left'   =>  'Левый нижний угол',
        'bottom'        =>  'Внизу',
        'bottom-right'  =>  'Правый нижний угол'
    );

    public static $denied_mime = array(
        'image/bmp'
    );

    public static $actions  = array(
        'move-album'    =>  'Связать фотографии с фотоальбомом',
        'move-dossier'  =>  'Связать фотографии с досье'
    );

    public function ExternalPath($type = 'small') {
        return '/uploads/gallery/'.$type.'/'.date_format($this->created_at,'Y-m').'/'.$this->file;
    }

    public function DownloadLink() {
        return URL::route('download',array(
            'class' => 'gallery',
            'hash'  => Crypt::encrypt($this->file)
        ));
    }

    public function InternalPach($type = 'small') {
        return public_path().'/uploads/gallery/'.$type.'/'.date_format($this->created_at,'Y-m').'/'.$this->file;

    }
    # Во избежание Exception в админке
    public function GetIdAlbum() {
        ($this->album_id == '') ? $res = 0 : $res = $this->album->id;
        return $res;
    }

    public static function InitDirs()
    {
        foreach (self::$dirs as $dir) {
            if (!file_exists(public_path() . '/uploads/gallery/' . $dir . '/' . date('Y-m'))) {
                mkdir(public_path() . '/uploads/gallery/' . $dir . '/' . date('Y-m'), 0777, true);
                $indx = fopen(public_path() . '/uploads/gallery/' . $dir . '/' . date('Y-m') . '/index.html', 'w');
                fclose($indx);
            }
        }
        return null;
    }

    public static function ImgProcess   (
                                        \Intervention\Image\Image   $img,
                                        array                       $option_size,
                                                                    $option_side = 0,
                                                                    $watermark = true
                                        )
    {
        $width = $img->width();
        $heigth = $img->height();
        if ($option_size[0] != 0) {
            # Если размер указан как 100х100
            if (is_numeric($option_size[0]) and array_key_exists(1, $option_size) and is_numeric($option_size[1]) and (($option_size[0] < $width) or ($option_size[1] < $heigth))) {
                # По какой стороне сжимать?
                switch ($option_side) {
                    # По наибольшей стороне
                    case 0:
                        if ($width >= $heigth) {
                            $img->resize($option_size[0], null, function ($constraint) {
                                $constraint->aspectRatio();
                            });
                        } else {
                            $img->resize(null, $option_size[1], function ($constraint) {
                                $constraint->aspectRatio();
                            });
                        }
                        break;
                    # По ширине
                    case 1:
                        $img->resize($option_size[0], null, function ($constraint) {
                            $constraint->aspectRatio();
                        });
                        break;
                    # По высоте
                    case 2:
                        $img->resize(null, $option_size[1], function ($constraint) {
                            $constraint->aspectRatio();
                        });
                        break;
                }
            }
            #Если размер задан одной стороной
            elseif (is_numeric($option_size[0]) and !array_key_exists(1, $option_size) and (($option_size[0] < $width) or ($option_size[0] < $heigth))) {
                # По какой стороне сжимать?
                switch ($option_side) {
                    # По наибольшей стороне
                    case 0:
                        if ($width >= $heigth) {
                            $img->resize($option_size[0], null, function ($constraint) {
                                $constraint->aspectRatio();
                            });
                        } else {
                            $img->resize(null, $option_size[0], function ($constraint) {
                                $constraint->aspectRatio();
                            });
                        }
                        break;
                    # По ширине
                    case 1:
                        $img->resize($option_size[0], null, function ($constraint) {
                            $constraint->aspectRatio();
                        });
                        break;
                    # По высоте
                    case 2:
                        $img->resize(null, $option_size[0], function ($constraint) {
                            $constraint->aspectRatio();
                        });
                        break;
                }
            }
        }
        # Получаем новые ширину\высоту после изменения размера
        $width = $img->width();
        $heigth = $img->height();
        # Наложение водяного знака
        if ($watermark) {
            # Разрешено накладывать водяной знак
            # Получаем настройку минимальной длины\ширины изображения для наложения водяного знака
            $min = Options::get_option('img_min_watermark');
            $watermark_pos = Options::get_option('img_pos_watermark');
            if (($min <= $width) or ($min <= $heigth)) {
                $img->insert(public_path().'/uploads/gallery/watermark.png',$watermark_pos,3,3);
            }
        }
        return $img;
    }

    public static function SaveImage($tmppath, $filename, $watermark = true) {
        self::InitDirs();
        # Надо разобрать первую настройку и понять, нужно ли сжимать изображение
        # Для каждой настройки необходим анализ максимального разрешения, наложение водяного знака и т.д.
        # Раюотаем с оригинальным изображением
        $result = array();
        $quality = Options::get_option('img_jpeg_quality');
        # Оригинал
        $img = Image::make($tmppath)->orientate();
        $max_up_side = explode('x',Options::get_option('img_max_up_side'),2);
        $o_seite = (int)Options::get_option('img_o_seite');
        $img = self::ImgProcess($img,$max_up_side,$o_seite,$watermark);
        $result['height']   = $img->height();
        $result['width']    = $img->width();
        $img->save(public_path().'/uploads/gallery/original/'.date('Y-m').'/'.$filename,$quality);
        $result['size']     =  filesize(public_path().'/uploads/gallery/original/'.date('Y-m').'/'.$filename);
        $img->destroy();
        # Среднее превью
        $img = Image::make($tmppath)->orientate();
        $preview_up_side = explode('x',Options::get_option('img_preview_up_side'),2);
        $t_seite = (int)Options::get_option('img_t_seite');
        $img = self::ImgProcess($img,$preview_up_side,$t_seite,$watermark);
        $img->save(public_path().'/uploads/gallery/preview/'.date('Y-m').'/'.$filename,$quality);
        $img->destroy();
        # Малое превью
        $img = Image::make($tmppath)->orientate();
        $small_up_side = explode('x',Options::get_option('img_small_up_side'),2);
        $img = self::ImgProcess($img,$small_up_side,$t_seite,$watermark);
        $img->save(public_path().'/uploads/gallery/small/'.date('Y-m').'/'.$filename,$quality);
        $img->destroy();

        return $result;
    }

}