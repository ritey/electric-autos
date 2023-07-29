<?php

namespace CoderStudios\Models;

use Illuminate\Database\Eloquent\Model;

class Packages extends Model
{

    /**
    * The database connection used with the model.
    *
    * @var  string
    */
    protected $connection = 'mysql';

    /**
    * The table associated with the model.
    *
    * @var  string
    */
    protected $table = 'packages';

    /**
    * The attributes that should be hidden from arrays.
    *
    * @var  array
    */
    protected $hidden = [];

    /**
    * The default attributes.
    *
    * @var  array
    */
    protected $attributes = [];

    /**
    * Carbon converted dates.
    *
    * @var  array
    */
    protected $dates = [];

    /**
    * Disable eloquent timestamps.
    *
    * @var  boolean
    */
    public $timestamps = true;

    /**
    * The attributes that are mass assignable.
    *
    * @var  array
    */
    protected $fillable = [
        'serialized',
        'package_group',
        'name',
        'value',
        'updated_at',
    ];

}