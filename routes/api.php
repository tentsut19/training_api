<?php

use Illuminate\Http\Request;

Route::group(['prefix' => '/v1'], function () {
    Route::post('login', 'EmployeeController@login');
    Route::post('register', 'EmployeeController@register');

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

    // Stock
    Route::get('stock', 'StockController@index');
    Route::get('stock-all', 'StockController@getAll');
    Route::get('stock/{id}', 'StockController@getById');
    Route::post('stock', 'StockController@create');
    Route::put('stock/{id}', 'StockController@update');
    Route::patch('stock/{id}', 'StockController@softDelete');
    Route::delete('stock/{id}', 'StockController@hardDelete');

    // Equipment
    Route::get('equipment', 'EquipmentController@index');
    Route::get('equipment-all', 'EquipmentController@getAll');
    Route::get('equipment/{id}', 'EquipmentController@getById');
    Route::get('equipment-detail/{id}', 'EquipmentController@getByIdDetail');
});
