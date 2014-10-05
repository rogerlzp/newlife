<?php namespace Tricks;

use Illuminate\Database\Eloquent\Model;

class CartItem extends Model {
	
	protected $table = "cart_item";
	
	//public $presenter  = "Tricks\Presenters\CartItemPresenter";
	
	
	
	public function product()
	{
		return $this->belongsTo('Tricks\Product');
	}
	
	
	public function cart()
	{
		return $this->belongsTo('Tricks\Cart');
	}
	
}