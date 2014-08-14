<?php namespace Tricks;

use Illuminate\Database\Eloquent\Model;

class Image extends Model {
	
	protected $table = "images";
	
	public $presenter  = "Tricks\Presenters\ImagePresenter";
	
	
	/**
	 * 
	 */
	public function user()
	{
		return $this->belongsTo('Tricks\User');
	}
	
	
	
	
}