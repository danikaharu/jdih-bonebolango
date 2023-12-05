<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Profile;
use App\Models\Survey;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Carbon;
use AkkiIo\LaravelGoogleAnalytics\Facades\LaravelGoogleAnalytics;
use AkkiIo\LaravelGoogleAnalytics\Period;

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

        View::composer(['partials.user.footer'], function ($view) {
            $startDate = Carbon::createFromFormat('Y-m-d', '2021-04-01');
            $endDate = Carbon::now();

            $totalVisitor = LaravelGoogleAnalytics::getTotalUsers(Period::create($startDate, $endDate));
            $totalVisitorMonth = LaravelGoogleAnalytics::getTotalUsers(Period::months(1));
            $totalVisitorToday = LaravelGoogleAnalytics::getTotalUsers(Period::days(1));
            return $view->with(
                [
                    'totalVisitor' => $totalVisitor,
                    'totalVisitorMonth' => $totalVisitorMonth,
                    'totalVisitorToday' => $totalVisitorToday,
                ],
            );
        });
    }
}
