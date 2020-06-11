<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth', 'admin'], 'namespace' => 'Web\Admin', 'prefix' => 'admin'], function () {
    //Dashboard
    Route::group(['namespace' => 'Dashboard'], function () {
        Route::get('dashboard', 'DashboardController@dashboard')->name('admin.dashboard');
    });
    Route::group(['namespace' => 'UserManagement'], function () {
        Route::get('user-list', 'UserManagementController@userList')->name('admin.userList');
        Route::get('get-user-list', 'UserManagementController@getUserList')->name('admin.getUserList');
        Route::get('user-save', 'UserManagementController@userAdd')->name('admin.userAdd');
        Route::post('user-save-process', 'UserManagementController@userAddProcess')->name('admin.userAddProcess');
        Route::get('user-view/{id}', 'UserManagementController@userView')->name('admin.userView');
        Route::get('user-edit/{id}', 'UserManagementController@userEdit')->name('admin.userEdit');
        Route::get('user-delete/{id}', 'UserManagementController@userDelete')->name('admin.userDelete');
    });
    //Settings
    Route::group(['namespace' => 'Settings'], function () {
        Route::get('settings', 'SettingsController@settings')->name('admin.settings');
        Route::post('settings-save-process', 'SettingsController@settingsSaveProcess')->name('admin.settingsSaveProcess');
    });
    //Category
    Route::group(['namespace' => 'Category'], function () {
        Route::get('category-list', 'CategoryController@categoryList')->name('admin.categoryList');
        Route::get('get-category-list', 'CategoryController@getCategoryList')->name('admin.getCategoryList');
        Route::get('create-category', 'CategoryController@createCategory')->name('admin.createCategory');
        Route::post('store-category', 'CategoryController@storeCategory')->name('admin.storeCategory');
        Route::get('edit-category/{id}', 'CategoryController@editCategory')->name('admin.editCategory');
        Route::post('update-category', 'CategoryController@updateCategory')->name('admin.updateCategory');
        Route::get('delete-category/{id}', 'CategoryController@deleteCategory')->name('admin.deleteCategory');
    });
    //Product
    Route::group(['namespace' => 'Product'], function () {
        Route::get('product-list', 'ProductController@productList')->name('admin.productList');
        Route::get('get-product-list', 'ProductController@getProductList')->name('admin.getProductList');
        Route::get('create-product', 'ProductController@createProduct')->name('admin.createProduct');
        Route::post('store-product', 'ProductController@storeProduct')->name('admin.storeProduct');
        Route::post('update-product', 'ProductController@updateProduct')->name('admin.updateProduct');
        Route::get('delete-product/{id}', 'ProductController@deleteProduct')->name('admin.deleteProduct');
        //Product Details
        Route::get('product-details/{id}', 'ProductDetailsController@productDetails')->name('admin.productDetails');
        Route::get('product-attributes/{id}', 'ProductDetailsController@productAttributes')->name('admin.productAttributes');
        Route::post('update-product-attribute', 'ProductDetailsController@updateProductAttributes')->name('admin.updateProductAttributes');
        Route::get('product-price-quantity/{id}', 'ProductDetailsController@productPriceAndQuantity')->name('admin.productPriceAndQuantity');
        Route::get('product-description/{id}', 'ProductDetailsController@productDescription')->name('admin.productDescription');
        Route::get('product-variations/{id}', 'ProductDetailsController@productVariations')->name('admin.productVariations');
        Route::post('update-product-variations', 'ProductDetailsController@updateProductVariations')->name('admin.updateProductVariations');
        Route::get('product-variation-images/{id}', 'ProductDetailsController@productVariationImages')->name('admin.productVariationImages');
        Route::post('update-product-variation-images', 'ProductDetailsController@updateProductVariationImages')->name('admin.updateProductVariationImages');
        //Product Shipping Methods
        Route::get('product-shipping-methods/{id}', 'ProductDetailsController@productShippingMethods')->name('admin.productShippingMethods');
        Route::post('update-product-shipping-methods', 'ProductDetailsController@updateProductShippingMethods')->name('admin.updateProductShippingMethods');
    });
    //Flash Sale
    Route::group(['namespace' => 'FlashSale'], function () {
        Route::get('flash-sale-list', 'FlashSaleController@flashSaleList')->name('admin.flashSaleList');
        Route::get('get-flash-sale-list', 'FlashSaleController@getFlashSaleList')->name('admin.getFlashSaleList');
        Route::get('create-flash-sale', 'FlashSaleController@createFlashSale')->name('admin.createFlashSale');
        Route::post('store-flash-sale', 'FlashSaleController@storeFlashSale')->name('admin.storeFlashSale');
        Route::get('edit-flash-sale/{id}', 'FlashSaleController@editFlashSale')->name('admin.editFlashSale');
        Route::post('update-flash-sale', 'FlashSaleController@updateFlashSale')->name('admin.updateFlashSale');
        Route::get('delete-flash-sale/{id}', 'FlashSaleController@deleteFlashSale')->name('admin.deleteFlashSale');
    });
    //Order
    Route::group(['namespace' => 'Order'], function () {
        Route::get('order-list', 'OrderController@orderList')->name('admin.orderList');
        Route::get('get-order-list', 'OrderController@getOrderList')->name('admin.getOrderList');
        Route::get('make-order-completed/{id}', 'OrderController@makeOrderCompleted')->name('admin.makeOrderCompleted');
        Route::get('make-order-processing/{id}', 'OrderController@makeOrderProcessing')->name('admin.makeOrderProcessing');
        Route::get('make-order-cancelled/{id}', 'OrderController@makeOrderCancelled')->name('admin.makeOrderCancelled');
        Route::get('delete-order/{id}', 'OrderController@deleteOrder')->name('admin.deleteOrder');
    });
    //Shipping Method
    Route::group(['namespace' => 'ShippingMethod'], function () {
        Route::get('shipping-method-list', 'ShippingMethodController@shippingMethodList')->name('admin.shippingMethodList');
        Route::get('get-shipping-method-list', 'ShippingMethodController@getShippingMethodList')->name('admin.getShippingMethodList');
        Route::get('create-shipping-method', 'ShippingMethodController@createShippingMethod')->name('admin.createShippingMethod');
        Route::post('store-shipping-method', 'ShippingMethodController@storeShippingMethod')->name('admin.storeShippingMethod');
        Route::get('edit-shipping-method/{id}', 'ShippingMethodController@editShippingMethod')->name('admin.editShippingMethod');
        Route::post('update-shipping-method', 'ShippingMethodController@updateShippingMethod')->name('admin.updateShippingMethod');
        Route::get('delete-shipping-method/{id}', 'ShippingMethodController@deleteShippingMethod')->name('admin.deleteShippingMethod');
    });
});
