<?php namespace Controllers;

use Tricks\Repositories\CommentRepositoryInterface;
use Tricks\Repositories\BoardRepositoryInterface;
use Tricks\Repositories\CategoryRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

use Illuminate\Support\Facades\Log;
use Tricks\Image;

class CommentController extends BaseController {
	
	protected $comment;

	
	/**
	 * Create a new BoardController instance.
	 *
	 * @param \Tricks\Repositories\BoardRepositoryInterface  $board
	 * @return void
	 */
	public function __construct(CommentRepositoryInterface $comment)
	{
		parent::__construct();
	
		$this->comment = $comment;
	}
	
	/**
	 * Show the single board page.
	 *
	 * @param  string $id
	 * @return \Response
	 */
	public function postComment()
	{
		Log::info("CommentController.postComment");
		$commentableId = Input::get('image_id');
		Log::info(Input::get('conent'));

	
		$data = array(
				'commentable_type' => 'Image',
				'commentable_id' => $commentableId,
				'content' => Input::get('content'),
				'user_id' => Auth::user()->id,
		);
		
		$this->comment->create($data);
		
	}
	
	
	
	
	
}