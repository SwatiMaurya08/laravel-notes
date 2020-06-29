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

use Illuminate\Support\Facades\Auth;

Route::get('/', [
    'uses' => 'PostController@getIndex',
    'as' => 'blog.index'
]);

/*
Simpler possibility in choosing the controller:
Route::get('/', 'PostController@getIndex')->name('blog.index');
*/

Route::get('post/{id}/like', [
    'uses' => 'PostController@getLikePost',
    'as' => 'blog.post.like'
]);

Route::get('post/{id}', [
    'uses' => 'PostController@getPost',
    'as' => 'blog.post'
]);


Route::get('about', function () {
    return view('others.about');
})->name('others.about');

Route::group(['prefix' => 'admin'], function () {

    Route::get('', [
        'uses' => 'PostController@getAdminIndex',
        'as' => 'admin.index'
    ]);

    Route::get('create', [
        'uses' => 'PostController@getAdminCreate',
        'as' => 'admin.create'
    ]);

    Route::post('create', [
        'uses' => 'PostController@postAdminCreate',
        'as' => 'admin.create'
    ]);

    Route::get('edit/{id}', [
        'uses' => 'PostController@getAdminEdit',
        'as' => 'admin.edit'
    ]);

    Route::get('delete/{id}', [
        'uses' => 'PostController@getAdminDelete',
        'as' => 'admin.delete'
    ]);


    Route::post('edit', [
        'uses' => 'PostController@postAdminUpdate',
        'as' => 'admin.update'
    ]);


    Route::get('contact', function () {

        $question = [
            'questionnaire' => 'Do you have any questions? Please do not hesitate to contact us directly.
         Our team will come back to you within a matter of hours to help you.',

            'location' => 'Hno P-704, Sheeta Baug, Bhosari - 411039',
            'contact' => '8806905826',
            'mail' => 'swatimaurya@softhinkers.com',
            'name' => 'Adarsh Maurya',
            'email' => 'adarshmaurya@softhinkers.com',
            'subject' => 'About Softhinkers Services',
            'message' => 'I highly appreciated your ideas about the Softhinkers website'

        ];
        return view('others.contact', ['contact' => $question]);
    })->name('others.contact');

});

Auth::routes();


Route::post('login', [
    'uses' => 'SignInController@signin',
    'as' => 'auth.signin'
]);

Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');
