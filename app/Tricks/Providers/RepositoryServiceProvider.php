<?php

namespace Tricks\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'Tricks\Repositories\UserRepositoryInterface',
            'Tricks\Repositories\Eloquent\UserRepository'
        );

        $this->app->bind(
            'Tricks\Repositories\ProfileRepositoryInterface',
            'Tricks\Repositories\Eloquent\ProfileRepository'
        );

        $this->app->bind(
            'Tricks\Repositories\TrickRepositoryInterface',
            'Tricks\Repositories\Eloquent\TrickRepository'
        );

        $this->app->bind(
            'Tricks\Repositories\TagRepositoryInterface',
            'Tricks\Repositories\Eloquent\TagRepository'
        );

        $this->app->bind(
            'Tricks\Repositories\CategoryRepositoryInterface',
            'Tricks\Repositories\Eloquent\CategoryRepository'
        );
        
        $this->app->bind(
        		'Tricks\Repositories\BoardRepositoryInterface',
        		'Tricks\Repositories\Eloquent\BoardRepository'
        );
        

        $this->app->bind(
        		'Tricks\Repositories\ImageRepositoryInterface',
        		'Tricks\Repositories\Eloquent\ImageRepository'
        );
        

        $this->app->bind(
        		'Tricks\Repositories\ImageBoardRepositoryInterface',
        		'Tricks\Repositories\Eloquent\ImageBoardRepository'
        );
        
        $this->app->bind(
        		'Tricks\Repositories\CommentRepositoryInterface',
        		'Tricks\Repositories\Eloquent\CommentRepository'
        );
        
        $this->app->bind(
        		'Tricks\Repositories\LikeRepositoryInterface',
        		'Tricks\Repositories\Eloquent\LikeRepository'
        );
        $this->app->bind(
        		'Tricks\Repositories\FollowRepositoryInterface',
        		'Tricks\Repositories\Eloquent\FollowRepository'
        );
        $this->app->bind(
        		'Tricks\Repositories\ProductRepositoryInterface',
        		'Tricks\Repositories\Eloquent\ProductRepository'
        );
        $this->app->bind(
        		'Tricks\Repositories\Category2RepositoryInterface',
        		'Tricks\Repositories\Eloquent\Category2Repository'
        );
        
        $this->app->bind(
        		'Tricks\Repositories\ProductPriceRepositoryInterface',
        		'Tricks\Repositories\Eloquent\ProductPriceRepository'
        );
        
        $this->app->bind(
        		'Tricks\Repositories\AttributeRepositoryInterface',
        		'Tricks\Repositories\Eloquent\AttributeRepository'
        );
        
        
        $this->app->bind(
        		'Tricks\Repositories\ImageTagRepositoryInterface',
        		'Tricks\Repositories\Eloquent\ImageTagRepository'
        );
        

        $this->app->bind(
        		'Tricks\Repositories\CartItemRepositoryInterface',
        		'Tricks\Repositories\Eloquent\CartItemRepository'
        );

        $this->app->bind(
        		'Tricks\Repositories\CartRepositoryInterface',
        		'Tricks\Repositories\Eloquent\CartRepository'
        );
        

        $this->app->bind(
        		'Tricks\Repositories\ProvinceRepositoryInterface',
        		'Tricks\Repositories\Eloquent\ProvinceRepository'
        );
        
        $this->app->bind(
        		'Tricks\Repositories\CityRepositoryInterface',
        		'Tricks\Repositories\Eloquent\CityRepository'
        );
        
        $this->app->bind(
        		'Tricks\Repositories\AddressRepositoryInterface',
        		'Tricks\Repositories\Eloquent\AddressRepository'
        );
        
        $this->app->bind(
        		'Tricks\Repositories\TorderRepositoryInterface',
        		'Tricks\Repositories\Eloquent\TorderRepository'
        );
        
        $this->app->bind(
        		'Tricks\Repositories\TorderItemRepositoryInterface',
        		'Tricks\Repositories\Eloquent\TorderItemRepository'
        );
        $this->app->bind(
        		'Tricks\Repositories\InvoiceRepositoryInterface',
        		'Tricks\Repositories\Eloquent\InvoiceRepository'
        );
    }
}
