<?php namespace Tricks;

use Illuminate\Database\Eloquent\Model;

class Torder extends Model {
	
	protected $table = "torder";
	
	//public $presenter  = "Tricks\Presenters\TorderPresenter";
	

	
	
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


	public function torderitems() {
		return $this->hasMany('Tricks\TorderItem');
	}
	
	
}