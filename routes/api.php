<?php

use App\Http\Controllers\ApiControllers\BoxesController;
use App\Http\Controllers\ApiControllers\CellsController;
use App\Http\Controllers\ApiControllers\FilesController;
use App\Http\Controllers\ApiControllers\FoldersController;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/boxes', [BoxesController::class, 'index']);
Route::post('/boxes', [BoxesController::class, 'store']);
Route::get('/boxes/{id}', [BoxesController::class, 'show']);
Route::match(['put', 'patch'], '/boxes/{id}', [BoxesController::class, 'update']);
Route::delete('/boxes/{id}', [BoxesController::class, 'destroy']);

Route::get('/cells', [CellsController::class, 'index']);
Route::post('/cells', [CellsController::class, 'store']);
Route::get('/cells/{id}', [CellsController::class, 'show']);
Route::match(['put', 'patch'], '/cells/{id}', [CellsController::class, 'update']);
Route::delete('/cells/{id}', [CellsController::class, 'destroy']);

Route::get('/folders', [FoldersController::class, 'index']);
Route::post('/folders', [FoldersController::class, 'store']);
Route::get('/folders/{id}', [FoldersController::class, 'show']);
Route::match(['put', 'patch'], '/folders/{id}', [FoldersController::class, 'update']);
Route::delete('/folders/{id}', [FoldersController::class, 'destroy']);

Route::get('/files', [FilesController::class, 'index']);
Route::post('/files', [FilesController::class, 'store']);
Route::get('/files/{id}', [FilesController::class, 'show']);
Route::get('/files/{id}', [FilesController::class, 'getFile']);
Route::match(['put', 'patch'], '/files/{id}', [FilesController::class, 'update']);
Route::delete('/files/{id}', [FilesController::class, 'destroy']);



//Route::resource('/boxes', 'BoxController');
//Route::resource('/cells', 'CellController');
//Route::resource('/files', 'FileController');
//Route::resource('/folders', 'FolderController');











