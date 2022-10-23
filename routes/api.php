<?php

use App\Http\Controllers\Api\v1\AuthController;
use App\Http\Controllers\Api\v1\ListedHorsesController;
use App\Http\Controllers\Api\v1\ProfileController;
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

Route::prefix('v1')->group(
  function () {
    Route::prefix('customer')->group(
      function () {
        Route::prefix('auth')->controller(AuthController::class)->group(
          function () {
            Route::post('register', 'register');
            Route::post('login', 'login');
            Route::post('reset-password', 'resetPassword');
            Route::post('check-email', 'checkCustomerEmail');
            Route::post('logout', 'logout');
          }
        );
        Route::middleware('auth:api')->group(function () {
          Route::get('profile', [ProfileController::class, 'index']);
          Route::post('profile', [ProfileController::class, 'update']);
        });
        Route::prefix('listed-horses')->group(function () {
          Route::get('/', [ListedHorsesController::class, 'index']);
        });
      }
    );
  }
);
