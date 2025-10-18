<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\AuthController;

Route::prefix('admin')->group(function () {
    Route::get('/', [UserController::class, 'index'])->name('admin.users');
    Route::get('/deletedUsers', [UserController::class, 'deletedUsers'])->name('admin.deletedUsers');
    Route::get('/create', [UserController::class, 'create'])->name('admin.user.create');
    Route::delete('/user/{id}', [UserController::class, 'destroy'])->name('admin.user.destroy');
    Route::delete('/user/hardDelete/{id}', [UserController::class, 'hardDelete'])->name('admin.user.hardDelete');
    Route::get('/user/{id}', [UserController::class, 'user'])->name('admin.user');
    Route::put('/user/{id}', [UserController::class, 'update'])->name('admin.user.update');
    Route::put('/user/restore/{id}', [UserController::class, 'restore'])->name('admin.user.restore');
    Route::post('/create', [UserController::class, 'store'])->name('admin.user.store');
    Route::post('/user/download/{id}', [UserController::class, 'downloadImage'])->name('admin.user.download');
});
Route::get('/set-session', function () {
    session()->put(['user_id' => '5', 'st_id' => 6]);
    return redirect('/get-session');
});
Route::get('/delete-session', function () {
    // session()->forget('user_id');
    session()->flush();
    return redirect('/get-session');
});
Route::get('/get-session', function () {
    $session = session()->all();
    dd($session);
});
Route::redirect('/here', '/there', 302);


Route::get('/login',[AuthController::class,'login'])->name('login');
Route::post('/login',[AuthController::class,'enterUser'])->name('enter');
Route::get('/register',[AuthController::class,'register'])->name('register');
Route::post('/register',[AuthController::class,'submitUser'])->name('submitUser');
Route::get('/recovery-password',[AuthController::class,'recoveryPassword'])->name('recoveryPassword');
Route::post('/recovery-password',[AuthController::class,'changePassword'])->name('changePassword');
Route::get('/recovery-password/{token}',[AuthController::class,'getTokenPassword'])->name('getTokenPassword');
Route::post('/setNewPassword',[AuthController::class,'setNewPassword'])->name('setNewPassword');