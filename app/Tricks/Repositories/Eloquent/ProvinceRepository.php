<?php

namespace Tricks\Repositories\Eloquent;

use Disqus;
use Tricks\Tag;
use Tricks\User;
use Tricks\Product;
use Tricks\County;
use Tricks\Province;
use Tricks\City;
use Illuminate\Support\Str;
use Tricks\Services\Forms\ProductForm;
use Tricks\Services\Forms\ProductEditForm;
use Tricks\Exceptions\TagNotFoundException;
use Illuminate\Database\Eloquent\Collection;
use Tricks\Exceptions\CategoryNotFoundException;
use Tricks\Repositories\ProvinceRepositoryInterface;
use Illuminate\Support\Facades\Log;

class ProvinceRepository extends AbstractRepository implements ProvinceRepositoryInterface
{
    /**
     * CartItem model.
     *
     * @var \Tricks\CartItem
     */
    protected $cartitem;
    
    
    /**
     * Province model.
     *
     * @var \Tricks\Cart
     */
    protected $province;
    protected $city;
    protected $county;
    

   
    /**
     * Create a new ProductRepository instance.
     *
     * @param  \Tricks\Product  $product
     * @param  \Tricks\Category2  $category2
     * @param  \Tricks\Tag  $tag
     * @return void
     */
    public function __construct(City $city, County $county, Province $province)
    {
    	$this->model    = $province;
        $this->city = $city;
        $this->county = $county;
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
    	$province = $this->model->whereId($id)->first();
    
    	return $province;
    }
    
    public function findCities() {
    	$cities = $this->model->cities()->get();
    	return $cities;
    }
    
  

    
    
    
}
