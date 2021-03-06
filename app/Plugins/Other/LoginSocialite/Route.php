<?php
/**
 * Route front
 * github, facebook, google
 */
if(bc_config('LoginSocialite')) {
Route::group(
    [
        'prefix'    => 'plugin/login_socialite',
        'namespace' => 'App\Plugins\Other\LoginSocialite\Controllers',
    ],
    function () {
        Route::get('{provider}', 'FrontController@redirectToProvider')
        ->name('login_socialite.index');
        Route::get('{provider}/callback', 'FrontController@handleProviderCallback')
        ->name('login_socialite.callback');
    }
);
}
/**
 * Route admin
 */
Route::group(
    [
        'prefix' => BC_ADMIN_PREFIX.'/login_socialite',
        'middleware' => BC_ADMIN_MIDDLEWARE,
        'namespace' => 'App\Plugins\Other\LoginSocialite\Admin',
    ], 
    function () {
        Route::get('/', 'AdminController@index')
        ->name('admin_login_socialite.index');
    }
);
