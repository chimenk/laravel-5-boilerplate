<?php

/**
 * Frontend Controllers
 * All route names are prefixed with 'frontend.'.
 */
Route::get('/', 'FrontendController@index')->name('index');
Route::get('macros', 'FrontendController@macros')->name('macros');

/*
 * These frontend controllers require the user to be logged in
 * All route names are prefixed with 'frontend.'
 */
Route::group(['middleware' => 'auth'], function () {
    Route::get('ticket', 'User\TicketController@index')->name('ticket.index');
    Route::post('ticket/get', 'User\TicketController@getData')->name('ticket.get');
    Route::post('ticket/print', 'User\TicketController@TicketPrint')->name('ticket.print');
    Route::get('member', 'MemberController@index')->name('member.index');
    Route::post('member/get', 'MemberController@getData')->name('member.get');
    Route::get('member/create', 'MemberController@create')->name('member.create');
    Route::post('member', 'MemberController@store')->name('member.store');
    Route::get('member/{id}/edit', 'MemberController@edit')->name('member.edit');
    ROute::post('member/{id}/update', 'MemberController@update')->name('member.update');
    Route::delete('member/delete/{id}', 'MemberController@destroy')->name('member.destroy');
    Route::group(['namespace' => 'User', 'as' => 'user.'], function () {
        /*
         * User Dashboard Specific
         */
        Route::get('dashboard', 'DashboardController@index')->name('dashboard');

        /*
         * User Account Specific
         */
        Route::get('account', 'AccountController@index')->name('account');

        /*
         * User Profile Specific
         */
        Route::patch('profile/update', 'ProfileController@update')->name('profile.update');

    });
});
