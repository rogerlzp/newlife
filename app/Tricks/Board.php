<?php namespace Tricks;

use Illuminate\Database\Eloquent\Model;

class Board extends Model {
	
	protected $table = "boards";
	
	public $presenter  = "Tricks\Presenters\BoardPresenter";
	

	
	
	/**
	 * Query the user that posted the board.
	 */
	public function user()
	{
		return $this->belongsTo('Tricks\User');
	}
	
	
	
}