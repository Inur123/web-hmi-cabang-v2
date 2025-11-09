<?php

namespace App\Livewire\Admin;

use Livewire\Component;

class Dashboard extends Component
{
    protected string $layout = 'components.layouts.app';
    protected array $layoutData = ['title' => 'Admin Dashboard'];

    public function render()
    {
        return view('livewire.admin.dashboard');
    }
}
