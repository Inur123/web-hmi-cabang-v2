<?php

namespace App\Livewire\User;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Layout('components.layouts.guest')]
#[Title('Home')]
class Home extends Component
{
    public function render()
    {
        return view('livewire.user.home');
    }
}
