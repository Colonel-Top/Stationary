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
*/
Auth::routes();

Route::get('/', function () {
    return view('index');
})->name('index');


Route::get('/home', function () {
    return view('index');
})->name('home');

Route::prefix('users')->group(function () {


});

/* Product Section */
Route::prefix('dealers')->group(function () {
    Route::get('/', 'Seller\SellerController@index')->name('sellerpanel');//->middleware('seller')
    Route::get('/products/showadd', 'Product\ProductController@showadd')->name('prod.show.add');
    Route::get('/products/edit/{id}', 'Product\ProductController@showedit')->name('prod.show.edit');
    Route::post('/products/create', 'Product\ProductController@createadd')->name('prod.show.create');
    Route::post('/products/update/{id}', 'Product\ProductController@update')->name('prod.update');
    Route::get('/products/delete', 'Product\ProductController@delete')->name('prod.delete');

    Route::get('/products/index', 'Product\ProductController@index')->name('prod.index');
});


Route::prefix('admins')->group(function () {


    Route::get('/', 'DashboardController@index')->name('dashboardindex');

    /*Categories Section*/
    Route::get('/categories/add', 'Categories\CategoriesController@showadd')->name('addcat');
    Route::post('/categories/create', 'Categories\CategoriesController@createadd')->name('createcat');
    Route::get('/categories/index', 'Categories\CategoriesController@index')->name('indexcat');


// Route::get('/categories/details/{id}','Categories\CategoriesController@details')->name('cat.details');
    Route::get('/categories/edit/{id}', 'Categories\CategoriesController@showedit')->name('cat.edit');
    Route::post('/categories/update/{id}', 'Categories\CategoriesController@update')->name('cat.update');
    Route::get('/categories/delete/{id}', 'Categories\CategoriesController@delete')->name('cat.delete');


    /* User Management Section */
    Route::get('/account/showadd', 'Account\AccountController@showadd')->name('acc.show.add');
    Route::post('/account/create', 'Account\AccountController@createadd')->name('acc.create.add');

    Route::get('/account/index', 'Account\AccountController@index')->name('acc.index');
    Route::get('/account/delete/{id}', 'Account\AccountController@delete')->name('acc.delete');
    Route::post('/account/update/{id}', 'Account\AccountController@update')->name('acc.update');
    Route::get('/account/edit/{id}', 'Account\AccountController@showedit')->name('acc.edit');
    Route::get('/account/approve', 'Account\AccountController@showapprove')->name('acc.show.approve');

    Route::get('/account/approvem', 'Account\AccountController@showmanage')->name('acc.show.manage');

    Route::get('/account/approve/a{id}', 'Account\AccountController@approved')->name('acc.approved');
    Route::get('/account/approve/r{id}', 'Account\AccountController@rejected')->name('acc.rejected');
    Route::get('/account/approve/d{id}', 'Account\AccountController@rejected')->name('acc.demote');

    Route::get('/account/promote/admin/{id}', 'Account\AccountController@promoteadmin')->name('acc.promote.admin');
    Route::get('/account/promote/seller/{id}', 'Account\AccountController@promoteseller')->name('acc.promote.seller');
});