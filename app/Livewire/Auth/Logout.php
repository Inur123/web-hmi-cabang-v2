<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Illuminate\Support\Facades\Auth;

#[Layout('components.layouts.auth')]
#[Title('Logout')]
class Logout extends Component
{
    public function logout()
    {
        Auth::logout();

        session()->invalidate();
        session()->regenerateToken();

        // Flash pesan sukses logout
        session()->flash('success', 'Berhasil logout!');

        // SPA redirect ke login tanpa reload
        return $this->redirectRoute('login', navigate: true);
    }

    public function render()
    {
        return view('livewire.auth.logout');
    }
}
