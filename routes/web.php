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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/', 'CategoryController@index')->name('categories');

Route::get('/categories', 'CategoryController@index')->name('categories');
Route::post('/categories', 'CategoryController@insert')->name('insertCategory');
Route::get('/categories/add', 'CategoryController@add')->name('addCategory');
Route::get('/categories/edit/{id}', 'CategoryController@edit')->name('editCategory');
Route::get('/categories/{id}', 'CategoryController@show')->name('showCategory');
Route::delete('/categories/{id}', 'CategoryController@delete')->name('deleteCategory');
Route::put('/categories/{id}', 'CategoryController@update')->name('updateCategory');


Route::post('/subcategories', 'SubCategoryController@insert')->name('insertSubCategory');
Route::get('/subcategories/edit/{id}', 'SubCategoryController@edit')->name('editSubCategory');
Route::get('/subcategories/{id}', 'SubCategoryController@show')->name('showSubCategory');
Route::delete('/subcategories/{id}', 'SubCategoryController@delete')->name('deleteSubCategory');
Route::put('/subcategories/{id}', 'SubCategoryController@update')->name('updateSubCategory');
