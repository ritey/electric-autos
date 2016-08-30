<?php

namespace CoderStudios\Models;

use Illuminate\Database\Eloquent\Model;

class Resources extends Model
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
    protected $table = 'resources';

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
        'sold',
        'private',
        'sort_order',
        'car_type_id',
        'user_id',
        'dealer_id',
        'make_id',
        'model_id',
        'name',
        'price',
        'fuel',
        'year',
        'colour',
        'reg',
        'gearbox',
        'doors',
        'slug',
        'mileage',
        'currency',
        'content',
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

    public function make()
    {
        return $this->belongsTo('CoderStudios\Models\Makes','make_id','id');
    }

    public function model()
    {
        return $this->belongsTo('CoderStudios\Models\Models','model_id','id');
    }

    public function dealer()
    {
        return $this->belongsTo('CoderStudios\Models\Dealers','dealer_id','id');
    }

    public function images()
    {
        return $this->hasMany('CoderStudios\Models\Uploads','folder','id');
    }

}