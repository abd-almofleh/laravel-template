<?php

use App\Http\Controllers\Api\v1\AuthController;
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
        Route::prefix('auth')->group(
          function () {
            Route::post('register', [AuthController::class, 'register']);
            Route::post('login', [AuthController::class, 'login']);
            Route::post('reset-password', [AuthController::class, 'resetPassword']);
            Route::post('check-email', [AuthController::class, 'checkCustomerEmail']);
            Route::post('logout', [AuthController::class, 'logout']);
          }
        );
        Route::middleware('auth:api')->group(function () {
          Route::get('profile', [ProfileController::class, 'update']);
          Route::post('profile', [ProfileController::class, 'update']);
        });
      }
    );
  }
);
