<?php

class Role extends Eloquent {

    protected $table = 'roles';
    protected $softDelete = true;
    protected $guarded = array(
        'id',
        'created_at',
        'updated_at',
        'deleted_at',
        'isDistrib'
    );
    protected $fillable = array(
        'name',
        'lat_name'
    );

    public function users()
    {
        return $this->belongsToMany('User')->withTimestamps();
    }

    public function resources() {
        return $this->belongsToMany('Resource')->withTimestamps();
    }
    #######################
    # Валидация
    #######################
    public static function getValidateAddRole() {
        $validation = array(
            'name'  => array(
                'required',
                'unique:roles',
                'regex:/^[A-Za-zА-Яа-я]/',
                'min:3'
            ),
            'lat_name'  => array(
                'regex:/^[A-Za-z]/'
            )
        );
        return $validation;
    }

}