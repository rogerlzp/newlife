<?php

namespace Tricks\Repositories\Eloquent;

use Disqus;
use Tricks\Tag;
use Tricks\User;
use Tricks\Product;
use Tricks\CartItem;
use Tricks\TorderItem;
use Tricks\Cart;
use Tricks\Torder;
use Illuminate\Support\Str;
use Tricks\Services\Forms\ProductForm;
use Tricks\Services\Forms\ProductEditForm;
use Tricks\Exceptions\TagNotFoundException;
use Illuminate\Database\Eloquent\Collection;
use Tricks\Exceptions\CategoryNotFoundException;
use Tricks\Repositories\TorderRepositoryInterface;
use Illuminate\Support\Facades\Log;

class TorderRepository extends AbstractRepository implements TorderRepositoryInterface
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
     * Torder model.
     *
     * @var \Tricks\Order
     */
    protected $torder;
    
    /**
     * TorderItem model.
     *
     * @var \Tricks\TOrderItem
     */
    protected $torderitem;
    

   
    /**
     * Create a new ProductRepository instance.
     *
     * @param  \Tricks\Product  $product
     * @param  \Tricks\Category2  $category2
     * @param  \Tricks\Tag  $tag
     * @return void
     */
    public function __construct(TorderItem $torderitem, Torder $torder, Product $product)
    {
    	$this->model    = $torder;
        $this->torderitem = $torderitem;
    }

    


    /**
     * Create a new Order in the database.
     *
     * @param  array $data
     * @return \Tricks\Product
     */
    public function create(array $data)
    {
	 
    	
        $torder = $this->getNew();
        $torder->user_id       = e($data['user_id']);       
        $torder->ipaddress        =  e($data['ipaddress']);
    	$torder->shipping_method          = e($data['shipping_method']);
    	$torder->address_id          = $data['address_id'];
    	$torder->payment_method          = e($data['payment_method']);
    	$torder->status_id          = 1;
    	
    	if($data['note']){  //不为空
    		$torder->note    = $data['note'];
    	}   	
    	if($data['voucher_code']){  //不为空
    		$torder->voucher_code    = $data['voucher_code'];
    	}
    	$torder->product_cost          = e($data['product_cost']);
    	
    	$torder->shipping_cost          = e($data['shipping_cost']);

    	

        $torder->save();

        return $torder;
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
