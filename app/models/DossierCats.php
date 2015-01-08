<?php

class DossierCats extends \Eloquent {
	protected $fillable = [];
    protected $table = 'dossier_cats';

    ### Нормализация связей

    public function dossiers() {
        return $this->hasMany('Dossier','cat_id');
    }

    public static function getValidatorAddCat() {
        $rules = array(
            'name'  => array(
                'min:5',
                'required',
                'regex:/^[^0-9\p{Cyrillic}]+/',
                'unique:dossier_cats'
            ),
            'slug'  => array(
                'regex:/^[^a-zA-Z-_]+/'
            )
        );
        return $rules;
    }
    public static function getValidatorEditCat() {
        $rules = array(
            'name'  => array(
                'min:5',
                'required',
                'regex:/^[^0-9\p{Cyrillic}]+/',
            ),
            'slug'  => array(
                'regex:/^[a-zA-Z-_]+/'
            )
        );
        return $rules;
    }
}