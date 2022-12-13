<?php

namespace App\Http\Livewire\Auth;

use Illuminate\Support\Facades\Http;
use Livewire\Component;

class Register extends Component
{
    public $name, $email, $password, $password_confirmation;

    protected function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ];
    }
    protected $messages = [
        'email.required' => 'E-mail necessário para cadastro.',
        'email.email' => 'Formato de e-mail inválido.',
        'email.unique' => 'já temos um cadastro usando esse e-mail.',
        'name.required' => 'Adicione seu nome para criarmos seu perfil.',
        'password.required' => 'Uma senha é necessária para sua segurança.',
        'password.min' => 'Que tal mais segurança? Pelo menos 8 caracteres.',
        'password.confirmed' => 'As senhas não batem, Digitou algo errado?',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function register ()
    {
        $this->validate();

        $request = Http::acceptJson()->asForm()->post(env('APP_API_URL') . 'auth/register', [
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->password,
            'password_confirmation' => $this->password_confirmation,
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

    public function boot ()
    {
        if(session()->has('donatr_auth_data'))
            $this->redirectRoute('home');
    }

    public function render()
    {
        return view('livewire.auth.register')->extends('layouts.app');
    }
}
