<?php

namespace CoderStudios\Models;

use Illuminate\Database\Eloquent\Model;

class Dealers extends Model
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
    protected $table = 'dealers';

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
        'enabled',
        'package_id',
        'dealer_id',
        'name',
        'email',
        'slug',
        'phone',
        'mobile',
        'location',
        'website',
        'updated_at',
    ];

    /**
     * Enabled filter
     * @param  $query
     * @param  value
     * @return collection
     */
    public function scopeEnabled($query, $enabled = 1)
    {
        $query->where('enabled','=',$enabled);
    }

}