<?php namespace Tricks\Presenters;

use Tricks\Image;
use McCool\LaravelAutoPresenter\BasePresenter;

class ImagePresenter extends BasePresenter {
	
	public function __construct(Image $image)
	{
		$this->resource = $image;
	}
	
	
}

