<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});
Route::get('/',function (){
    return \App\Models\Applicants::all();
});

Route::group(['prefix' => 'work'], function (){
    Route::get('',[\App\Http\Controllers\WorkController::class, 'index'] );
    Route::post('',[\App\Http\Controllers\WorkController::class, 'store'] );
});
Route::group(['prefix' => 'recruiter'], function (){
    Route::get('',[\App\Http\Controllers\RecruiterController::class, 'index'] );
    Route::post('',[\App\Http\Controllers\RecruiterController::class, 'store'] );
    Route::get('{ID_Recruiter}',[\App\Http\Controllers\RecruiterController::class, 'show'] );
    Route::post('{ID_Recruiter}',[\App\Http\Controllers\RecruiterController::class, 'update'] );
});

Route::group(['prefix' => 'applicant'], function (){
    Route::get('',[\App\Http\Controllers\ApplicantsController::class, 'index'] );
    Route::post('',[\App\Http\Controllers\ApplicantsController::class, 'store'] );
    Route::get('{ID_Applicants}',[\App\Http\Controllers\ApplicantsController::class, 'show'] );
    Route::post('{ID_Applicants}',[\App\Http\Controllers\ApplicantsController::class, 'update'] );
});

Route::group(['prefix' => 'recruitment'], function (){
    Route::get('',[\App\Http\Controllers\ReruitmentController::class, 'index'] );
    Route::post('',[\App\Http\Controllers\ReruitmentController::class, 'store'] );
    Route::get('{ID_Recruitment}',[\App\Http\Controllers\ReruitmentController::class, 'show'] );
    Route::post('{ID_Recruitment}',[\App\Http\Controllers\ReruitmentController::class, 'update'] );

});
Route::group(['prefix' => 'style'], function (){
    Route::get('',function (){
        $data = \App\Models\Style::all();
        return response()->json([
            'data'=>$data,
            'message' => 'success'
        ]);
    } );
});

Route::get('search',[\App\Http\Controllers\ReruitmentController::class, 'search'] );
//Route::post('','WorkController@store' );