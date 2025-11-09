<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Illuminate\Support\Facades\Auth;

#[Layout('components.layouts.auth')]
#[Title('Login')]
class Login extends Component
{
    public $email = '';
    public $password = '';

 public function login()
{
    $this->validate([
        'email' => 'required|email',
        'password' => 'required|min:6',
    ]);

    if (Auth::attempt(['email' => $this->email, 'password' => $this->password])) {
        session()->regenerate();
        session()->flash('success', 'Login berhasil! Selamat datang kembali.');
        // SPA redirect tanpa reload
        return $this->redirectRoute('admin.dashboard', navigate: true);
    }

    session()->flash('error', 'Email atau password salah.');
}

    public function render()
    {
        return view('livewire.auth.login');
    }
}
