<?php
# Route filters
//Route::when('admin/*', 'admin');
Route::when('*', 'trick.view_throttle');

# Route patterns
Route::pattern('tag_slug', '[a-z0-9\-]+');
Route::pattern('trick_slug', '[a-z0-9\-]+');

# Admin routes
Route::group(['prefix'=>'admin', 'namespace' => 'Controllers\Admin' ], function () {
    Route::controller('tags', 'TagsController', [
        'getIndex' => 'admin.tags.index',
        'getView'  => 'admin.tags.view'
    ]);

    Route::controller('categories', 'CategoriesController', [
        'getIndex' => 'admin.categories.index',
        'getView'  => 'admin.categories.view'
    ]);
    
    
    Route::controller('attribute', 'AttributeController', [
    'getIndex' => 'admin.attribute.index',
    'getView'  => 'admin.attribute.view'
    		]);
    
    Route::controller('product', 'ProductController', [
    'getIndex' => 'admin.product.index',
    'getView'  => 'admin.product.view'
    		]);
    
    
    Route::get('image', ['as'=>'admin.image.index', 'uses' => 'ImageController@getIndex'] );
   // Route::get('image', ['as'=>'admin.image.view', 'uses' => 'ImageController@getView'] );
    
    Route::get('image/{id}', ['as'=>'admin.image.single', 'uses' => 'ImageController@getSingle'] );
    
    Route::get('image/tagadd', ['as'=>'admin.image.tag', 'uses' => 'ImageController@getTag'] );
    Route::post('image/tagadd', ['as'=>'admin.image.tag', 'uses' => 'ImageController@postTag'] );
    
    
    
    Route::controller('category2', 'Category2Controller', [
    'getIndex' => 'admin.category2.index',
    'getView'  => 'admin.category2.view'
    		]);
    


    Route::get('category2',  ['as'=>'admin.category2.index', 'uses' => 'Category2Controller@getIndex']);
    
    Route::get('product',  ['as'=>'admin.product.create', 'uses' => 'ProductController@getCreate']);
    Route::post('product', 'ProductController@postCreate');
    
    Route::post('attribute/create',  ['as'=>'admin.attribute.create', 'uses' => 'AttributeController@postCreate']);
    // upload product image
    Route::post('product2',  ['as'=>'admin.product.updateImage', 'uses' => 'ProductController@postUpdateImage']);

    // upload product image
    Route::post('product3',  ['as'=>'admin.product.updateprice', 'uses' => 'ProductController@postUpdatePrice']);
    
    
    Route::get('test5', [ 'as' => 'admin.show', 'uses' => 'AdminController@getIndex' ]);    
    Route::controller('users', 'UsersController');
    
    Route::get('fhadmin', [ 'as' => 'admin.login', 'uses' => 'AdminController@getLogin' ]);

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
    
    # Browse routes
    Route::get('categories2', [ 'as' => 'browse.categories2', 'uses' => 'BrowseController@getCategoryIndex']);
    Route::get('categories2/{category_slug}', [
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
    
    Route::get('adminlogin', [ 'as' => 'auth.adminlogin', 'uses' => 'AuthController@getLogin' ]);
    Route::post('adminlogin', 'AuthController@postAdminLogin');
    
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
    Route::get('user/profile', [ 'as' => 'user.profile', 'uses' => 'UserController@getProfile' ]);
    
    Route::get('portfolio/pmyshow', [ 'as' => 'portfolio.profile_showmy', 'uses' => 'PortfolioController@getProfileMyShow' ]);
    

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
  //  Route::get('{user}', [ 'as' => 'user.profile', 'uses' => 'UserController@getPublic' ]);
    
    # Board creation route
    Route::get('user/board/new', [ 'as' => 'board.new', 'uses' => 'UserBoardController@getNew' ]);
    Route::post('user/board/new', ['as' => 'board.create', 'uses' => 'UserBoardController@postNew']);
    
    # Board show route
    Route::get('board/{id}', ['as' => 'board.show', 'uses' => 'BoardController@getShow']);
    
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
    Route::get('image/show', [ 'as' => 'image.show', 'uses' => 'ImageController@getIndex' ]);

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
   
   # Follow  route
   Route::post('user/follow', ['as' => 'user.follow', 'uses' => 'UserController@postFollow']);
   # Unfollow route
   Route::post('user/unfollow', ['as' => 'user.unfollow', 'uses' => 'UserController@postUnfollow']);
    

   # Product list
   Route::get('product/show', [ 'as' => 'product.show', 'uses' => 'ProductController@getIndex' ]);
   
   # Product id
   Route::get('product/{id}', [ 'as' => 'product.single', 'uses' => 'ProductController@getSingle' ]);
    
   # Add Test route
   Route::get('user/test1', ['as' => 'user.test1', 'uses' => 'TestController@test123']);
   Route::get('user/test2', ['as' => 'user.test1', 'uses' => 'TestController@testProductInfo']);
   Route::get('user/tfollow1', ['as' => 'user.test_follow', 'uses' => 'TestController@testUserFollow']);
   
   
   
   # Cart index
   Route::get('cart/show', [ 'as' => 'cart.show', 'uses' => 'CartController@getIndex' ]);
    
   # Add product to cart
   Route::post('cart/add', [ 'as' => 'cart.add', 'uses' => 'CartController@addToCart' ]);
   
   # order index
   # Cart index
   Route::get('cart/checkout', [ 'as' => 'checkout.index', 'uses' => 'OrderController@getIndex' ]);
   Route::get('user/order', [ 'as' => 'user.order', 'uses' => 'UserController@getUserOrder' ]);
   
   
   # Cart index
   Route::get('hello/{id}', [ 'as' => 'province.data', 'uses' => 'AddressController@getProvinceData' ]);
   Route::get('city/{id}', [ 'as' => 'city.data', 'uses' => 'AddressController@getCityData' ]);
   Route::post('address/save', [ 'as' => 'address.save', 'uses' => 'AddressController@saveAddress' ]);
   
   // Order route
   Route::post('order/new', [ 'as' => 'order.new', 'uses' => 'OrderController@postNewOrder' ]);
   
   // my profile route
  // Route::get('{user}', [ 'as' => 'user.profile', 'uses' => 'UserController@getMyProfile' ]);
  // Route::get('{user}', [ 'as' => 'user.order', 'uses' => 'UserController@getMyOrder' ]);
   
  // youku route
  
   // paypal route
   Route::get('payment', ['as' => 'payment.test1', 'uses' => 'PayPalController@getPayment']);
   
   Route::post('payment', ['as' => 'payment.test1', 'uses' => 'PayPalController@postPayment']);
   Route::get('oayment/status', ['as' => 'payment.status', 'uses' => 'PayPalController@getPaymentStatus']);
  
   
});
