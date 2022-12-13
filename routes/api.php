<?php

    use App\Http\Controllers\Api\BioLinksController;
    use App\Http\Controllers\Api\ProfileController;
    use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\Api\{
    LoginController,
    RegisterController
};

Route::get('/', function(){
    return response()->json(['message' => 'Welcome to the Donatr!!!'], 200);
});

Route::prefix('auth')->group(function(){
    Route::post('login', [LoginController::class, 'login']);
    Route::post('verifyIndicator', [RegisterController::class, 'verifyIndicator']);
    Route::post('verifyLinkIndication', [RegisterController::class, 'verifylink']);
    Route::post('register', [RegisterController::class, 'register']);
    Route::post('recover-password', [LoginController::class, 'recoverPassword']);
    Route::post('change-password', [LoginController::class, 'changePassword']);
});

Route::middleware('auth:sanctum')->group(function () {
    Route::get('retry', [LoginController::class, 'retrySendMailVerification'])->name('retrySendMailVerification');
    Route::post('verify', [LoginController::class, 'verifyTokenRegister'])->name('verifyTokenRegister');
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');
    Route::get('me', [LoginController::class, 'me'])->name('me');
    Route::post('edit-me', [ProfileController::class, 'update'])->name('meUpdate');
    Route::get('user/{identify?}', [ProfileController::class, 'show'])->name('other_user');

    Route::controller(BioLinksController::class)->prefix('bio-links')->group(function(){
        Route::get('/', 'index')->name('bio-links.all');
        Route::get('{identify}', 'show')->name('bio-links.show');
        Route::post('/create', 'create')->name('bio-links.create');
        Route::put('{identify}', 'update')->name('bio-links.update');
    });
});
