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

Route::get('/', 'HomeController@index')->name('home.index');

Route::get('/login', function() {
    return view('login');
})->name('home.login');

Auth::routes();

Route::get('/index','HomeController@check')->name('home.check');
Route::get('/dashboard','HomeController@dashboard')->name('home.dashboard');

//Route::get('admin/home', 'HomeController@index')->name('admin.home');

//Route account
Route::get('admin/account', 'AccountController@index')->name('account.index');
Route::get('admin/account/detail', 'AccountController@detail')->name('account.detail');
Route::get('admin/account/deposit/{id}', 'AccountController@deposit')->name('account.deposit');
Route::get('admin/account/withdraw/{id}', 'AccountController@withdraw')->name('account.withdraw');
Route::get('admin/account/insert', 'AccountController@insert')->name('account.insert');
Route::get('admin/account/update', 'AccountController@update')->name('account.update');

//Route Garbage
Route::get('admin/garbage', 'GarbageController@index')->name('garbage.index');
Route::get('admin/garbage/add', 'GarbageController@add')->name('garbage.add');
Route::get('admin/garbage/insert', 'GarbageController@insert')->name('garbage.insert');
Route::get('admin/garbage/edit/{id}', 'GarbageController@edit')->name('garbage.edit');
Route::get('admin/garbage/update/{id}', 'GarbageController@update')->name('garbage.update');
Route::get('admin/garbage/delete/{id}', 'GarbageController@delete')->name('garbage.delete');
Route::get('admin/garbage/purchaseprice/{id}', 'GarbageController@purchaseprice')->name('garbage.purchaseprice');

//Route Sell
Route::get('admin/sale', 'SaleController@index')->name('sale.index');
Route::get('admin/sale/add', 'SaleController@add')->name('sale.add');
Route::get('admin/sale/insert', 'SaleController@insert')->name('sale.insert');
Route::get('admin/sale/edit/{id}', 'SaleController@edit')->name('sale.edit');
Route::get('admin/sale/update/{id}', 'SaleController@update')->name('sale.update');
Route::get('admin/sale/delete/{id}', 'SaleController@delete')->name('sale.delete');

//profit
Route::get('admin/profit', 'ProfitController@index')->name('profit.index');
Route::get('admin/profit/find', 'ProfitController@find')->name('profit.find');
Route::get('admin/profit/type', 'ProfitController@type')->name('profit.type');
Route::get('admin/profit/findbytype', 'ProfitController@findbytype')->name('profit.findbytype');

//user/history
Route::get('user/history', 'HistoryController@index')->name('history.index');
Route::get('profile', 'ProfileController@index')->name('profile.index');

//news
Route::get('admin/news', 'NewsController@index')->name('news.index');
Route::get('admin/news/add', 'NewsController@add')->name('news.add');
Route::post('admin/news/insert', 'NewsController@insert')->name('news.insert');
Route::get('news/show/{id}', 'NewsController@show')->name('news.show');
Route::post('admin/news/update/{id}', 'NewsController@update')->name('news.update');
Route::get('admin/news/edit/{id}', 'NewsController@edit')->name('news.edit');
Route::get('admin/news/delete/{id}', 'NewsController@delete')->name('news.delete');

Route::get('admin/chart','ChartController@index')->name('chart.index');
Route::get('admin/chart/find','ChartController@find')->name('chart.find');
