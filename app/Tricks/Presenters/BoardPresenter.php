<?php namespace Tricks\Presenters;

use Tricks\Board;
use McCool\LaravelAutoPresenter\BasePresenter;

class BoardPresenter extends BasePresenter {
	
	public function __construct(Board $board)
	{
		$this->resource = $board;
	}
	
	
}

