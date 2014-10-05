<?php namespace Tricks;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model {
	
	protected $table = "cart";
	
	public $presenter  = "Tricks\Presenters\CartPresenter";
	

	
	
	/**
	 * Query the user that posted the board.
	 */
	public function user()
	{
		return $this->belongsTo('Tricks\User');
	}
	
	
	/** images
	 * 
	 * 
	 */


	public function cartitems() {
		return $this->hasMany('Tricks\CartItem');
	}
	
	
}