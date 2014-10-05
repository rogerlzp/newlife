<?php

namespace Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Input;
use Tricks\Repositories\CartRepositoryInterface;
use Tricks\Repositories\ProductRepositoryInterface;
use Tricks\Repositories\CartItemRepositoryInterface;
use Illuminate\Support\Facades\Log;

class CartController extends BaseController
{
    /**
     * Cart repository.
     *
     * @var \Tricks\Repositories\CartRepositoryInterface
     */
    protected $cart;
    
    /**
     * CartItem repository.
     *
     * @var \Tricks\Repositories\CartItemRepositoryInterface
     */
    protected $cartitem;
    
    
    /**
     * Product repository.
     *
     * @var \Tricks\Repositories\ProductRepositoryInterface
     */
    protected $product;
    

    /**
     * Create a new CartController instance.
     *
     * @param \Tricks\Repositories\ProductRepositoryInterface  $products
     * @return void
     */
    public function __construct(CartRepositoryInterface $cart, CartItemRepositoryInterface $cartitem, 
    		ProductRepositoryInterface $product)
    {
        parent::__construct();

        $this->cart = $cart;
        $this->cartitem = $cartitem;
        $this->product = $product;
    }
    
    /**
     * list the most popular products when the user is not logged
     */
    
    public function getIndex() {
    	$session_id = Session::getId();
    	$cart = $this->cart->findBySessionId($session_id);
    	Log::info($cart->id);
    	Log::info($cart);
    	$cartitem = $cart->cartitems()->first();
    	Log::info($cartitem);
    	
    	$product = $cartitem->product;
    	Log::info($product);
    	
    	$cartitems = $cart->cartitems()->get();
    	Log::info($cartitems);
    	return  $this->view('cart.index', compact('cartitems'));
    }
    
    /**
     * list the most popular images when the use is not logged
     */
    
    public function getSingle($id) {
    
    	$cart = $this->cart->findById($id);
    
    	return  $this->view('product.single_show', compact('product'));
    }
    
    /**
     * add to cart
     * product_id
     * user_id, if not then add (session_id)
     * 根据product_id 得到一个cart_item id
     * 然后在将cart_item 加到cart里面
     */
    
    public function addToCart() {
    	
    	Log::info('addToCart');
    
    
    	
    	$data=[];

    	
    	$session_id = Session::getId();
    	Log::info("sessio id="+$session_id);
    	
    	$data['session_id']=$session_id;
    	$ip = Request::getClientIp();
    	Log::info("ip address ="+$ip);
    	$data['ipaddress']=$ip;
    	
    	if(Auth::check()) {
    		$data['user_id'] = Auth::user()->id;
    	} else {
    		$data['user_id'] = 1;
    	}
    	
    	
    	$cart = $this->cart->create($data);
    	
    	
    	$data1 = [];
    	$data1['product_id'] = Input::get('product_id');
    	$data1['quality']  = 1 ; //TODO: update it
    	

    	
    	$product = $this->product->findById($data1['product_id']);
    	
    	$data1['cart_id'] = $cart->id;
    	$data1['price'] = $product->price->price;
    	$cartitem = $this->cartitem->create($data1);
    	
    	$cart->cartitems()->save($cartitem);
    	
    	return Response::make('success', 200);
    	// return  $this->view('product.single_show', compact('product'));
    }
    
    
    /**
     * Show the single product page.
     *
     * @param  string $slug
     * @return \Response
     */
    public function getShow($slug = null)
    {/*
        if (is_null($slug)) {
            return $this->redirectRoute('home');
        }

        $trick = $this->tricks->findBySlug($slug);

        if (is_null($trick)) {
            return $this->redirectRoute('home');
        }

        Event::fire('trick.view', $trick);

        $next = $this->tricks->findNextTrick($trick);
        $prev = $this->tricks->findPreviousTrick($trick);

        $this->view('tricks.single', compact('trick', 'next', 'prev'));
        */
    }

  
}
