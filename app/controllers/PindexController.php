<?php
/**
 * Created by PhpStorm.
 * User: savenkoff
 * Date: 28.09.14
 * Time: 23:51
 */
class PindexController extends BaseController {
    #Вывод главной страницы
    public function getIndex() {
        return View::make('frontend.index');
    }
    #Скачивание файла со скрытием пути оригинального месторасположения
    public function getDownloadFile($class = null, $hash = null) {
        $referer = Request::server('HTTP_REFERER');
        try {
            $filename = Crypt::decrypt($hash);
        }
        catch(Illuminate\Encryption\DecryptException $e) {
            null;
        }
        if (isset($class) && isset($hash) && isset($referer) && (substr_count($referer,URL::route('index')) != 0) && isset($filename)) {
            switch ($class) {
                case 'gallery':
                    $image_obj = GalleryImages::where('file','=',$filename)->first();
                    if (!$image_obj) { break; }
                    $full_path = $image_obj->InternalPach('original');
                    if (!file_exists($full_path)) {
                        return $this->getMessage('Запрашиваемый файл не существует. Администрация сайта уже в курсе существования данной пробелмы. В ближайшее время проблема будет исправлена. ', URL::previous());
                    }
                    $image_obj->downloads++;
                    $image_obj->save();
                    header('Content-Description: File Transfer');
                    header('Content-Type: '.$image_obj->mime);
                    header('Content-Disposition: attachment; filename="ilansky_ru_'.$image_obj->file.'"');
                    header('Content-Transfer-Encoding: binary');
                    header('Expires: 0');
                    header('Cache-Control: must-revalidate');
                    header('Pragma: public');
                    header('Content-Length: ' . filesize($full_path));
                    readfile($full_path);
                    break;
            }
        }
        return $this->getMessage('Ссылка для загрузки файла неверна. <br/>
                                    Возможно Вы попытались скачать файл со стороннего сайта, либо файл был удаен. <br/>
                                    Если ошибка повторяется - свяжитесь с Администрацией по e-mail: daniil@savenkoff.com, указав в письме адрес ссылки для загрузки файла.',URL::previous());
    }
}
