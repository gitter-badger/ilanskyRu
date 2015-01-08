<?php

class DossierController extends \BaseController {
    public function getIndex() {
        return View::make('frontend.dossier.index',array(
            'count'     => Dossier::remember(Options::get_option('db_cache'))->count(),
            'alphabet'  => Dossier::alphabet(),
            'cats'      => DossierCats::remember(Options::get_option('db_cache'))->get()
        ));
    }
    public function getAlpha($alpha) {

    }
}