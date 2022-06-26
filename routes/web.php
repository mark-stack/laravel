<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\SocialController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\FullCalenderController;
use App\Http\Controllers\CheckoutController;


//Logout
Route::get('/logout', function(){
    Auth::logout();
    return redirect('/');
})->name('logout');

//Google Login
Route::get('/auth/redirect/google', [SocialController::class, 'redirect_google']);
Route::get('/callback/google', [SocialController::class, 'callback_google']);

//Linkedin Login
Route::get('/auth/redirect/linkedin', [SocialController::class, 'redirect_linkedin']);
Route::get('/callback/linkedin', [SocialController::class, 'callback_linkedin']);

//Backend (User)
Route::prefix('/user')->middleware(['auth','user'])->group(function () {
    //Dashboard
    Route::get('/', [UserController::class, 'dashboard']);
    
    //GraphQL
    //Route::get('/graphql', [UserController::class, 'exampleGraphql']);

    //Mobile verification
    //Route::get('/mobile', [UserController::class, 'exampleMobile']);

    //Stripe example
    Route::get('/stripe', [UserController::class, 'exampleStripe'])->name('billing');
    Route::get('/checkout/{id}', [CheckoutController::class, 'checkout'])->name('checkout');
    Route::post('/checkout', [CheckoutController::class, 'processCheckout'])->name('checkout.process');
    Route::get('/cancel', [UserController::class, 'stripeCancel'])->name('cancel');
    Route::get('/resume', [UserController::class, 'stripeResume'])->name('resume');

    //Calender example
    Route::get('/calendar', [FullCalenderController::class, 'index'])->name('calendar');
    Route::post('/fullcalendarAjax', [FullCalenderController::class, 'ajax']);

    //Social login example (Google, Linkedin)
    Route::get('/socials', [UserController::class, 'exampleSocials']);

    //Projects redirect
    Route::get('/projects/{name}', [UserController::class, 'internalProjects']);
});

//Backend (Admin)
Route::prefix('/admin')->middleware(['auth','admin'])->group(function () {
    Route::get('/', [AdminController::class, 'dashboard']);
    Route::resource('/projects', ProjectController::class);
    Route::get('/project-position/up/{id}', [AdminController::class, 'projectPositionUp']);
    Route::get('/project-position/down/{id}', [AdminController::class, 'projectPositionDown']);
});

//Frontend
Route::controller(FrontendController::class)->group(function () {
    Route::get('/remember-project/{name}/{social}', 'socialLoginRememberProject');
    Route::get('/{tag?}', 'landing')->name('landing');
});
