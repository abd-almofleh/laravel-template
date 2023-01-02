<?php

use Illuminate\Support\Facades\Route;

Route::get('setlocale/{locale}', function ($lang) {
  \Session::put('locale', $lang);
  return redirect()->back();
})->name('setlocale');

Route::group(['middleware' => 'language'], function () {
  //!/* -------------------------------------------------------------------------- */
  //!/*                                Admin Routes                                */
  //!/* -------------------------------------------------------------------------- */
  Route::prefix('admin')->group(function () {
    Route::redirect('/', url('admin/dashboard'));
    Route::get('/login', [App\Http\Controllers\Auth\LoginController::class, 'login'])->name('login');
    Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'login_go'])->name('login_go');
    Route::get('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');

    Route::get('forget-password', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'showForgetPasswordForm'])->name('forget.password.get');
    Route::post('forget-password', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'submitForgetPasswordForm'])->name('forget.password.post');

    Route::get('reset-password/{token}', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'showResetPasswordForm'])->name('reset.password.get');
    Route::post('reset-password', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post');

    //!/* ----------------------- Admin Authenticated Routes ----------------------- */
    Route::group(['middleware' => ['auth:admin']], function () {
      Route::get('/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'dashboard'])->name('dashboard');

      //!/* ------------------------------ Profile ------------------------------ */
      Route::get('/profile', [App\Http\Controllers\Admin\UserController::class, 'profile'])->name('profile');
      Route::post('/profile/update/{id}', [App\Http\Controllers\Admin\UserController::class, 'profile_update'])->name('profile.update');

      //!/* ---------------------------------- User ---------------------------------- */
      Route::prefix('users')->group(function () {
        Route::get('/index', [App\Http\Controllers\Admin\UserController::class, 'index'])->name('users.index');
        Route::get('/create', [App\Http\Controllers\Admin\UserController::class, 'create'])->name('users.create');
        Route::post('/store', [App\Http\Controllers\Admin\UserController::class, 'store'])->name('users.store');
        Route::get('/edit/{id}', [App\Http\Controllers\Admin\UserController::class, 'edit'])->name('users.edit');
        Route::post('/update/{id}', [App\Http\Controllers\Admin\UserController::class, 'update'])->name('users.update');
        Route::post('/destroy', [App\Http\Controllers\Admin\UserController::class, 'destroy'])->name('users.destroy');
        Route::get('/status_update', [App\Http\Controllers\Admin\UserController::class, 'status_update'])->name('users.status_update');
      });
      //!/* -------------------------------- Customers ------------------------------- */
      Route::prefix('customers')->name('admin.customers.')->controller(App\Http\Controllers\Admin\CustomersController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/{customer}', 'edit')->name('edit');
        Route::put('/{customer}', 'update')->name('update');
        Route::delete('/{customer}', 'destroy')->name('destroy');
      });

      //!/* ---------------------------------- Role ---------------------------------- */
      Route::prefix('roles')->group(function () {
        Route::get('/index', [App\Http\Controllers\Admin\RoleController::class, 'index'])->name('roles.index');
        Route::get('/create', [App\Http\Controllers\Admin\RoleController::class, 'create'])->name('roles.create');
        Route::post('/store', [App\Http\Controllers\Admin\RoleController::class, 'store'])->name('roles.store');
        Route::get('/edit/{id}', [App\Http\Controllers\Admin\RoleController::class, 'edit'])->name('roles.edit');
        Route::post('/update/{id}', [App\Http\Controllers\Admin\RoleController::class, 'update'])->name('roles.update');
        Route::post('/destroy', [App\Http\Controllers\Admin\RoleController::class, 'destroy'])->name('roles.destroy');
      });

      //!/* ------------------------------- Permission ------------------------------- */
      Route::prefix('permissions')->group(function () {
        Route::get('/index', [App\Http\Controllers\Admin\PermissionController::class, 'index'])->name('permissions.index');
        Route::get('/create', [App\Http\Controllers\Admin\PermissionController::class, 'create'])->name('permissions.create');
        Route::post('/store', [App\Http\Controllers\Admin\PermissionController::class, 'store'])->name('permissions.store');
        Route::get('/edit/{id}', [App\Http\Controllers\Admin\PermissionController::class, 'edit'])->name('permissions.edit');
        Route::post('/update/{id}', [App\Http\Controllers\Admin\PermissionController::class, 'update'])->name('permissions.update');
        Route::post('/destroy', [App\Http\Controllers\Admin\PermissionController::class, 'destroy'])->name('permissions.destroy');
      });

      //!/* -------------------------------- Currency -------------------------------- */
      Route::prefix('currencies')->group(function () {
        Route::get('/index', [App\Http\Controllers\Admin\CurrencyController::class, 'index'])->name('currencies.index');
        Route::get('/create', [App\Http\Controllers\Admin\CurrencyController::class, 'create'])->name('currencies.create');
        Route::post('/store', [App\Http\Controllers\Admin\CurrencyController::class, 'store'])->name('currencies.store');
        Route::get('/edit/{id}', [App\Http\Controllers\Admin\CurrencyController::class, 'edit'])->name('currencies.edit');
        Route::post('/update/{id}', [App\Http\Controllers\Admin\CurrencyController::class, 'update'])->name('currencies.update');
        Route::post('/destroy', [App\Http\Controllers\Admin\CurrencyController::class, 'destroy'])->name('currencies.destroy');
        Route::get('/status_update', [App\Http\Controllers\Admin\CurrencyController::class, 'status_update'])->name('currencies.status_update');
      });

      //!/* --------------------------------- Setting -------------------------------- */
      Route::prefix('setting')->group(function () {
        Route::get('/file-manager/index', [App\Http\Controllers\Admin\FileManagerController::class, 'index'])->name('filemanager.index');
        Route::get('/website-setting/edit', [App\Http\Controllers\Admin\SettingController::class, 'edit'])->name('website-setting.edit');
        Route::post('/website-setting/update/{id}', [App\Http\Controllers\Admin\SettingController::class, 'update'])->name('website-setting.update');
      });
      //!/* ----------------------------------- CMS ---------------------------------- */
      Route::prefix('cms')->name('cms.')->group(function () {
        Route::patch('/categories/update-status/{category}', [App\Http\Controllers\Admin\Cms\CMSCategoryController::class, 'update_status'])->name('categories.update_status');
        Route::resource('categories', App\Http\Controllers\Admin\Cms\CMSCategoryController::class)->except(['show', 'destroy']);

        Route::post('blogs/media', [App\Http\Controllers\Admin\Cms\CMSBlogController::class, 'storeMedia'])->name('blogs.storeMedia');
        Route::resource('blogs', App\Http\Controllers\Admin\Cms\CMSBlogController::class)->scoped([
          'blog' => 'id',
        ]);
      });

      //!/* --------------------------------- horses --------------------------------- */
      Route::prefix('horses')->name('horses.')->group(function () {
        Route::post('listed-horses/media', [App\Http\Controllers\Admin\Horses\ListedHorseController::class, 'storeMedia'])->name('listed-horses.storeMedia');
        Route::resource('listed-horses', App\Http\Controllers\Admin\Horses\ListedHorseController::class);

        Route::patch('/types/updateStatus/{type}', [App\Http\Controllers\Admin\Horses\HorseTypeController::class, 'updateStatus'])->name('types.updateStatus');
        Route::post('types/media', [App\Http\Controllers\Admin\Horses\HorseTypeController::class, 'storeMedia'])->name('types.storeMedia');
        Route::resource('types', App\Http\Controllers\Admin\Horses\HorseTypeController::class)->except(['show', 'destroy']);

        Route::patch('/passports/updateStatus/{passport}', [App\Http\Controllers\Admin\Horses\HorsePassportController::class, 'updateStatus'])->name('passports.updateStatus');
        Route::resource('passports', App\Http\Controllers\Admin\Horses\HorsePassportController::class)->except(['show', 'destroy']);
      });
    });
  });

  //!/* -------------------------------------------------------------------------- */
  //!/*                               Frontend Routes                              */
  //!/* -------------------------------------------------------------------------- */
  Route::middleware([App\Http\Middleware\CheckValidatePhoneNumberUsingOTP::class])->group(function () {
    Route::get('/', [App\Http\Controllers\Frontend\HomeController::class, 'index'])->name('home');
    Route::get('about-us', [App\Http\Controllers\Frontend\HomeController::class, 'aboutUs'])->name('about_us');
    Route::get('contact-us', [App\Http\Controllers\Frontend\HomeController::class, 'contactUs'])->name('contact_us');

    //!/* -------------------------------------------------------------------------- */
    //!/*                               Customer Routes                              */
    //!/* -------------------------------------------------------------------------- */
    Route::prefix('customer')->name('customer.')->group(function () {
      Route::name('auth.')->controller(App\Http\Controllers\Frontend\Customer\AuthCustomerController::class)->group(function () {
        Route::get('login', 'loginView')->name('login');
        Route::post('login', 'login')->name('login.attempt');
        Route::prefix('reset-password')
        ->name('reset_password.')
        ->withoutMiddleware([CheckValidatePhoneNumberUsingOTP::class])
        ->group(function () {
          Route::get('/', 'requestResetPasswordView')->name('form');
          Route::post('request', 'requestResetPassword')->name('request');
          Route::get('validate-otp', 'validateResetPasswordOTPView')->name('validate.view');
          Route::post('validate-otp', 'validateResetPasswordOTP')->name('validate');
          Route::get('new-password', 'resetPasswordView')->name('new_password.view');
          Route::post('new-password', 'resetPassword')->name('new_password');
          Route::post('resend-otp', 'requestResetPasswordThroughPhoneNumber')->name('resend_otp');
        });
        Route::get('signup', 'signupForm')->name('signup.form');
        Route::post('signup', 'signup')->name('signup');
        Route::group(['middleware' => ['auth:customer_frontend']], function () {
          Route::post('logout', 'logout')->name('logout')->withoutMiddleware([CheckValidatePhoneNumberUsingOTP::class]);
          Route::delete('account', 'deleteAccount')->name('account.delete');
          Route::withoutMiddleware([CheckValidatePhoneNumberUsingOTP::class])
          ->name('account.validate_phone_number.')
          ->prefix('validate-phone-number')
          ->group(function () {
            Route::get('', 'validatePhoneNumberView')->name('view');
            Route::post('', 'validatePhoneNumber')->name('validate');
            Route::post('request', 'requestPhoneNumberVerificationOtp')->name('request');
            Route::get('change-phone-number', 'updatePhoneNumberView')->name('change_phone_number.view');
            Route::post('change-phone-number', 'updatePhoneNumber')->name('change_phone_number.update');
          });
        });
      });

      //!/* ---------------------- Customer Authenticated Routes --------------------- */
      Route::group(['middleware' => ['auth:customer_frontend']], function () {
        //!/* --------------------------------- Profile -------------------------------- */
        Route::get('/profile', [App\Http\Controllers\Frontend\Customer\ProfileController::class, 'index'])->name('profile');
        Route::put('/profile', [App\Http\Controllers\Frontend\Customer\ProfileController::class, 'update'])->name('profile.update');
      });
    });

    //!/* ------------------------------ Blogs Routes ------------------------------ */
    Route::prefix('blogs')->name('blogs.')->group(function () {
      Route::get('/', [App\Http\Controllers\Frontend\BlogsController::class, 'index'])->name('list');
      Route::get('/{blog}', [App\Http\Controllers\Frontend\BlogsController::class, 'show'])->name('show');
    });

    //!/* -------------------------- Listed horses Routes -------------------------- */
    Route::prefix('listed-horses')->name('listed_horses.')->group(function () {
      Route::get('/', [App\Http\Controllers\Frontend\ListedHorsesController::class, 'index'])->name('list');
      Route::get('/{listedHorse}', [App\Http\Controllers\Frontend\ListedHorsesController::class, 'show'])->name('show');
    });
  });
});
