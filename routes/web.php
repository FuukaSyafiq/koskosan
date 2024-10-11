<?php

use App\Http\Controllers\IndexController;
use App\Http\Controllers\KosController;
use App\Http\Controllers\PermissionAdmin;
use App\Http\Controllers\PermissionManager;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ListRoomController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\TipeRoomController;
use App\View\Components\Denah;
use App\View\Components\EditUserProfile;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


// Route::get('/createReport', [CreateReport::class, 'index']);

//
Route::get('/', [IndexController::class, 'gets'])->name('index');
Route::post('/', [IndexController::class, 'store']);
Route::get('/roomlist', [ListRoomController::class, 'gets']);
Route::post('/roomlist', [ListRoomController::class, 'store']);
Route::get('/room/{id}', [RoomController::class, 'details']);
Route::get('/denah', [Denah::class, 'render']);

Route::get('/tiperoom/{id}', [TipeRoomController::class, 'details']);
//permission manager route (for debug purpose)
Route::post("/roles", [RoleController::class, "store"]);
Route::delete("/roles", [RoleController::class, "delete"]);

Route::middleware('auth')->group(function () {
    // fitur routing

    Route::get('/editprofile', [EditUserProfile::class, 'render']);
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
require __DIR__ . '/rating.php';
