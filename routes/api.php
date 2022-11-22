<?php

use App\Http\Controllers\Api\v1\AuthController;
use App\Http\Controllers\Api\v1\CMSBlogController;
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
            Route::middleware('auth:api')->group(function () {
              Route::post('logout', 'logout');
              Route::delete('account', 'deleteAccount');
            });
          }
        );
        Route::middleware('auth:api')->group(function () {
          Route::get('profile', [ProfileController::class, 'index']);
          Route::put('profile', [ProfileController::class, 'update']);
        });
        Route::prefix('listed-horses')->controller(ListedHorsesController::class)->group(function () {
          Route::get('/', 'index');
          Route::get('/get-filter-options', 'get_filter_options');
          Route::middleware('auth:api')->group(function () {
            Route::post('/order/{listedHorse}', 'order');
          });
        });
        Route::prefix('blogs')->controller(CMSBlogController::class)->group(function () {
          Route::get('/', 'index');
          Route::get('/get-filter-options', 'get_filter_options');
        });
      }
    );
  }
);
