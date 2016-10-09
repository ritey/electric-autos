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
        'active',
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
        'address_1',
        'address_2',
        'town',
        'city',
        'county',
        'lat',
        'lon',
        'description',
    ];

    public function setEnabledAttribute($value)
    {
        if (empty($value)) {
            $this->attributes['enabled'] = 0;
        } else {
            $this->attributes['enabled'] = $value;
        }
    }

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