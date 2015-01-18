<?php namespace Tricks;

use Illuminate\Database\Eloquent\Model;

class TorderItem extends Model {
	
	protected $table = "torder_item";
	
	//public $presenter  = "Tricks\Presenters\CartItemPresenter";
	
	
	
	public function product()
	{
		return $this->belongsTo('Tricks\Product');
	}
	
	
	public function torder()
	{
		return $this->belongsTo('Tricks\Torder');
	}
	
}