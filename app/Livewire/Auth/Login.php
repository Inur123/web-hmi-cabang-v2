<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

#[Layout('components.layouts.auth')]
#[Title('Login')]
class Login extends Component
{
    public $email = '';
    public $password = '';
    public $showPassword = false;
    public $recaptcha = null;

    public function login()
    {
        // 🔑 Hapus error lama
        $this->resetErrorBag();

        // ✅ Validasi + pesan BAHASA INDONESIA
        $this->validate(
            [
                'email' => 'required|email',
                'password' => 'required|min:6',
                'recaptcha' => 'required',
            ],
            [
                'email.required' => 'Email wajib diisi.',
                'email.email' => 'Format email tidak valid.',
                'password.required' => 'Password wajib diisi.',
                'password.min' => 'Password minimal 6 karakter.',
                'recaptcha.required' => 'Silakan verifikasi reCAPTCHA terlebih dahulu.',
            ]
        );

        /** @var \Illuminate\Http\Client\Response $response */
        $response = Http::asForm()->post(
            'https://www.google.com/recaptcha/api/siteverify',
            [
                'secret'   => config('services.recaptcha.secret'),
                'response' => $this->recaptcha,
                'remoteip' => request()->ip(),
            ]
        );

        $result = $response->object();

        // ❌ CAPTCHA SALAH
        if (!$result || !$result->success) {
            $this->addError('recaptcha', 'Verifikasi reCAPTCHA gagal.');
            $this->recaptcha = null;
            $this->dispatch('grecaptcha-reset');
            return;
        }

        // 🔑 LOGIN
        if (Auth::attempt([
            'email' => $this->email,
            'password' => $this->password,
        ])) {
            session()->regenerate();
            session()->flash('success', 'Login berhasil!');
            return $this->redirectRoute('admin.dashboard', navigate: true);
        }

        // ❌ EMAIL / PASSWORD SALAH
        session()->flash('error', 'Email atau password salah.');
        $this->recaptcha = null;
        $this->dispatch('grecaptcha-reset');
    }

    public function togglePassword()
    {
        $this->showPassword = !$this->showPassword;
    }

    public function render()
    {
        return view('livewire.auth.login');
    }
}
