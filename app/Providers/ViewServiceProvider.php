<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Profile;
use App\Models\Survey;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer(['partials.admin.sidebar', 'admin.profile.include.tab'], function ($view) {
            $view->with('profiles', Profile::all());
        });

        View::composer('admin.product.include.form', function ($view) {
            $view->with('categories', Category::all());
        });

        View::composer('admin.dashboard.include.rating', function ($view) {
            $view->with('ratings', number_format(Survey::avg('rating'), 2));
        });

        View::composer('user.home.include.rating', function ($view) {
            $view->with('ratings', number_format(Survey::avg('rating'), 2));
        });
    }
}
