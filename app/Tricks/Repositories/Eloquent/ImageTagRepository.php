<?php namespace Tricks\Repositories\Eloquent;

use Tricks\Image;
use Tricks\ImageTag;
use Tricks\Repositories\ImageTagRepositoryInterface;
use Tricks\Services\Forms\ImageTagForm;
use Tricks\User;

use Illuminate\Support\Facades\Log;

class ImageTagRepository extends AbstractRepository implements ImageTagRepositoryInterface {

	protected $imagetag;

	public function __construct(ImageTag $imagetag) {
		$this->model = $imagetag;
	}


	/**
	 * Create a new image in the database.
	 *
	 * @param  array $data
	 * @return \Tricks\Board
	 */
	public function create(array $data)
	{
		$imagetag = $this->getNew();

		$imagetag->x1        = e($data['x1']);
		$imagetag->y1 = $data['y1'];
		$imagetag->width     = $data['w'];
		$imagetag->height     = $data['h'];
		$imagetag->product_id     = $data['product_id'];
		$imagetag->image_id     = $data['image_id'];

		$imagetag->save();

		return $imagetag;
	}

	
	/**
	 * Create a new image in the database.
	 *
	 * @param  array $data
	 * @return \Tricks\Board
	 */
	public function createFromProduct(array $data)
	{
		$image = $this->getNew();
	
		$image->user_id     = $data['user_id'];
		$image->image_path     = $data['image_path'];
	
		if (array_key_exists('image_type',$data )){
			$image->image_type     = $data['image_type'];
		}
		$image->save();
	
		return $image;
	}
	

	/**
	 * Get the image creation form service.
	 *
	 * @return \Tricks\Services\Forms\ImageForm
	 */
	public function getCreationForm()
	{
		return new ImageTagForm;
	}

	public function update($id, array $data) {
		//TODO
	}

	/**
	 * Delete the specified Image from the database.
	 *
	 * @param  mixed $id
	 * @return void
	 */
	public function delete($id) {
		//TODO
	}

	/**
	 * Find all the tricks for the given user paginated.
	 *
	 * @param  \Tricks\User $user
	 * @param  integer $perPage
	 * @return \Illuminate\Pagination\Paginator|\Tricks\Trick[]
	 */
	public function findAllForUser(User $user, $perPage = 9)
	{
		$images = $user->images()->orderBy('created_at', 'DESC')->paginate($perPage);

		Log::info('findAllForUser');
		//Log::info($images);


		return $images;
	}


	/**
	 * Find all the images for the given user paginated.
	 *
	 * @param  \Tricks\User $user
	 * @param  integer $perPage
	 * @return \Illuminate\Pagination\Paginator|\Tricks\image[]
	 */
	public function findAll($perPage = 9)
	{
		$images = $this->model->all();

		Log::info('findAll');
		Log::info($images);
		Log::info(json_decode($images));

		return $images;
	}


	/**
	 * Find the image information
	 *
	 * @param  \Tricks\User $user
	 * @param  integer $perPage
	 * @return \Illuminate\Pagination\Paginator|\Tricks\image
	 */
	public function findById($id)
	{
		$image = $this->model->whereId($id)->first();
		$comments = $image->comments;
		Log::info("findById");

		Log::info($comments);
		
		return $image;
	}



}
