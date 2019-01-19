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

use App\Role;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/', 'CategoryController@index')->name('categories');

Route::get('/categories', 'CategoryController@index')->name('categories');
Route::post('/categories', 'CategoryController@insert')->name('insertCategory')->middleware('checkRole:' . Role::ROLES['ADMIN']);
Route::get('/categories/add', 'CategoryController@add')->name('addCategory')->middleware('checkRole:' . Role::ROLES['ADMIN']);
Route::get('/categories/edit/{id}', 'CategoryController@edit')->name('editCategory')->middleware('checkRole:' . Role::ROLES['ADMIN']);
Route::get('/categories/{id}', 'CategoryController@show')->name('showCategory');
Route::delete('/categories/{id}', 'CategoryController@delete')->name('deleteCategory')->middleware('checkRole:' . Role::ROLES['ADMIN']);
Route::put('/categories/{id}', 'CategoryController@update')->name('updateCategory')->middleware('checkRole:' . Role::ROLES['ADMIN']);


Route::post('/subcategories', 'SubCategoryController@insert')->name('insertSubCategory');
Route::get('/subcategories/edit/{id}', 'SubCategoryController@edit')->name('editSubCategory');
Route::get('/subcategories/{id}', 'SubCategoryController@show')->name('showSubCategory');
Route::delete('/subcategories/{id}', 'SubCategoryController@delete')->name('deleteSubCategory');
Route::put('/subcategories/{id}', 'SubCategoryController@update')->name('updateSubCategory');

Route::get('/users', 'UserController@index')->name('users')->middleware('checkRole:' . Role::ROLES['ADMIN']);
Route::put('/users/{id}', 'UserController@update')->name('updateUser')->middleware('checkRole:' . Role::ROLES['ADMIN']);

