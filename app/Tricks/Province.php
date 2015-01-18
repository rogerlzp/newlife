<?php

namespace Tricks;

use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'province';

	
	
	/**
	 * Query the cities belongs to the province.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\hasMany
	 */
	public function cities()
	{
		return $this->hasMany('Tricks\City');
	}
	


}
