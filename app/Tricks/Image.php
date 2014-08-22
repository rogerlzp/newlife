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
	
	
	/**
	 * Relationship with Comment table
	 */
	public function comments() {
		return $this->morphMany('Tricks\Comment', 'commentable');
	}
	
	/**
	 * Relationship with Comment table
	 */
	public function likes() {
		return $this->morphMany('Tricks\Like', 'liketable');
	}
	
	
}