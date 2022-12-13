<?php

    use App\Http\Livewire\Auth\Login;
    use App\Http\Livewire\Auth\Register;
    use App\Http\Livewire\Bio;
    use App\Http\Livewire\Home;
    use Illuminate\Foundation\Auth\EmailVerificationRequest;
    use Illuminate\Support\Facades\Http;
    use Illuminate\Support\Facades\Route;

//    Rota para verificação de e-mail.
    Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
        $request->fulfill();
    })->middleware(['auth', 'signed'])->name('verification.verify');

    Route::prefix('/')->group(function () {
        Route::get('', function (){
            return redirect(\route('home'));
        })->name('oldHome');
        Route::get('/acesso', Login::class)->name('access');
        Route::get('/cadastro', Register::class)->name('register');
        Route::get('/logout', [Login::class, 'logout'])->name('web.logout');
    });

    Route::middleware(['AuthApi'])->prefix('dn')->group(function () {
        Route::get('', Home::class)->name('home');
        Route::get('bio', Bio::class)->name('bio');
    });
