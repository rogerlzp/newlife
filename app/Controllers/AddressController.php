<?php

namespace Controllers;

use Github;
use GithubProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Response;
use Tricks\Repositories\UserRepositoryInterface;
use Tricks\Repositories\ProvinceRepositoryInterface;
use Tricks\Repositories\CityRepositoryInterface;
use Tricks\Repositories\AddressRepositoryInterface;

use Tricks\County;

class AddressController extends BaseController
{
    /**
     * User Repository.
     *
     * @var \Tricks\Repositories\UserRepositoryInterface
     */
    protected $users;
    
    /**
     * Province Repository.
     *
     * @var \Tricks\Repositories\UserRepositoryInterface
     */
    protected $province;
    
    /**
     * City Repository.
     *
     * @var \Tricks\Repositories\CityRepositoryInterface
     */
    protected $city;
    

    
    /**
     * Address Repository.
     *
     * @var \Tricks\Repositories\AddressRepositoryInterface
     */
    protected $address;

    /**
     * Create a new AuthController instance.
     *
     * @param  \Tricks\Repositories\UserRepositoryInterface $users
     * @return void
     */
    public function __construct(UserRepositoryInterface $users, ProvinceRepositoryInterface $province,
 CityRepositoryInterface $city,  AddressRepositoryInterface $address)
    {
        parent::__construct();

        $this->users = $users;
        $this->province = $province;
        $this->city = $city;
        $this->address = $address;
    }

   
    public function getCityData(){
    	$cityId = Input::get('city_id');
    	$city = $this->city->findById($cityId);
 
    	$arr1 = array();
    	$arr2 = array();

    		$counties = $city->counties()->get();
    		foreach($counties as $county) {
    			array_push($arr2, array('id'=>$county->id, 'county_name'=>$county->county_name));
    		}
    	
    
    	return Response::json($arr2);
    	
    }
    
    public function getProvinceData(){
    	$provinceId = Input::get('province_id');
    	Log::info($provinceId);
    	$province = $this->province->findById($provinceId);
    	Log::info($province);
    	
    	$cities = $province->cities()->get();
    	$arr1 = array();
    	$arr2 = array();
    	foreach($cities as $city) {
    		$counties = $city->counties()->get();
    		$arr2 = array();
    		foreach($counties as $county) {
    			array_push($arr2, array('id'=>$county->id, 'county_name'=>$county->county_name));
    		}
    		array_push($arr1, array('id'=>$city->id, 'city_name'=>$city->city_name, 'counties'=>$arr2));

    	}
    	Log::info($arr1);
     	
    	return Response::json($arr1);
    }
    
    public function saveAddress() {
    	$data = [];
    	$data['province_id'] = Input::get('province_id');
    	
    	$data['province_name'] = $this->province->findById(Input::get('province_id'))->province_name;
    //	Input::get('province_name');
    	$data['city_id'] = Input::get('city_id');
    	$data['city_name'] =  $this->city->findById(Input::get('city_id'))->city_name;

    	$data['county_id'] =  Input::get('county_id');
    	$data['county_name'] = County::find(Input::get('county_id'))->county_name;
    	// Input::get('county_name');
    	
		$data['street'] = Input::get('street');
		$data['consignee'] = Input::get('consignee');
		$data['phone'] = Input::get('phone');
		$data['zipcode'] = Input::get('zipcode');
		$user = Auth::user();
		$data['user_id'] = $user->id;
		
		
		$address = $this->address->create($data);
		$user->addresses()->save($address);
		Log::info('hello');
    //	return Response::json('success');
    	return Response::json('success', 200);
    }
    
}
