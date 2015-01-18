<?php

namespace Tricks\Repositories\Eloquent;

use Disqus;
use Tricks\Tag;
use Tricks\User;
use Tricks\Product;
use Tricks\Cart;
use Tricks\CartItem;
use Tricks\Torder;
use Tricks\TorderItem;
use Illuminate\Support\Str;
use Tricks\Services\Forms\ProductForm;
use Tricks\Services\Forms\ProductEditForm;
use Tricks\Exceptions\TagNotFoundException;
use Illuminate\Database\Eloquent\Collection;
use Tricks\Exceptions\CategoryNotFoundException;
use Tricks\Repositories\CartItemRepositoryInterface;
use Tricks\Repositories\TorderItemRepositoryInterface;
use Illuminate\Support\Facades\Log;

class TorderItemRepository extends AbstractRepository implements TorderItemRepositoryInterface
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
     * Order model.
     *
     * @var \Tricks\Order
     */
    protected $torder;
    
    /**
     * TorderItem model.
     *
     * @var \Tricks\TorderItem
     */
    protected $torderitem;
    
    
    /**
     * Product model.
     *
     * @var \Tricks\Product
     */
    protected $product;

   
    /**
     * Create a new OrderItemRepository instance.
     *
     * @param  \Tricks\Order  $order
     * @param  \Tricks\Category2  $category2
     * @param  \Tricks\Tag  $tag
     * @return void
     */
    public function __construct(TorderItem $torderitem, Cart $cart, Product $product)
    {
        $this->cart    = $cart;
        $this->model = $torderitem;
        $this->product = $product;
    }

    


    /**
     * Create a new orderitem in the database.
     *
     * @param  array $data
     * @return \Tricks\OrderItem
     */
    public function create(array $data)
    {
        $torderitem = $this->getNew();
        $torderitem->price     = $data['price'];
        $torderitem->quality     = $data['quality'];
		$torderitem->product_id = $data['product_id'];
		$torderitem->order_id = $data['cart_id'];
        
        $torderitem->save();
    

     //   $product->tags()->sync($data['tags']);
    //    $product->categories()->sync($data['categories']);

        return $torderitem;
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
    
    
    
}
