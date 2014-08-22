<?php
# Route filters
Route::when('admin/*', 'admin');
Route::when('*', 'trick.view_throttle');

# Route patterns
Route::pattern('tag_slug', '[a-z0-9\-]+');
Route::pattern('trick_slug', '[a-z0-9\-]+');

# Admin routes
Route::group([ 'prefix' => 'admin', 'namespace' => 'Controllers\Admin' ], function () {
    Route::controller('tags', 'TagsController', [
        'getIndex' => 'admin.tags.index',
        'getView'  => 'admin.tags.view'
    ]);

    Route::controller('categories', 'CategoriesController', [
        'getIndex' => 'admin.categories.index',
        'getView'  => 'admin.categories.view'
    ]);

    Route::controller('users', 'UsersController');
});



Route::group([ 'namespace' => 'Controllers' ], function () {
    # Home routes
    Route::get('/', [ 'as' => 'browse.recent', 'uses' => 'BrowseController@getBrowseRecent' ]);
    Route::get('popular', [ 'as' => 'browse.popular', 'uses' => 'BrowseController@getBrowsePopular' ]);
    Route::get('comments', [ 'as' => 'browse.comments', 'uses' => 'BrowseController@getBrowseComments' ]);
    Route::get('about', [ 'as' => 'about', 'uses' => 'HomeController@getAbout' ]);

    # Trick routes
    Route::get('tricks/{trick_slug?}', [ 'as' => 'tricks.show', 'uses' => 'TricksController@getShow' ]);
    Route::post('tricks/{trick_slug}/like', [ 'as' => 'tricks.like', 'uses' => 'TricksController@postLike' ]);

    # Browse routes
    Route::get('categories', [ 'as' => 'browse.categories', 'uses' => 'BrowseController@getCategoryIndex']);
    Route::get('categories/{category_slug}', [
        'as'   => 'tricks.browse.category',
        'uses' => 'BrowseController@getBrowseCategory'
    ]);
    Route::get('tags', [ 'as' => 'browse.tags', 'uses' => 'BrowseController@getTagIndex' ]);
    Route::get('tags/{tag_slug}', [ 'as' => 'tricks.browse.tag', 'uses' => 'BrowseController@getBrowseTag' ]);

    # Search routes
    Route::get('search', 'SearchController@getIndex');

    # Sitemap route
    Route::get('sitemap', 'SitemapController@getIndex');
    Route::get('sitemap.xml', 'SitemapController@getIndex');

    # Authentication and registration routes
    Route::get('login', [ 'as' => 'auth.login', 'uses' => 'AuthController@getLogin' ]);
    Route::post('login', 'AuthController@postLogin');
    Route::get('login/github', [ 'as' => 'auth.login.github', 'uses' => 'AuthController@getLoginWithGithub' ]);
    Route::get('register', [ 'as' => 'auth.register', 'uses' => 'AuthController@getRegister']);
    Route::post('register', 'AuthController@postRegister');
    Route::get('logout', [ 'as' => 'auth.logout', 'uses' => 'AuthController@getLogout' ]);

    # Password reminder routes
    Route::controller('password', 'RemindersController', [
        'getRemind' => 'auth.remind',
        'getReset'  => 'auth.reset'
    ]);

    # User profile routes
    Route::get('user', [ 'as' => 'user.index', 'uses' => 'UserController@getIndex' ]);
    Route::get('user/settings', [ 'as' => 'user.settings', 'uses' => 'UserController@getSettings' ]);
    Route::post('user/settings', 'UserController@postSettings');
    Route::get('user/favorites', [ 'as' => 'user.favorites', 'uses' => 'UserController@getFavorites' ]);
    Route::post('user/avatar', [ 'as' => 'user.avatar', 'uses' => 'UserController@postAvatar' ]);
    Route::get('user/image', [ 'as' => 'user.image', 'uses' => 'UserController@getImage' ]);

    # Trick creation route
    Route::get('user/tricks/new', [ 'as' => 'tricks.new', 'uses' => 'UserTricksController@getNew' ]);
    Route::post('user/tricks/new', 'UserTricksController@postNew');

    # Trick editing route
    Route::get('user/tricks/{trick_slug}', [ 'as' => 'tricks.edit', 'uses' => 'UserTricksController@getEdit' ]);
    Route::post('user/tricks/{trick_slug}', 'UserTricksController@postEdit');

    # Trick delete route
    Route::get('user/tricks/{trick_slug}/delete', [ 'as' => 'tricks.delete', 'uses' => 'UserTricksController@getDelete' ]);

    # Feed routes
    Route::get('feed', [ 'as' => 'feed.atom', 'uses' => 'FeedsController@getAtom' ]);
    Route::get('feed.atom', [ 'uses' => 'FeedsController@getAtom' ]);
    Route::get('feed.xml', [ 'as' => 'feed.rss', 'uses' => 'FeedsController@getRss' ]);

    # This route will match the user by username to display their public profile
    # (if we want people to see who favorites and who posts what)
    Route::get('{user}', [ 'as' => 'user.profile', 'uses' => 'UserController@getPublic' ]);
    
    # Board creation route
    Route::get('user/board/new', [ 'as' => 'board.new', 'uses' => 'UserBoardController@getNew' ]);
    Route::post('user/board/new', ['as' => 'board.create', 'uses' => 'UserBoardController@postNew']);
    
    # Board list route
    Route::get('user/board/list', ['as' => 'user.board', 'uses' => 'UserBoardController@getList' ]);
    
    # Board list route
    Route::get('user/board/list2', ['as' => 'user.board2', 'uses' => 'UserBoardController@getListByUserId' ]);
    
    
    # Image creation route
    Route::get('user/image/new_local', [ 'as' => 'image.new_local', 'uses' => 'UserImageController@getNewLocal' ]);
    Route::post('user/image/new_local', 'UserImageController@postNewLocal');
    
    # Image creation route
    Route::get('user/image/new_net', [ 'as' => 'image.new_net', 'uses' => 'UserImageController@getNewNet' ]);
    Route::post('user/image/new_net', 'UserImageController@postNewNet');
    
    # Image pin route
    Route::get('user/image/pin', [ 'as' => 'image.pin', 'uses' => 'UserImageController@postPin' ]);
    
    # Image list
    Route::get('image/first', [ 'as' => 'image.first', 'uses' => 'ImageController@getIndex' ]);

    # Image id
    Route::get('image/{id}', [ 'as' => 'image.single', 'uses' => 'ImageController@getSingle' ]);
 
    # Image upload route
 //   Route::get('user/files', ['as' => 'image.creation', 'uses' => 'ImageController@getUploadForm']);
    
    Route::post('image/upload', ['as' => 'image.upload', 'uses' => 'ImageController@postUpload']);

    
    # Add Comment route
   Route::post('user/comment', ['as' => 'user.comment', 'uses' => 'CommentController@postComment']);
   
   # Add Like route
   Route::post('user/like', ['as' => 'user.like', 'uses' => 'LikeController@postLike']);
   # Add DisLike route
   Route::post('user/dislike', ['as' => 'user.dislike', 'uses' => 'LikeController@postDislike']);
    
    
   # Add Test route
   Route::get('user/test1', ['as' => 'user.test1', 'uses' => 'TestController@testComment']);
    
});
