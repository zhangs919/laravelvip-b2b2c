<?php

Route::group(['domain' => config('lrw.seller_domain')], function ($router) {

    // Article Route
    Route::group(['prefix' => 'article'], function () {
        // Article
        Route::group(['prefix' => 'article'], function () {
            Route::get('list/{status?}', 'Article\ArticleController@lists'); // lists
            Route::get('add', 'Article\ArticleController@add'); // add
            Route::post('add', 'Article\ArticleController@saveData'); // saveData
            Route::get('edit', 'Article\ArticleController@edit'); // edit
            Route::post('edit', 'Article\ArticleController@saveData'); // saveData
            Route::post('select-cat-type', 'Article\ArticleController@selectCatType'); // selectCatType
            Route::get('set-is-show', 'Article\ArticleController@setShow'); // setShow
            Route::get('set-is-recommend', 'Article\ArticleController@setIsRecommend'); // setShow
            Route::post('edit-article-info', 'Article\ArticleController@editArticleInfo'); // editArticleInfo
            Route::post('delete', 'Article\ArticleController@delete')->name('delete'); // delete
            Route::post('batch-delete', 'Article\ArticleController@batchDelete')->name('batch-delete'); // batchDelete

			Route::get('picker', 'Article\ArticleController@picker'); // picker
        });
    });

});
