<?php

namespace App\Livewire\Admin;

use Carbon\Carbon;
use App\Models\Post;
use Livewire\Component;
use App\Models\Activity;
use App\Models\Category;
use Illuminate\Support\Str;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.app')]
#[Title('Dashboard Admin')]
class Dashboard extends Component
{
    public function render()
    {
        $stats = [
            'total_views' => Post::sum('view'),
            'posts' => Post::count(),
            'categories' => Category::count(),
            'activities' => Activity::count(),
        ];

        $recentPosts = Post::select('id', 'title', 'thumbnail', 'view', 'post_date', 'created_at')
            ->latest('post_date')
            ->take(5)
            ->get();

        $recentActivities = Activity::select('id', 'name', 'image', 'created_at')
            ->latest()
            ->take(5)
            ->get();

        $months = collect();
        $viewsPerMonth = collect();
        $now = Carbon::now();

        for ($i = 11; $i >= 0; $i--) {
            $date = $now->copy()->subMonths($i);
            $monthLabel = $date->translatedFormat('M Y');
            $months->push($monthLabel);

            $views = Post::whereYear('post_date', $date->year)
                ->whereMonth('post_date', $date->month)
                ->sum('view');

            $viewsPerMonth->push($views);
        }

        // === CHART: Top 5 Artikel Terpopuler ===
        $topPosts = Post::select('title', 'view')
            ->whereNotNull('view')
            ->orderByDesc('view')
            ->take(5)
            ->get();

        $topPostLabels = $topPosts->pluck('title')->map(fn($title) => Str::limit($title, 30))->toArray();
        $topPostViews = $topPosts->pluck('view')->toArray();

        return view('livewire.admin.dashboard', [
            'stats' => $stats,
            'recentPosts' => $recentPosts,
            'recentActivities' => $recentActivities,
            'chartMonths' => $months,
            'chartViews' => $viewsPerMonth,
            'topPostLabels' => $topPostLabels,
            'topPostViews' => $topPostViews,
        ]);
    }
}
