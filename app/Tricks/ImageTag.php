<?php namespace Tricks;

use Illuminate\Database\Eloquent\Model;

class ImageTag extends Model {
	
	protected $table = "image_tag";
	
	public $presenter  = "Tricks\Presenters\ImageTagPresenter";
	
	
	/**
	 * 
	 */
	public function user()
	{
		return $this->belongsTo('Tricks\User');
	}
	
	

	public function image()
	{
		return $this->belongsTo('Tricks\Image');
	}
	
	
	public function product()
	{
		return $this->belongsTo('Tricks\Product');
	}
	

	
}