<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

#[Layout('components.layouts.auth')]
#[Title('Register')]
class Register extends Component
{
    public $name = '';
    public $email = '';
    public $password = '';
    public $password_confirmation = '';

    protected $rules = [
        'name' => 'required|min:3',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:6|same:password_confirmation',
    ];

    public function register()
    {
        $this->validate();

        // Buat user baru
        User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
        ]);

        // Notifikasi sukses
        session()->flash('success', 'Akun berhasil dibuat! Silakan login.');

        // SPA redirect ke halaman login tanpa reload
        return $this->redirectRoute('login', navigate: true);
    }

    public function render()
    {
        return view('livewire.auth.register');
    }
}
