<?php
/**
 * Created by PhpStorm.
 * User: savenkoff
 * Date: 20.10.14
 * Time: 18:37
 */
class Resource extends Eloquent {
    protected $table = 'resource';
    protected $softDelete = true;
    protected $guarded = array(
        'id',
        'created_at',
        'updated_at',
        'deleted_at'
    );

    function roles() {
        return $this->belongsToMany('Role')->withTimestamps();
    }

    function users() {
        return $this->belongsToMany('User')->withTimestamps();
    }

    public static function isValidArray() {
        $validation = array(
            'secure'    => array(
                'array'
            )
        );
        return $validation;
    }
    public static function getValidationSaveResource() {
        $validation = array(
            'rus_name'  => array(
                'regex:/^[А-Яа-я:-]/',
                'min:5'
            ),
            'secure'    => array(
                'numeric'
            )
        );
        return $validation;
    }
}