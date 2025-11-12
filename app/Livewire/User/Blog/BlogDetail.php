<?php

namespace App\Livewire\User\Blog;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\Post;

#[Layout('components.layouts.guest')]
class BlogDetail extends Component
{
    public $slug;
    public $post;

    public function mount($slug)
    {
        $this->post = Post::with('category')
            ->where('slug', $slug)
            ->where('status', 'active')
            ->firstOrFail();

        $this->post->increment('view');
    }

    public function render()
    {
        // ✅ Pass $post ke layout untuk meta tags
        return view('livewire.user.blog.blog-detail')
            ->title($this->post->title . ' - HMI Cabang Ponorogo')
            ->layoutData([
                'post' => $this->post
            ]);
    }
}
