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

    	return  $this->view('cart.index', compact('cart'));
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
     * 
     * 首先判断购物车里面有没有
     * 如果没有的话，加一个
     * 如果有的话，数目加一个
     */
    
    public function addToCart() {
    	
    	$data=[];
    	$session_id = Session::getId();
    	$data['session_id']=$session_id;
    	$ip = Request::getClientIp();
    	$data['ipaddress']=$ip;
    	
    	// if user already login
    	if(Auth::check()) {
    		$data['user_id'] = Auth::user()->id;
    		$cart = $this->cart->getCartByUserId(Auth::user()->id);
    	} else {
    		$data['user_id'] = 1;
    		$cart = $this->cart->getCartBySessionId($session_id);
    	}
    	// product already exists
    	
    	
    	// create a new cart if NOT exist
    	if(!$cart) {    	
    		$cart = $this->cart->create($data);
    		$data1 = [];
    		$data1['product_id'] = Input::get('product_id');
    		$data1['quantity']  = 1 ; //TODO: update it
    		$product = $this->product->findById($data1['product_id']);
    		$data1['cart_id'] = $cart->id;
    		$data1['price'] = $product->price->price;
    		$cartitem = $this->cartitem->create($data1);
    		$cart->cartitems()->save($cartitem);
    		 
    		$cart->total_quantity += 1;
    		$cart->total_price += $product->price->price;;
    		$cart->save();
    		 
    		Session::put('cart', $cart);
    		 
    		return Response::make('success', 200);
    	} else {
    		foreach($cart->cartitems as $cartitem) {
    			if(Input::get('product_id') == $cartitem->product_id) {
    				$cartitem->quantity +=  1;
    				$cart->total_quantity += 1;
    				$cart->total_price += $cartitem->product->price->price;
    				$cartitem->save();
    				$cart->cartitems()->save($cartitem);
    				$cart->save();
    				Session::put('cart', $cart);
    				return Response::make('success', 200);
    			}
    		}
    		$data1 = [];
    		$data1['product_id'] = Input::get('product_id');
    		$data1['quantity']  = 1 ; //TODO: update it
    		$product = $this->product->findById($data1['product_id']);
    		$data1['cart_id'] = $cart->id;
    		$data1['price'] = $product->price->price;
    		$cartitem = $this->cartitem->create($data1);
    		$cart->cartitems()->save($cartitem);
    		
    		$cart->total_quantity += 1;
    		$cart->total_price += $product->price->price;;
    		$cart->save();
    		Session::put('cart', $cart);
    		return Response::make('success', 200);
    		
    		
    	}
 
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
