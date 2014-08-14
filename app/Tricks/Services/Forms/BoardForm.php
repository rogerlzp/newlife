<?php namespace Tricks\Services\Forms;

class BoardForm extends AbstractForm {
	
	protected $rules = [
	'board_name'        => 'required',
	'description' => 'required|min:4'
	];
}
