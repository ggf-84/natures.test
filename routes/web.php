<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

\localizer\group([], function () {
    Route::get('/', ['uses' => 'WelcomeController@index', 'as' => 'welcome']);

    Route::get('/{type}', ['uses' => 'PageController@index', 'as' => 'page.show'])
        ->where('type', '(' . implode('|', \App\Paragraph::typesList()) . ')');

    Route::get('/plant-a-tree', ['uses' => 'DonationController@index', 'as' => 'donation']);
    Route::post('/plant-a-tree', ['uses' => 'DonationController@storage', 'as' => 'donation.storage']);

    Route::get('/credits', function () {
        return view('credits');
    })->name('credits');

    #subscribe
    Route::post('subscribe', ['uses' => 'Api\SubscribeController@subscribe', 'as' => 'subscribe']);

    Route::get('/payment/finish', ['uses' => 'PayController@paid', 'as' => 'finish-payment']);
    Route::get('/thank-you', ['uses' => 'PayController@thankYou', 'as' => 'thank-you']);

    Route::get('/test-pdf/{donation}', 'PayController@testPdf');

    Route::get('carbon-footprint-calculator','CarbonFootprintCalculatorController@calculator')->name('calculator');
});


Route::group(['prefix' => 'cms', 'middleware' => [
    'web',
    \Terranet\Administrator\Middleware\AuthProvider::class,
    \Terranet\Administrator\Middleware\Authenticate::class,
]], function () {
    Route::group(['prefix' => 'translations'], function () {
        Route::get('/')->name('translations.index')->uses('Admin\TranslationsController@index');
        Route::post('/')->name('translations.store')->uses('Admin\TranslationsController@store');
    });
});
