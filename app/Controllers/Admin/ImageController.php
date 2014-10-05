<?php

namespace Controllers\Admin;

use Illuminate\Support\Facades\Input;
use Tricks\Repositories\ProductRepositoryInterface;
use Tricks\Repositories\ImageRepositoryInterface;
use Tricks\Repositories\ImageTagRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Response;
use Tricks\Repositories\UserRepositoryInterface;


class ImageController extends BaseController
{
    /**
     * Product repository.
     *
     * @var \Tricks\Repositories\ProductRepositoryInterface
     */
    protected $image;
    
    protected $imagetag;
    protected $product;
    protected $user;

    /**
     * Create a new ProductController instance.
     *
     */
    public function __construct(ProductRepositoryInterface $product, UserRepositoryInterface $user,
    		ImageRepositoryInterface $image,
ImageTagRepositoryInterface $imagetag)
    {
        parent::__construct();

        $this->product = $product;
        $this->image = $image;
        $this->imagetag = $imagetag;
        $this->user = $user;
    }

    /**
     * list my images
     */
    
    public function getIndex() {
    	
    	
    	$images = $this->image->findAllForUser(Auth::user(), 10);
    
    	return  $this->view('admin.image.all', compact('images'));
    }
    
    /**
     * view a image
     */
    
    public function getSingle($id) {
    
    	$image = $this->image->findById($id);
    	$products = $this->product->findAllPaginated();
    	$imageTags = $image->imageTags()->get();
    	$comments = $image->comments;
    	
    	return  $this->view('admin.image.single_show', compact('image', 'comments', 'products', 'imageTags'));
    }
    

    public function postTag() {
    	Log::info('ImageController:PostTag');
    	$imageId = Input::get('image_id');
    	$productId = Input::get('product_id');
    	$form = $this->imagetag->getCreationForm();
    	Log::info('imageId'.$imageId);
    	Log::info('prodcut_id'.$productId);
    	
    	if (! $form->isValid()) {
    		return $this->redirectRoute('admin.product.index')
    		->withErrors($form->getErrors())
    		->withInput();
    	}
    	
    	$imagetag = $this->imagetag->create($form->getInputData());
    	
    	$image = $this->image->findById($imageId);
    	$image->imageTags()->save($imagetag);
    	
    	
    	return Response::json('success', 200);
    	
     // $image->attach
     // 
    	 
    	//return  $this->view('admin.image.single_show', compact('image', 'comments', 'products'));
    }
    
    
}
