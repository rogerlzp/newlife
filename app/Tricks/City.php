<?php

namespace Tricks;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'city';

	
	
	/**
	 * Query the cities belongs to the province.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
	public function counties()
	{
		return $this->hasMany('Tricks\County');
	}
	
	/**
	 * Query the province that belongs to the city.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	
	
	public function province()
	{
		return $this->belongsTo('Tricks\Province');
	}


}
