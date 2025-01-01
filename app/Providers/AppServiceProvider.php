<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Collection;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $count_blogs = Collection::count();
    $count_category = Category::count();

    // Share these counts with all views
    view()->share('count_blogs', $count_blogs);
    view()->share('count_category', $count_category);
    }
}
