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
    if ($user->type == App\User::TYPE_TEACHER) {
        return redirect('/teacher/room');
    } else {
        return redirect('/student/room');
    }
})->middleware('auth');

Route::group(['namespace' => 'Student', 'middleware' => ['auth'], 'prefix' => 'student'], function () {
    Route::group(['prefix' => 'room'], function () {
        Route::get('/', 'RoomController@index')->name('student.room.index');
        Route::get('/homepage', 'RoomController@getAnotherRooms')->name('student.room.homepage');
        Route::get('/{id}', 'RoomController@show')->name('student.room.show');
        Route::put('/checkpass/{id}', 'RoomController@checkPassword')->name('student.room.checkpassword');
        Route::delete('/{id}/destroy', 'RoomController@destroy')->name('student.room.destroy');
        Route::group(['prefix' => '/{room_id}/examination'], function () {
            Route::get('/', 'ExaminationController@index')->name('student.examination.index');
            // Route::get('/create', 'ExaminationController@create')->name('teacher.examination.create');
            // Route::post('/', 'ExaminationController@store')->name('teacher.examination.store');
            // Route::get('/{id}/edit', 'ExaminationController@edit')->name('teacher.examination.edit');
            // Route::get('/{id}', 'ExaminationController@show')->name('teacher.examination.show');
            // Route::delete('/{id}', 'ExaminationController@destroy')->name('teacher.examination.destroy');
        });


    });


});
Route::group(['namespace' => 'Teacher', 'middleware' => ['auth'], 'prefix' => 'teacher'], function () {
    Route::group(['prefix' => 'room'], function () {
        Route::get('/', 'RoomController@index')->name('teacher.room.index');
        Route::get('/create', 'RoomController@create')->name('teacher.room.create');
        Route::post('/', 'RoomController@store')->name('teacher.room.store');
        Route::get('/{id}/edit', 'RoomController@edit')->name('teacher.room.edit');
        Route::put('/{id}', 'RoomController@update')->name('teacher.room.update');
        //Route::get('/{id}', 'RoomController@show')->name('teacher.room.show');
        Route::delete('/{id}/destroy', 'RoomController@destroy')->name('teacher.room.destroy');
        Route::group(['prefix' => '/{room_id}/examination'], function () {
            Route::get('/', 'ExaminationController@index')->name('teacher.examination.index');
            Route::get('/create', 'ExaminationController@create')->name('teacher.examination.create');
            Route::post('/', 'ExaminationController@store')->name('teacher.examination.store');
            Route::get('/{id}', 'ExaminationController@show')->name('teacher.examination.show');
            Route::get('/{id}/edit', 'ExaminationController@edit')->name('teacher.examination.edit');
            Route::delete('/{id}/destroy', 'ExaminationController@destroy')->name('teacher.examination.destroy');

            // Thao tác với Question và Answer

            Route::group(['prefix' => '/{examination_id}/question'], function () {

                Route::get('/create', 'QuestionController@create')->name('teacher.question.create');
                Route::post('/store', 'QuestionController@store')->name('teacher.question.store');
                    Route::group(['prefix' => '/{question_id}/answer'], function () {

                        Route::get('/create', 'AnswerController@create')->name('teacher.answer.create');
                        Route::post('/store', 'AnswerController@store')->name('teacher.answer.store');


                    });


            });

        });

    });
});



