<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\FamilyControllers;

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

Route::middleware('auth')->get('/user', function (Request $request) {
    return $request->user();
});


Route::group(['middleware' => 'auth'], function () {
    Route::get('/users', [UsersController::class, 'index']);

    Route::get('/getFatherList', [FamilyControllers::class, 'getFatherList']);
    Route::get('/getMotherList', [FamilyControllers::class, 'getMotherList']);
    Route::get('/getWifeList', [FamilyControllers::class, 'getWifeList']);
    Route::get('/getHusbandList', [FamilyControllers::class, 'getHusbandList']);

    Route::post('/setFather', [FamilyControllers::class, 'setFather']);
    Route::post('/setMother', [FamilyControllers::class, 'setMother']);
    Route::post('/setWife', [FamilyControllers::class, 'setWife']);
    Route::post('/setHusband', [FamilyControllers::class, 'setHusband']);
    Route::post('/setChild', [FamilyControllers::class, 'setChild']);
});