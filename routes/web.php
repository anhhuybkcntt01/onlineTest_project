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

Auth::routes();
Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', function () {
    $user = Auth::user();
    if($user->type == App\User::TYPE_TEACHER){
        return redirect('/teacher/room');
    }else{
        return redirect('/student/room');
    }
})->middleware('auth');

Route::group(['namespace'=>'Teacher', 'middleware' => ['auth'], 'prefix'=> 'teacher'],function(){
        Route::group(['prefix'=>'room'], function(){
            Route::get('/', 'RoomController@index')->name('teacher.room.index');
            Route::get('/create', 'RoomController@create')->name('teacher.room.create');
            Route::post('/', 'RoomController@store')->name('teacher.room.store');
            Route::get('/{id}/edit', 'RoomController@edit')->name('teacher.room.edit');
            Route::put('/{id}', 'RoomController@update')->name('teacher.room.update');
            Route::get('/{id}', 'RoomController@show')->name('teacher.room.show');
            Route::delete('/{id}', 'RoomController@destroy')->name('teacher.room.destroy');
        });

});



