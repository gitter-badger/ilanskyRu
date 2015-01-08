<?php

class GalleryController extends \BaseController {

public function getIndex($album = null) {
        ################
        # Галерея в бесконечное кол-во страниц
        ###############
        $images = GalleryImages::has('album')->with(array(
            'album' => function($query) {
                $query->where('is_system','=','0');
            }
        ))->orderBy('created_at','desc')->remember(Options::get_option('db_cache'))->paginate(Options::get_option('img_cnt'));

        $albums = array();
        foreach($images as $image) {
            if (!array_key_exists($image->album->id,$albums)) {
                $albums[$image->album->id] = $image->album;
            }
        }
        return View::make('frontend.gallery.gallery', array(
            'navigate'      => $albums,
            'images'        => $images
        ));
    }

    public function AjaxUpload() {
        if (Request::all()) {
            print_r(Input::all());
        }
        echo 0;
    }

}