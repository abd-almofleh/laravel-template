<?php

use App\Http\Controllers\Api\v1\AuthController;
use App\Http\Controllers\Api\v1\CMSBlogController;
use App\Http\Controllers\Api\v1\ListedHorsesController;
use App\Http\Controllers\Api\v1\ProfileController;
use App\Http\Controllers\Global\RequestHorseCare;
use App\Http\Controllers\Global\StoreSuggestion;
use App\Http\Middleware\Api\CheckValidatePhoneNumberUsingOTP;
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

Route::prefix('v1')->middleware(CheckValidatePhoneNumberUsingOTP::class)->group(
  function () {
    Route::prefix('customer')->group(
      function () {
        Route::prefix('auth')->controller(AuthController::class)->group(
          function () {
            Route::post('register', 'register');
            Route::post('login', 'login');
            Route::patch('phone-number', 'updatePhoneNumber')->withoutMiddleware(CheckValidatePhoneNumberUsingOTP::class);
            Route::prefix('otp')->group(function () {
              Route::prefix('phone-number')->withoutMiddleware(CheckValidatePhoneNumberUsingOTP::class)->group(function () {
                Route::post('request', 'requestPhoneNumberVerificationOtp');
                Route::post('validate', 'validatePhoneNumberThroughOTP');
              });
              Route::prefix('reset-password')->group(function () {
                Route::post('request', 'requestResetPasswordThroughPhoneNumber');
                Route::post('check', 'checkResetPasswordOTP');
                Route::post('reset', 'resetPasswordOTP');
              });
            });
            Route::middleware('auth:api')->group(function () {
              Route::post('logout', 'logout')->withoutMiddleware(CheckValidatePhoneNumberUsingOTP::class);
              Route::delete('account', 'deleteAccount');
            });
          }
        );
        Route::middleware('auth:api')->prefix('profile')->controller(ProfileController::class)->group(function () {
          Route::get('/', 'index');
          Route::put('/', 'update');
          Route::patch('phone-number', 'updatePhoneNumber');
        });

        Route::prefix('listed-horses')->controller(ListedHorsesController::class)->group(function () {
          Route::get('/', 'index');
          Route::get('/recent', 'recentHorses');
          Route::get('/get-filter-options', 'get_filter_options');
          Route::get('/types', 'getHorsesTypes');
          Route::middleware('auth:api')->group(function () {
            Route::post('/order/{listedHorse}', 'order');
          });
        });

        Route::prefix('blogs')->controller(CMSBlogController::class)->group(function () {
          Route::get('/', 'index');
          Route::get('/get-filter-options', 'get_filter_options');
          Route::get('/recent', 'recentBlogs');
        });
        Route::withoutMiddleware(CheckValidatePhoneNumberUsingOTP::class)->group(function () {
          Route::post('suggestion', StoreSuggestion::class);
          Route::post('horse-care', RequestHorseCare::class);
        });
      }
    );
  }
);
