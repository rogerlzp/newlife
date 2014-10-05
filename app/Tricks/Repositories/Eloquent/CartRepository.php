<?php

namespace Tricks\Repositories\Eloquent;

use Disqus;
use Tricks\Tag;
use Tricks\User;
use Tricks\Product;
use Tricks\CartItem;
use Tricks\Cart;
use Illuminate\Support\Str;
use Tricks\Services\Forms\ProductForm;
use Tricks\Services\Forms\ProductEditForm;
use Tricks\Exceptions\TagNotFoundException;
use Illuminate\Database\Eloquent\Collection;
use Tricks\Exceptions\CategoryNotFoundException;
use Tricks\Repositories\CartRepositoryInterface;
use Illuminate\Support\Facades\Log;

class CartRepository extends AbstractRepository implements CartRepositoryInterface
{
    /**
     * CartItem model.
     *
     * @var \Tricks\CartItem
     */
    protected $cartitem;
    
    
    /**
     * Cart model.
     *
     * @var \Tricks\Cart
     */
    protected $cart;

   
    /**
     * Create a new ProductRepository instance.
     *
     * @param  \Tricks\Product  $product
     * @param  \Tricks\Category2  $category2
     * @param  \Tricks\Tag  $tag
     * @return void
     */
    public function __construct(CartItem $cartitem, Cart $cart, Product $product)
    {
    	$this->model    = $cart;
        $this->cartitem = $cartitem;
    }

    


    /**
     * Create a new Cart in the database.
     *
     * @param  array $data
     * @return \Tricks\Product
     */
    public function create(array $data)
    {
        $cart = $this->getNew();
        
      
        $cart->session_id       = e($data['session_id']);
        $cart->ipaddress        =  e($data['ipaddress']);
    	$cart->user_id          = e($data['user_id']);

        $cart->save();


        return $cart;
    }

    /**
     * Update the product in the database.
     *
     * @param  \Tricks\Product $product
     * @param  array $data
     * @return \Tricks\Product
     */
    public function edit($id, array $data)
    {
        $product =  $this->findById($id);
        $product->name       = e($data['name']);
        $product->slug        = Str::slug($data['name'], '-');
        $product->short_description = e($data['short_description']);
    

        $product->save();

      //  $product->tags()->sync($data['tags']);
      //  $product->categories()->sync($data['categories']);

        return $product;
    }

   
    /**
     * Get the product creation form service.
     *
     * @return \Tricks\Services\Forms\ProductForm
     */
    public function getCreationForm()
    {
        return new ProductForm;
    }

    /**
     * Get the product edit form service.
     *
     * @return \Tricks\Services\Forms\ProductEditForm
     */
    public function getEditForm($id)
    {
        return new ProductEditForm($id);
    }
    
    /**
     * Find the product information
     *
     * @param  \Tricks\User $user
     * @param  integer $perPage
     * @return \Illuminate\Pagination\Paginator|\Tricks\image
     */
    public function findById($id)
    {
    	$product = $this->model->whereId($id)->first();
    
    	return $product;
    }
    
    public function findCartItems($perPage=10) {
    	
    	$cartitems = $this->model->cartitems()->orderBy('created_at', 'DESC')->get();
    	Log::info($cartitems);
    	return $cartitems;
    	
    }
    
  
    public function findBySessionId($sessionId)
    {
    	$cart = $this->model->whereSessionId($sessionId)->first();
    
    	return $cart;
    }
    
    
    
    
}
