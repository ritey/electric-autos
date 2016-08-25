<?php

namespace CoderStudios\Models;

use Illuminate\Database\Eloquent\Model;

class Tweets extends Model {

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
    protected $table = 'tweets';

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
        'name',
        'tweet',
        'tweeted_at',
        'next_at',
        'created_at',
        'updated_at',
    ];

   	/**
	 * Enabled filter
	 * @param  $query
	 * @param  $enabled
	 * @return collection
	 */
	public function scopeEnabled($query, $enabled = 1)
	{
		$query->where('enabled','=',$enabled);
	}

	/**
	 * Ordered filter
	 * @param  $query
	 * @param  $field
	 * @param  $direction
	 * @return collection
	 */
	public function scopeOrdered($query, $field = 'sort_order' , $direction = 'ASC')
	{
		$query->orderBy($field,$direction);
	}

	/**
	 * Set enabled attribute
	 * @param  $value
	 * @return collection
	 */
	public function setEnabledAttribute($value)
	{
		if (empty($value)) {
			$this->attributes['enabled'] = 0;
		} else {
			$this->attributes['enabled'] = $value;
		}
	}


}