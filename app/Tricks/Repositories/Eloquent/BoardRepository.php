<?php namespace Tricks\Repositories\Eloquent;

use Tricks\Board;
use Tricks\User;
use Tricks\Repositories\BoardRepositoryInterface;
use Tricks\Services\Forms\BoardForm;

use Illuminate\Support\Facades\Log;

class BoardRepository extends AbstractRepository implements BoardRepositoryInterface {
	
	protected $board;
	
	public function __construct(Board $board) {
		$this->model = $board;
	}
	
	
	/**
	 * Create a new board in the database.
	 *
	 * @param  array $data
	 * @return \Tricks\Board
	 */
	public function create(array $data)
	{
		$board = $this->getNew();
	
		$board->board_name        = e($data['board_name']);
		$board->description = $data['description'];
		$board->user_id     = $data['user_id'];
		$board->save();
		
		return $board;
	}
	
	
	/**
	 * Get the board creation form service.
	 *
	 * @return \Tricks\Services\Forms\BoardForm
	 */
	public function getCreationForm()
	{
		return new BoardForm;
	}
	
	public function update($id, array $data) {
		//TODO
	}
	
	/**
	 * Delete the specified Board from the database.
	 *
	 * @param  mixed $id
	 * @return void
	*/
	public function delete($id) {
		//TODO 
	}
	
	/**
	 * Get an array of key-value paris of all boards
	 * 
	 * @return Array
	 */
	public function listAll() {
		$boards = $this->model->lists('board_name', 'id');
		return $boards;	
	}
	
	/**
	 * Find all the boards for the given user.
	 *
	 * @param  \Tricks\User $user
	 */
	public function findAllForUser(User $user)
	{
		Log::info($user->username);
		$boards = $user->boards()->orderBy('created_at', 'DESC')->lists('board_name', 'id');
	
		
		return $boards;
	}
		
	
} 
