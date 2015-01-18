<?php

namespace Tricks;

use Illuminate\Database\Eloquent\Model;

class County extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'county';


	/**
	 * Query the province that belongs to the city.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	
	
	public function city()
	{
		return $this->belongsTo('Tricks\City');
	}


}
