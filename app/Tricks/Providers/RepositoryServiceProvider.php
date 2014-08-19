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
        
    }
}
