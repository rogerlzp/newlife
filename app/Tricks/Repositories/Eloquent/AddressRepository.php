<?php

namespace Tricks\Repositories\Eloquent;

use Disqus;
use Tricks\Tag;
use Tricks\User;
use Tricks\Product;
use Tricks\County;
use Tricks\Address;
use Tricks\City;
use Illuminate\Support\Str;
use Tricks\Services\Forms\ProductForm;
use Tricks\Services\Forms\ProductEditForm;
use Tricks\Exceptions\TagNotFoundException;
use Illuminate\Database\Eloquent\Collection;
use Tricks\Exceptions\CategoryNotFoundException;
use Tricks\Repositories\AddressRepositoryInterface;
use Illuminate\Support\Facades\Log;

class AddressRepository extends AbstractRepository implements AddressRepositoryInterface
{

    protected $address;
    
    /**
     * Create a new ProductRepository instance.
     *
     * @param  \Tricks\Product  $product
     * @param  \Tricks\Category2  $category2
     * @param  \Tricks\Tag  $tag
     * @return void
     */
    public function __construct(Address $address)
    {
    	$this->model    = $address;
    }

    

    /**
     * Create a new attribute in the database.
     *
     * @param  array $data
     * @return \Tricks\Attribute
     */
    public function create(array $data)
    {
    	$address = $this->getNew();
    
    	$address->address  = $data['province_id'].":".$data['province_name'].";".
    		$data['city_id'].":".$data['city_name'].";".$data['county_id'].":".$data['county_name'].
    		";".$data['street'].";".$data['zipcode'].";".$data['consignee'].";".$data['phone'];
    	$address->user_id       = $data['user_id'];
    	$address->save();
    	return $address;
    }

   
    
  

    
    
    
}
