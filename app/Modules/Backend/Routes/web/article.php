<?php

Route::group(['domain' => env('BACKEND_DOMAIN')], function ($router) {

// Article Route
    Route::group(['prefix' => 'article'], function () {
        // Article
        Route::group(['prefix' => 'article'], function () {
            Route::get('list/{status?}', 'Article\ArticleController@lists')->name('article-list'); // 文章列表
            Route::get('add', 'Article\ArticleController@add')->name('article-manage'); // add
            Route::post('add', 'Article\ArticleController@saveData')->name('article-manage'); // saveData
            Route::get('edit', 'Article\ArticleController@edit')->name('article-manage'); // edit
            Route::post('edit', 'Article\ArticleController@saveData')->name('article-manage'); // saveData
            Route::post('select-cat-type', 'Article\ArticleController@selectCatType'); // selectCatType
            Route::get('set-is-show', 'Article\ArticleController@setShow')->name('article-manage'); // setShow
            Route::get('set-is-recommend', 'Article\ArticleController@setIsRecommend')->name('article-manage'); // setShow
            Route::post('edit-article-info', 'Article\ArticleController@editArticleInfo')->name('article-manage'); // editArticleInfo
            Route::post('delete', 'Article\ArticleController@delete')->name('article-delete'); // delete
            Route::post('batch-delete', 'Article\ArticleController@batchDelete')->name('article-delete'); // batchDelete

            Route::get('picker', 'Article\ArticleController@picker'); // picker
        });
        // ArticleCat
        Route::group(['prefix' => 'article-cat'], function () {
            Route::get('list', 'Article\ArticleCatController@lists')->name('article-cat-list'); // 文章分类列表
            Route::get('add-category', 'Article\ArticleCatController@add')->name('article-cat-manage'); // add
            Route::post('add-category', 'Article\ArticleCatController@saveData')->name('article-cat-manage'); // saveData
            Route::get('edit-category', 'Article\ArticleCatController@edit')->name('article-cat-manage'); // edit
            Route::post('edit-category', 'Article\ArticleCatController@saveData')->name('article-cat-manage'); // saveData

            Route::get('select-cat-model', 'Article\ArticleCatController@selectCatModel'); // selectCatModel
            Route::get('select-cat-type', 'Article\ArticleCatController@selectCatType'); // selectCatType

            Route::get('set-is-show', 'Article\ArticleCatController@setShow')->name('article-cat-manage'); // setShow
            Route::post('edit-cat-info', 'Article\ArticleCatController@editCatInfo')->name('article-cat-manage'); // editCatInfo

            Route::post('del-category', 'Article\ArticleCatController@delCategory')->name('article-cat-delete'); // delCategory
        });
    });

});