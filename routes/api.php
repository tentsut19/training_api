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
    Route::post('equipment', 'EquipmentController@create');
    Route::put('equipment/{id}', 'EquipmentController@update');
    Route::patch('equipment/{id}', 'EquipmentController@softDelete');
    Route::delete('equipment/{id}', 'EquipmentController@hardDelete');
    Route::get('equipment-export-excel', 'EquipmentController@exportExcel');
    Route::get('equipment-export-pdf-preview', 'EquipmentController@previewPDF');
    Route::get('equipment-export-pdf-preview-v2', 'EquipmentController@previewPDFV2');

    Route::post('equipment-export-pdf-preview-v3', 'EquipmentController@previewPDFV3');
    Route::get('equipment-export-pdf', 'EquipmentController@createPDF');

    Route::post('equipment-export-pdf-v2', 'EquipmentController@createPDFV2');


    Route::get('equipment-export-pdf', 'EquipmentController@createPDF');


    // Work_shop_Register&Login

    Route::post('login-1', 'UserController@login');
    Route::post('register-1', 'UserController@register');




    Route::post('upload-file', 'FileManagerController@upload');

    Route::get('course-teacher', 'CourseTablecontroller@index');
    Route::get('course-teacher-all', 'CourseTablecontroller@getAll');
    Route::get('course-teacher/{id}', 'CourseTablecontroller@getById');
    Route::get('course-teacher-detail/{id}', 'CourseTablecontroller@getByIdDetail');
    Route::post('course-teacher', 'CourseTablecontroller@create');
    Route::put('course-teacher/{id}', 'CourseTablecontroller@update');
    Route::patch('course-teacher/{id}', 'CourseTablecontroller@softDelete');

    Route::get('class-student', 'ClassController@index');
    Route::get('class-student-all', 'ClassController@getAll');
    Route::get('class-student/{id}', 'ClassController@getById');
    Route::get('class-student-detail/{id}', 'ClassController@getByIdDetail');
    Route::post('class-student', 'ClassController@create');
    Route::put('class-student/{id}', 'ClassController@update');
    Route::patch('class-student/{id}', 'ClassController@softDelete');






});
