<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::pattern('id', '[0-9]+');
Route::pattern('slug', '[a-z0-9-\.]+');

// Admin
Route::group(['middleware' => 'auth'], function()
{
    Route::resource('admin/blog/article', 'Admin\Blog\ArticleController');
    Route::resource('admin/blog/tag', 'Admin\Blog\TagController', ['except' => ['create']]);
    Route::resource('admin/blog/icon', 'Admin\Blog\IconController', ['except' => ['create']]);
});

Route::controller('admin', 'Admin\AdminController', [
    'getIndex' => 'admin.index',
]);



// Errors
Route::group(['prefix' => 'errors'], function()
{
    Route::get('404', 'ErrorsController@get404');
    Route::get('500', 'ErrorsController@get500');
    Route::get('503', 'ErrorsController@get503');
});



// Blog
Route::group(['prefix' => 'blog'], function()
{
    Route::get('/', [
        'as' => 'blog.index',
        'uses' => 'Blog\ArticleController@getIndex',
    ]);

    Route::get('rss.rdf', [
        'as' => 'blog.rss',
        'uses' => 'Blog\RssController@index',
    ]);

    Route::get('archives/all', [
        'as' => 'blog.archives.all',
        'uses' => 'Blog\ArticleController@getArchivesAll',
    ]);

    Route::get('tag/all', [
        'as' => 'blog.tag.all',
        'uses' => 'Blog\ArticleController@getTagAll',
    ]);

    Route::get('tag/{slug}', [
        'as' => 'blog.tag.show',
        'uses' => 'Blog\ArticleController@getTag',
    ]);

    Route::get('{slug}', [
        'as' => 'blog.show',
        'uses' => 'Blog\ArticleController@getSingle',
    ]);
});



// Other
Route::get('sitemap.xml', [
    'as' => 'sitemap',
    'uses' => 'SitemapController@index',
]);



// Main
Route::controller('/', 'BaseController', [
    'getIndex' => 'index',
    'getWork' => 'work.index',
    'getAbout' => 'about.index',
]);
