<?php

namespace CoderStudios\Models;

use Illuminate\Database\Eloquent\Model;

class Articles extends Model
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
    protected $table = 'articles';

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
    protected $dates = ['live_at'];

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
        'sort_order',
        'name',
        'slug',
        'img',
        'meta_author',
        'meta_date',
        'meta_title',
        'meta_description',
        'summary',
        'body',
        'created_at',
        'updated_at',
        'live_at',
    ];

    public function setEnabledAttribute($value)
    {
        if (empty($value)) {
            $this->attributes['enabled'] = 0;
        } else {
            $this->attributes['enabled'] = $value;
        }
    }

    public function images()
    {
        return $this->hasMany('CoderStudios\Models\Uploads','article_id','id');
    }

}