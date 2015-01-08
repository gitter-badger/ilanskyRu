<?php

class Dossier extends \Eloquent {
	protected $fillable = [];
    protected $table = 'dossier';
    protected $softDelete = true;

    ### Нормализация связей

    public function user() {
        return $this->belongsTo('User', 'author_id');
    }

    public function cat() {
        return $this->belongsTo('DossierCats','cat_id');
    }

    public function photos()  {
        return $this->morphMany('GalleryImages', 'ref');
    }

    public static function alphabet() {
        $alphabet = explode(' ',Options::$alphabet);
        foreach ($alphabet as $k => $v) {
            $cat[$k] = "<a href=".URL::route('dossier-alpha',$v)." data-toggle=\"tooltip\" data-placement=\"top\" data-original-title=\"Досье на литеру «".$v."»\"><button type=\"button\" class=\"btn btn-primary btn-xs\">".$v."</button></a>";
        }
        $ret = implode(' ',$cat);
        return $ret;
    }

    public static function getValidationDossier() {
        $rules = array(
            'name'  => array(
                'min:5',
                'max:255',
                'required',
                'regex:/^[^0-9\p{Cyrillic}]+/',
            ),
            'slug'  => array(
                'min:1',
                'max:255',
                #'regex:/^[^a-z-_]+/'
            ),
            'cat'   => array(
                'required',
                'integer'
            ),
            'alpha' => array(
                'size:1',
                'regex:/^[^a-zA-Z-_]+/'
            ),
            'short' => array(
                'required',
                'min:10',
                'max:255',
                'regex:/^[^0-9\p{Cyrillic}]+/',
            ),
            'content'   => array(
                'required',
                'min:100',
                #'regex:/^[^0-9\p{Cyrillic}]+/',
            ),
            'web'   => array(
                'url'
            )
        );
        return $rules;
    }
    # Полная ссылка на досье
    public function GetFullLink() {
        return URL::route('dossier',array($this->cat->slug,$this->id.'-'.$this->slug));
    }

    public function GetImage() {
        return '/theme/img/dossiers/no_photo.png';
    }

    public function MySave() {
        $this->name     = Input::get('name');
        (Input::get('slug') == '')  ? $this->slug = Slug::make(Input::get('name'))                                          : $this->slug   = Input::get('slug');
        (Input::get('alpha') == '') ? $this->alpha = substr(preg_replace('/[^a-zA-ZА-Яа-я]/', '', Input::get('name')),0,1)  : $this->alpha  = Input::get('alpha');
        $this->short    = Input::get('short');
        $this->content  = Input::get('content');
        $this->web      = Input::get('web');
        $this->cat_id   = Input::get('cat');
        ($this->author_id == '')    ? $this->author_id= Auth::user()->id                                                    : null;
        $this->save();
    }

}