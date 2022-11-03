<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookmarksController;
use App\Http\Controllers\FoldersController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//Bookmark routes
Route::get('/v1/bookmarks', [BookmarksController::class, 'bookmarkList']);

Route::get('/v1/bookmarks', [BookmarksController::class, 'bookmarkList']);
Route::get(
    '/v1/bookmarks/folders/{id}', 
    [BookmarksController::class, 'bookmarkListByFolder']
);
Route::post('/v1/bookmarks', [BookmarksController::class, 'store']);
Route::put('/v1/bookmarks/{id}', [BookmarksController::class, 'update']);
Route::delete('/v1/bookmarks/{id}', [BookmarksController::class, 'destroy']);


// Folder routes
Route::get('/v1/folders', [FoldersController::class, 'folderList']);
Route::post('/v1/folders', [FoldersController::class, 'store']);
Route::put('/v1/folders/{id}', [FoldersController::class, 'update']);
Route::delete('/v1/folders/{id}', [FoldersController::class, 'destroy']);
