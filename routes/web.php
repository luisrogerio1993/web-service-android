<?php

Route::get('/', 'SiteController@index')->name('notices.index');
Route::post('/', 'SiteController@store')->name('notices.store');
Route::delete('/{id}', 'SiteController@destroy')->name('notices.destroy');