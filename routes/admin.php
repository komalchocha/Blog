<?php

use Illuminate\Support\Facades\Route;
Route::get('Admin',  function () {
    return redirect()->route('admin.login');
});



Route::group(['namespace' => 'Auth'], function () {
    # Login Routes
    Route::get('login',     'LoginController@showLoginForm')->name('login');
    Route::post('login',    'LoginController@login');
    Route::get('logout',   'LoginController@logout')->name('logout');
});

Route::group(['middleware' => 'auth:admin'],function(){
    Route::get('dashboard', 'DashboardController@index')->name('dashboard');
    Route::group(['prefix' => 'user', 'as' => 'user.'], function () {
    Route::get('view_user_list','UserController@index')->name('view_user_list');
    Route::post('destroyuser', 'UserController@destroyuser')->name('destroyuser');
    Route::get('user_edit','UserController@edit')->name('user_edit');
    Route::post('updateUser', 'UserController@updateUser')->name('updateUser');
    Route::post('destroyuser', 'UserController@destroyuser')->name('destroyuser');

    
    });
    Route::group(['prefix' => 'blog', 'as' => 'blog.'], function () {
    Route::get('blog_view_list','BlogController@index')->name('blog_view_list');
    Route::post('destroyBlog/{id}', 'BlogController@destroyBlog')->name('destroyBlog');
    Route::get('editBlog','BlogController@editBlog')->name('editBlog');
    Route::post('updateBlog','BlogController@updateBlog')->name('updateBlog');
    Route::get('categoreis_view_list','CategoryController@index')->name('categoreis_view_list');
    Route::post('categories', 'CategoryController@storeCategory')->name('categories');
    Route::post('destroyCategory', 'CategoryController@destroyCategory')->name('destroyCategory');
    Route::get('edit_Category','CategoryController@editCategory')->name('edit_Category');
    Route::post('updateCategory', 'CategoryController@updateCategory')->name('updateCategory');
    Route::get('comment_view_list','CommentController@index')->name('comment_view_list');
    Route::post('destroy_Comment', 'CommentController@destroyComment')->name('destroy_Comment');

    
    });

    Route::group(['prefix' => 'product', 'as' => 'product.'], function () {
        Route::get('product_view_list','ProductController@index')->name('product_view_list');
        Route::post('products', 'ProductController@ProductStore')->name('products');
        Route::post('destroy_Product', 'ProductController@destroyProduct')->name('destroy_Product');
        Route::get('file-import','ProductController@importView')->name('import-view');
        Route::post('import','ProductController@import')->name('import');
        Route::get('export-products','ProductController@exportProduct')->name('export-products');
    });

});    
