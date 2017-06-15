<?php

/**
 * All route names are prefixed with 'admin.'.
 */
Route::get('dashboard', 'DashboardController@index')->name('dashboard');
Route::get('report', 'DashboardController@report')->name('report');
Route::post('report/create', 'DashboardController@reporting')->name('report.create');
Route::get('ticket-price', '\App\Http\Controllers\Frontend\User\TicketController@price')->name('ticket.price');
Route::get('ticket/create', '\App\Http\Controllers\Frontend\User\TicketController@create')->name('ticket.create');
Route::get('ticket/{id}/edit', '\App\Http\Controllers\Frontend\User\TicketController@edit')->name('ticket.edit');
Route::post('ticket/create', '\App\Http\Controllers\Frontend\User\TicketController@store')->name('ticket.store');
Route::post('ticket/{id}/update', '\App\Http\Controllers\Frontend\User\TicketController@update')->name('ticket.update');
Route::delete('ticket/delete/{id}', '\App\Http\Controllers\Frontend\User\TicketController@destroy')->name('ticket.destroy');