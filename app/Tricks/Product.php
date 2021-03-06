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

	
	/**
	 * Query the image that belongs to the product.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */

	
	public function image()
	{
		return $this->belongsTo('Tricks\Image');
	}
	
	public function price()
	{
		return $this->hasOne('Tricks\ProductPrice');
	}
	
	/**
	 * Relationship with Comment table
	 */
	public function comments() {
		return $this->morphMany('Tricks\Comment', 'commentable');
	}
	
	/**
	 * Query the attributes belongs to the products.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
	public function attributes()
	{
		return $this->belongsToMany('Tricks\Attribute', 'product_attribute');
	}
	

	public function imagetag()
	{
		return $this->hasOne('Tricks\ImageTag');
	}
	
	
	public function cartitem()
	{
		return $this->hasOne('Tricks\CartItem');
	}
	

}
