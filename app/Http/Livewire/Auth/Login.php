<?php

namespace App\Http\Livewire\Auth;

use Illuminate\Support\Facades\Http;
use Livewire\Component;

class Login extends Component
{
    public $email, $password;

    protected $rules = [
        'email' => 'required|min:6|email',
        'password' => 'required',
    ];

    // Menssagens para validar login
    protected $messages = [
        'email.required' => 'E-mail necessário para sabermos quem é você.',
        'email.email' => 'Formato de e-mail inválido.',
        'password.required' => 'Isso é necessário para sabermos que você, é você mesmo.',
    ];

    public function login ()
    {
        $this->validate();

        $request = Http::acceptJson()->asForm()->post(env('APP_API_URL') . 'auth/login', [
            'email' => $this->email,
            'password' => $this->password,
        ]);

        if(!$request->failed() && $request->json()){
            $token = $request->json()['data']['token'];
            $me = Http::withToken($token)->get(env('APP_API_URL') . 'me');
            if(!$me->failed()){
                session(['donatr_auth_data' => $me->json()['data']]);
            }
            session(['donatr_token_auth' => $token]);

            $this->redirectRoute('home');
        }
    }

    public function logout ()
    {
        session()->forget('donatr_token_auth');
        session()->forget('donatr_auth_data');

        Http::withToken(session('donatr_token_auth'))->post(env('APP_API_URL') . 'auth/logout');
        return redirect(\route('access'));
    }

    public function boot ()
    {
        if(session()->has('donatr_auth_data'))
            $this->redirectRoute('home');
    }

    public function render()
    {
        return view('livewire.auth.login')->extends('layouts.app');
    }
}
