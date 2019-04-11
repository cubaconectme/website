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
Route::match(['post','get'],'/testing',['uses' => 'Test\TestController@testing', 'as' => 'test.testing']);



Route::post('/loginUserAjax',['uses' => 'Auth\LoginController@loginAjax', 'as' => 'auth.login_ajax']);
Route::post('/registerUserAjax',['uses' => 'Auth\LoginController@registerUserAjax', 'as' => 'auth.register_ajax']);
Route::get('/',  ['uses' => 'HomeController@indexView', 'as' => 'home.index_view']);

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'recharge'], function(){
    Route::post('/action',['uses' => 'Recharges\RechargesController@actions', 'as' => 'recharge.action']);
    Route::get('/getCubacelContacts/{query}/{limit}',['uses' => 'Recharges\RechargesController@getCubacelContacts', 'as' => 'recharge.cubacel_contacts']);
    Route::get('/getNautaContacts/{query}/{limit}',['uses' => 'Recharges\RechargesController@getNautaContacts', 'as' => 'recharge.nauta_contacts']);
    Route::get('/getSMSContacts/{query}/{limit}',['uses' => 'Recharges\RechargesController@getSMSContacts', 'as' => 'recharge.sms_contacts']);
});

Route::group(['prefix' => 'contact'], function(){
    Route::post('/edit', ['uses' => 'Contact\ContactController@editContact', 'as' => 'contact.edit']);
});

Route::group(['prefix' => 'admin'], function () {
    Route::match(['post', 'get'], '/', ['uses' => 'Admin\AdminController@index', 'as' => 'admin.index']);
});

Route::group(['prefix' => 'user'], function () {
    Route::match(['post', 'get'], '/', ['uses' => 'User\UserController@index', 'as' => 'user.index']);
    Route::post('/actions', ['uses' => 'User\UserController@actions', 'as' => 'user.action']);

});

Route::group(['prefix' => 'products'], function () {
    Route::match(['post', 'get'], '/', ['uses' => 'Products\ProductsController@index', 'as' => 'products.index']);
    Route::post('/actions', ['uses' => 'Products\ProductsController@actions', 'as' => 'products.action']);
});

Route::group(['prefix' => 'planes'], function () {
    Route::match(['post', 'get'], '/', ['uses' => 'Planes\PlanesController@index', 'as' => 'planes.index']);
    Route::post('/actions', ['uses' => 'Planes\PlanesController@actions', 'as' => 'planes.action']);
});

Route::group(['prefix' => 'promotion'], function () {
    Route::match(['post', 'get'], '/', ['uses' => 'Promotions\PromotionsController@index', 'as' => 'planes.index']);
    Route::post('/actions', ['uses' => 'Promotions\PromotionsController@actions', 'as' => 'planes.action']);
});
