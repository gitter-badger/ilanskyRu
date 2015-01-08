<?php

class Options extends \Eloquent {
	protected $fillable = [];
    protected $table = 'options';

    public static function getValidate() {
        $validation = array(
            'options.title'        => array(
                'min:5',
                'required',
                'regex:/^[А-Яа-яA-Za-z:-|]/'
            ),
            'options.description'  => array(
                'min:5',
                'regex:/^[А-Яа-яA-Za-z:-|,]/'
            ),
            'options.keywords'     => array(
                'min:5',
                'regex:/^[А-Яа-яA-Za-z:-|,]/'
            ),
            'options.skin'         => array(
                'required',
                'regex:/^[a-z]/'
            ),
            'options.img_max_up_side' => array(
                'required',
                'regex:/^[0-9a-z]/'
            ),
            'options.img_o_seite'   => array(
                'required',
                'integer'
            ),
            'options.img_allow_watermark'=> array(
                'boolean'
            ),
            'options.img_min_watermark' => array(
                'regex:/^[0-9a-z]/'
            ),
            'options.img_small_up_side' => array(
                'required',
                'regex:/^[0-9a-z]/'
            ),
            'options.img_preview_up_side'=>array(
                'required',
                'regex:/^[0-9a-z]/'
            ),
            'options.img_t_seite'       => array(
                'required',
                'integer'
            ),
            'options.img_jpeg_quality'  => array(
                'required',
                'integer'
            ),
            'options.img_pos_watermark' => array(
                'required',
                'regex:/^[a-z-]/'
            ),
            'options.img_indx_gallery'  => array(
                'required',
                'integer'
            ),
            'options.db_cache'          => array(
                'required',
                'integer',
                'min:0',
                'max:60'
            ),
            'options.img_cnt'           => array(
                'required',
                'integer',
                'min:4',
                'max:40'
            ),
            'options.dos_indx_gallery'  => array(
                'required',
                'integer'
            ),
            'options.dos_max_up_side'   => array(
                'required',
                'regex:/^[0-9a-z]/'
            ),
            'options.dos_o_seite'       => array(
                'required',
                'integer'
            ),
            'options.dos_t_seite'       => array(
                'required',
                'integer'
            ),
            'options.dos_preview_up_side'=>array(
                'required',
                'regex:/^[0-9a-z]/'
            ),
            'options.dos_small_up_side' => array(
                'required',
                'regex:/^[0-9a-z]/'
            )
        );
        return $validation;
    }

    public static $options = array(
        'title',
        'description',
        'keywords',
        'skin',
        'db_cache',
        'img_max_up_side',
        'img_o_seite',
        'img_allow_watermark',
        'img_min_watermark',
        'img_small_up_side',
        'img_preview_up_side',
        'img_t_seite',
        'img_jpeg_quality',
        'img_pos_watermark',
        'img_indx_gallery',
        'img_cnt',
        'dos_indx_gallery',
        'dos_max_up_side',
        'dos_o_seite',
        'dos_t_seite',
        'dos_small_up_side'
    );

    public static $skin     = array(
        'blue'  =>  'Голубой',
        'cocoa' =>  'Какао',
        'green' =>  'Зелёный',
        'orange'=>  'Оранжевый',
        'pink'  =>  'Розовый',
        'purple'=>  'Пурпурный',
        'red'   =>  'Красный',
        'yellow'=>  'Желтый'
    );

    public static $alphabet = 'А Б В Г Д Е Ж З И К Л М Н О П Р С Т У Ф Х Ц Ч Ш Щ Ы Э Ю Я A B C D E F G H I J K L M N O P Q R S T U V W X Y Z 0 1 2 3 4 5 6 7 8 9';

    public static function get_option($key, $exception = true) {
        if (Cache::has($key)) {
            return Cache::get($key);
        }
        else {
            $option = Options::where('option','=',$key)->first();
            if (!$option) {
                if (!$exception) {
                    return null;
                }
                else {
                    App::abort('500','Не найдена настройка с кодом '.$key.'.');
                }
            }
            Cache::forever($key,$option->value);
            return $option->value;
        }
    }

    public static function set_option($key,$value) {
        if (Cache::has($key)) {
            Cache::forget($key);
        }
        $option = Options::where('option','=',$key)->first();
        if (!$option) {
            $option = new Options();
            $option->option = $key;
            $option->value  = $value;
            $option->save();
        }
        else {
            $option->value  = $value;
            $option->save();
        }
        Cache::forever($key,$value);
        return null;
    }

    public static function Title($text, $size = 100) {
        $len = strlen($text);
        if ($len < $size) {
            return $text;
        } else {
            return mb_substr($text,0,33, 'UTF-8');
        }
    }
}