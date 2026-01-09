<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

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
        // Hapus error lama
        $this->resetErrorBag();

        // Validasi input + pesan BAHASA INDONESIA
        try {
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
                    'recaptcha.required' => 'Verifikasi reCAPTCHA gagal. Silakan refresh halaman.',
                ]
            );
        } catch (\Illuminate\Validation\ValidationException $e) {
            session()->flash('error', 'Periksa kembali form login Anda.');
            throw $e;
        }

        // Verifikasi reCAPTCHA v3
        try {
            $response = Http::timeout(5)->asForm()->post(
                'https://www.google.com/recaptcha/api/siteverify',
                [
                    'secret'   => config('services.recaptcha.secret'),
                    'response' => $this->recaptcha,
                    'remoteip' => request()->ip(),
                ]
            );

            $result = $response->object();

            // Log untuk debugging
            Log::info('reCAPTCHA v3 Response', [
                'success' => $result->success ?? false,
                'score' => $result->score ?? 'N/A',
                'action' => $result->action ?? 'N/A',
                'error-codes' => $result->{'error-codes'} ?? [],
            ]);

            // Cek apakah verifikasi berhasil
            if (!$result || !$result->success) {
                $errorMsg = 'Verifikasi reCAPTCHA gagal.';
                if (isset($result->{'error-codes'})) {
                    Log::error('reCAPTCHA Error', ['codes' => $result->{'error-codes'}]);
                }
                session()->flash('error', $errorMsg);
                $this->addError('recaptcha', $errorMsg);
                $this->recaptcha = null;
                return;
            }


            $minScore = 0.3;

            if (isset($result->score) && $result->score < $minScore) {
                Log::warning('reCAPTCHA v3 Low Score', [
                    'email' => $this->email,
                    'score' => $result->score,
                    'ip' => request()->ip(),
                ]);
                session()->flash('warning', 'Aktivitas mencurigakan terdeteksi. Score: ' . $result->score);
                $this->addError('recaptcha', 'Aktivitas mencurigakan terdeteksi. Score: ' . $result->score);
                $this->recaptcha = null;
                return;
            }

            // Verifikasi action (opsional)
            if (isset($result->action) && $result->action !== 'login') {
                Log::warning('reCAPTCHA Invalid Action', ['action' => $result->action]);
                session()->flash('error', 'Token reCAPTCHA tidak valid.');
                $this->addError('recaptcha', 'Token reCAPTCHA tidak valid.');
                $this->recaptcha = null;
                return;
            }

        } catch (\Exception $e) {
            Log::error('reCAPTCHA Exception', ['error' => $e->getMessage()]);
            session()->flash('error', 'Gagal memverifikasi reCAPTCHA. Silakan coba lagi.');
            $this->addError('recaptcha', 'Gagal memverifikasi reCAPTCHA. Silakan coba lagi.');
            $this->recaptcha = null;
            return;
        }

        // Proses login
        if (Auth::attempt([
            'email' => $this->email,
            'password' => $this->password,
        ])) {
            session()->regenerate();
            session()->flash('success', 'Login berhasil!');
            return $this->redirectRoute('admin.dashboard', navigate: true);
        }

        // Login gagal
        session()->flash('error', 'Email atau password salah.');
        $this->recaptcha = null;
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
