<?php

namespace Tricks;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'product';

	/**
	 * The class used to present the model.
	 *
	 * @var string
	 */
	public $presenter = 'Tricks\Presenters\ProductPresenter';

	/**
	 * The relations to eager load on every query.
	 *
	 * @var array
	 */
	// protected $with = [ 'tags', 'categories', 'user' ];

	
	

}
