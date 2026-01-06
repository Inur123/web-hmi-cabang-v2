<?php

namespace App\Livewire\User;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Layout('components.layouts.guest')]
#[Title('Komisariat - HMI Cabang Ponorogo')]
class Komisariat extends Component
{
    public function render()
    {
        return view('livewire.user.komisariat', []);
    }
}
