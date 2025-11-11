<?php

namespace App\Livewire\User;

use Livewire\Component;
use App\Models\Activity;
use App\Models\Post;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Layout('components.layouts.guest')]
#[Title('Home')]
class Home extends Component
{
    public function render()
    {
        $activities = Activity::select('name', 'description', 'image')->get();

        $posts = Post::select('title', 'slug', 'thumbnail', 'post_date', 'content', 'status')
            ->where('status', 'active')
            ->latest('post_date')
            ->take(6)
            ->get();

        return view('livewire.user.home', [
            'activities' => $activities,
            'posts' => $posts,
        ]);
    }
}
