<?php

namespace App\Livewire\User\Profile;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Layout('components.layouts.guest')]
#[Title('Kepengurusan HMI Cabang Ponorogo')]
class Kepengurusan extends Component
{
    public function render()
    {
        return view('livewire.user.profile.kepengurusan');
    }
}
