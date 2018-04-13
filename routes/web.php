<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
| Middleware options can be located in `app/Http/Kernel.php`
|
*/



Route::get('/soon', function () {
  return view('pages.soon');
    }
);

//fybd
Route::resource('fund', 'FundController');
Route::resource('dashboard', 'UserController');

Route::get('/wallet/addfunds', 'FundsController@index');


//Transaction Route
Route::resource('transaction', 'TransactionController');

// Wallet Route
Route::resource('wallet', 'WalletController');

// Homepage Route
Route::get('/', 'WelcomeController@welcome')->name('home');

// Authentication Routes
Auth::routes();
Route::get('/admin/login', 'AdminController@showAdminLoginForm');

// Messaging Route
Route::get('/messages', 'MessagesController@index')->name('message');


// Public Routes
Route::group(['middleware' => ['web', 'activity']], function () {

    // Activation Routes
    Route::get('/activate', ['as' => 'activate', 'uses' => 'Auth\ActivateController@initial']);

    Route::get('/activate/{token}', ['as' => 'authenticated.activate', 'uses' => 'Auth\ActivateController@activate']);
    Route::get('/activation', ['as' => 'authenticated.activation-resend', 'uses' => 'Auth\ActivateController@resend']);
    Route::get('/exceeded', ['as' => 'exceeded', 'uses' => 'Auth\ActivateController@exceeded']);

    // Socialite Register Routes
    Route::get('/social/redirect/{provider}', ['as' => 'social.redirect', 'uses' => 'Auth\SocialController@getSocialRedirect']);
    Route::get('/social/handle/{provider}', ['as' => 'social.handle', 'uses' => 'Auth\SocialController@getSocialHandle']);

    // Route to for user to reactivate their user deleted account.
    Route::get('/re-activate/{token}', ['as' => 'user.reactivate', 'uses' => 'RestoreUserController@userReActivate']);
});

// Registered and Activated User Routes
Route::group(['middleware' => ['auth', 'activated', 'activity']], function () {

    // Activation Routes
    Route::get('/activation-required', ['uses' => 'Auth\ActivateController@activationRequired'])->name('activation-required');
    Route::get('/logout', ['uses' => 'Auth\LoginController@logout'])->name('logout');
});

// Registered and Activated User Routes
Route::group(['middleware' => ['auth', 'activated', 'activity', 'twostep']], function () {

    //  Homepage Route - Redirect based on user role is in controller.
    Route::get('/dashboard', ['as' => 'user.dashboard',   'uses' => 'UserController@index']);

    // Show users profile - viewable by other users.
    Route::get('profile/{username}', [
        'as'   => '{username}',
        'uses' => 'ProfilesController@show',
    ]);
});

// Registered, activated, and is current user routes.
Route::group(['middleware' => ['auth', 'activated', 'currentUser', 'activity', 'twostep']], function () {

    // User Profile and Account Routes
    Route::resource(
        'profile',
        'ProfilesController', [
            'only' => [
                'show',
                'edit',
                'update',
                'create',
            ],
        ]
    );
    Route::put('profile/{username}/updateUserAccount', [
        'as'   => '{username}',
        'uses' => 'ProfilesController@updateUserAccount',
    ]);
    Route::put('profile/{username}/updateUserPassword', [
        'as'   => '{username}',
        'uses' => 'ProfilesController@updateUserPassword',
    ]);
    Route::delete('profile/{username}/deleteUserAccount', [
        'as'   => '{username}',
        'uses' => 'ProfilesController@deleteUserAccount',
    ]);

    // Route to show user avatar
    Route::get('images/profile/{id}/avatar/{image}', [
        'uses' => 'ProfilesController@userProfileAvatar',
    ]);

    // Route to upload user avatar.
    Route::post('avatar/upload', ['as' => 'avatar.upload', 'uses' => 'ProfilesController@upload']);
});

// Registered, activated, and is admin routes.
Route::group(['middleware' => ['auth', 'activated', 'role:admin', 'activity', 'twostep']], function () {
    Route::resource('/users/deleted', 'SoftDeletesController', [
        'only' => [
            'index', 'show', 'update', 'destroy',
        ],
    ]);

    Route::resource('users', 'UsersManagementController', [
        'names' => [
            'index'   => 'users',
            'destroy' => 'user.destroy',
        ],
        'except' => [
            'deleted',
        ],
    ]);

    Route::resource('themes', 'ThemesManagementController', [
        'names' => [
            'index'   => 'themes',
            'destroy' => 'themes.destroy',
        ],
    ]);

    Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');
    Route::get('routes', 'AdminDetailsController@listRoutes');
    Route::get('active-users', 'AdminDetailsController@activeUsers');
});

Route::redirect('/php', '/phpinfo', 301);



// BusinessController
Route::resource('business', 'BusinessController');

// CommentController
Route::post('/comments/store', 'CommentController@store')->name('comments.store');
Route::delete('/comments/{comment}', 'CommentController@destroy')->name('comments.destroy');

// PostController
Route::resource('posts', 'PostsController');
Route::post('/posts/rate', 'PostsController@rate')->name('rate.post');
Route::post('favorite/{post}', 'PostsController@favoritePost');
Route::post('unfavorite/{post}', 'PostsController@unFavoritePost');

Route::get('/posts/{post}/gallery', 'PostsController@galleryIndex')->name('posts.gallery.index');
Route::post('/posts/uploadImages', 'PostsController@galleryUpload')->name('posts.gallery.upload');

Route::post('/posts/images/{image}', 'PostsController@galleryDelete')->name('posts.gallery.delete');

Route::post('/search', 'PostsController@search')->name('search');

Route::get('/posts/{post}/transaction', 'PostsController@transactions')->name('posts.transactions');


Route::get('/posts/{post}/return_investment', 'PostsController@investment')->name('posts.return_investment');
Route::post('/return_investment', 'PostsController@total_investment');
Route::post('/investment_return','PostsController@request_investment_return');
Route::get('/investment_return','PostsController@request_investment_return');



// CartController
Route::resource('cart', 'CartController');


//MessagesController
Route::group(['prefix' => 'messages'], function () {
    Route::get('/', ['as' => 'messages', 'uses' => 'MessagesController@index']);
    Route::get('create/{user}/{investment}', ['as' => 'messages.create', 'uses' => 'MessagesController@create']);
    Route::post('/', ['as' => 'messages.store', 'uses' => 'MessagesController@store']);
    Route::get('{id}', ['as' => 'messages.show', 'uses' => 'MessagesController@show']);
    Route::put('{id}', ['as' => 'messages.update', 'uses' => 'MessagesController@update']);
});

//UserController Investor
Route::get('favorites', 'UserController@myFavorites')->middleware('auth')->name('investor.favorites');


// *********** BreadCrumbs

// Home
Breadcrumbs::register('home', function ($breadcrumbs) {
    $breadcrumbs->push('Home', route('home'));
});



// Home > Investments
Breadcrumbs::register('investments', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Investments', route('home'));
});


// Home > Investments >[Investment]
Breadcrumbs::register('investment', function ($breadcrumbs, $investment) {
    $breadcrumbs->parent('investments');
    $breadcrumbs->push($investment, route('posts.show', ['post' => $investment]));
});





