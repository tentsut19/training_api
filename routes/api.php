<?php

use Illuminate\Http\Request;

Route::group(['prefix' => '/v1'], function () {
    Route::post('login', 'EmployeeController@login');

    // ProductCategory
    Route::get('product-category', 'ProductCategoryController@index');
    Route::get('product-category-all', 'ProductCategoryController@indexAll');
    Route::get('product-category/{id}', 'ProductCategoryController@getById');
    Route::post('product-category', 'ProductCategoryController@create');
    Route::put('product-category/{id}', 'ProductCategoryController@update');
    Route::delete('product-category/{id}', 'ProductCategoryController@delete');
    Route::patch('product-category/{id}', 'ProductCategoryController@softDelete');
    Route::delete('product-category/{id}', 'ProductCategoryController@hardDelete');

    // Product
    Route::get('product', 'ProductController@index');
    Route::get('product/{id}', 'ProductController@getById');
    Route::post('product', 'ProductController@create');
    Route::put('product/{id}', 'ProductController@update');
    Route::delete('product/{id}', 'ProductController@delete');
});
