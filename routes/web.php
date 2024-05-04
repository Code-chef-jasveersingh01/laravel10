<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;

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

Route::get('/', function () {
    return view('auth.main-login');
});

Route::get('/dashboard', function () {
    return view('admin.dashboard.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');



Route::middleware('auth')->group(function () {
    #default routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


     #admin profile route
      Route::get('/dashboard', [HomeController::class, 'index'])->name('admin.dashboard');
    //  Route::get('/profile', [HomeController::class, 'profile'])->name('admin.profile');
    //  Route::post('/profile/update', [HomeController::class, 'updateProfile'])->name('admin.updateProfile');
    //  Route::post('/profile/update-profile-image', [HomeController::class, 'updateProfileImage'])->name('admin.updateProfileImage');
    //  Route::get('/change-password', [HomeController::class, 'changePassword'])->name('admin.changePassword');
    //  Route::post('/change-password/store', [HomeController::class, 'changePasswordStore'])->name('admin.changePasswordStore');
    //  Route::post('/notification', [HomeController::class, 'newOrderNotification'])->name('admin.newOrderNotification');
    //  Route::post('/mark-as-read', [HomeController::class, 'markNotification'])->name('admin.markNotification');
    //  Route::get('/change-language/{lang}',[HomeController::class, 'changeLanguage'])->name('admin.changeLanguage');

    Route::group(['prefix' => 'user',], function () {
        #admin user route
            Route::get('/', [UserController::class, 'usersList'])->name('admin.usersList');
            Route::get('/view/{uuid}', [UserController::class, 'viewUser'])->name('admin.viewUser');
            Route::get('/edit/{uuid}', [UserController::class, 'editUser'])->name('admin.editUser');
            Route::post('/user-image/{uuid}', [UserController::class, 'updateUserImage'])->name('admin.updateUserImage');
            Route::post('/edit/{uuid}', [UserController::class, 'updateUser'])->name('admin.updateUser');
            Route::delete('/delete/{id}', [UserController::class, 'destroyUser'])->name('admin.destroyUser');
            Route::get('/deleted-user-info', [UserController::class, 'deletedUserInfo'])->name('admin.deletedUserInfo');
            Route::post('/restore-user', [UserController::class, 'restoreDeletedUser'])->name('admin.restoreDeletedUser');
            Route::delete('/force-delete-user/{id}', [UserController::class, 'forceDeleteUser'])->name('admin.forceDeleteUser');
    });




});

require __DIR__.'/auth.php';
