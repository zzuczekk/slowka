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

Auth::routes();

Route::get('/', 'CategoryController@index')->name('categories');
Route::get('/categories', 'CategoryController@index')->name('categories');
Route::post('/categories', [
    'uses' => 'CategoryController@insert',
    'as' => 'insertCategory',
    'middleware' => 'roles',
    'roles' => [Role::ROLES['ADMIN']]
]);
Route::get('/categories/add', [
    'uses' => 'CategoryController@add',
    'as' => 'addCategory',
    'middleware' => 'roles',
    'roles' => [Role::ROLES['ADMIN']]
]);
Route::get('/categories/edit/{id}', [
    'uses' => 'CategoryController@edit',
    'as' => 'editCategory',
    'middleware' => 'roles',
    'roles' => [Role::ROLES['ADMIN']]
]);
Route::get('/categories/{id}', 'CategoryController@show')->name('showCategory');
Route::delete('/categories', [
    'uses' => 'CategoryController@delete',
    'as' => 'deleteCategory',
    'middleware' => 'roles',
    'roles' => [Role::ROLES['ADMIN']]
]);
Route::put('/categories', [
    'uses' => 'CategoryController@update',
    'as' => 'updateCategory',
    'middleware' => 'roles',
    'roles' => [Role::ROLES['ADMIN']]
]);




Route::post('/subcategories', [
    'uses' => 'SubCategoryController@insert',
    'as' => 'insertSubCategory',
    'middleware' => 'roles',
    'roles' => [Role::ROLES['ADMIN'], Role::ROLES['SUPER_EDITOR']]
]);
Route::get('/subcategories/edit/{id}', [
    'uses' => 'SubCategoryController@edit',
    'as' => 'editSubCategory',
    'middleware' => 'roles',
    'roles' => [Role::ROLES['ADMIN'], Role::ROLES['SUPER_EDITOR']]
]);
Route::get('/subcategories/{id}', 'SubCategoryController@show')->name('showSubCategory');
Route::delete('/subcategories/{id}', [
    'uses' => 'SubCategoryController@delete',
    'as' => 'deleteSubCategory',
    'middleware' => 'roles',
    'roles' => [Role::ROLES['ADMIN'], Role::ROLES['SUPER_EDITOR']]
]);
Route::put('/subcategories/{id}', [
    'uses' => 'SubCategoryController@update',
    'as' => 'updateSubCategory',
    'middleware' => 'roles',
    'roles' => [Role::ROLES['ADMIN'], Role::ROLES['SUPER_EDITOR']]
]);


Route::post('/sets', [
    'uses' => 'SetController@insert',
    'as' => 'insertSet',
    'middleware' => 'roles',
    'roles' => [Role::ROLES['ADMIN'], Role::ROLES['SUPER_EDITOR'], Role::ROLES['EDITOR']]
]);
Route::delete('/sets/{id}', [
    'uses' => 'SetController@delete',
    'as' => 'deleteSet',
    'middleware' => 'roles',
    'roles' => [Role::ROLES['ADMIN'], Role::ROLES['SUPER_EDITOR'], Role::ROLES['EDITOR']]
]);
Route::get('/sets/{id}', 'SetController@show')->name('showSet');

Route::get('/sets/edit/{id}', [
    'uses' => 'SetController@edit',
    'as' => 'editSet',
    'middleware' => 'roles',
    'roles' => [Role::ROLES['ADMIN'], Role::ROLES['SUPER_EDITOR'], Role::ROLES['EDITOR']]
]);

Route::put('/sets/{id}', [
    'uses' => 'SetController@update',
    'as' => 'updateSet',
    'middleware' => 'roles',
    'roles' => [Role::ROLES['ADMIN'], Role::ROLES['SUPER_EDITOR'], Role::ROLES['EDITOR']]
]);



Route::get('/users', [
    'uses' => 'UserController@index',
    'as' => 'users',
    'middleware' => 'roles',
    'roles' => [Role::ROLES['ADMIN']]
]);

Route::put('/users', [
    'uses' => 'UserController@update',
    'as' => 'updateUser',
    'middleware' => 'roles',
    'roles' => [Role::ROLES['ADMIN']]
]);



