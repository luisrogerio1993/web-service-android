<?php
Route::group(['prefix' => 'v1'], function(){
    Route::get('/notices', 'ApiSiteController@getAllNotices')->name('api.notices');
    Route::get('/notice/{id}', 'ApiSiteController@getNotice')->name('api.notice');
});