<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use AkkiIo\LaravelGoogleAnalytics\Facades\LaravelGoogleAnalytics;
use AkkiIo\LaravelGoogleAnalytics\Period;
use Google\Analytics\Data\V1beta\Filter\StringFilter\MatchType;

class VisitorController extends Controller
{
    public function index()
    {

        $mostViewsByPage = LaravelGoogleAnalytics::getMostViewsByPage(Period::days(30), $count = 10);
        $totalUsersPerMonth = LaravelGoogleAnalytics::getTotalUsers(Period::months(1));
        $totalUsersPerDay = LaravelGoogleAnalytics::getTotalUsers(Period::days(1));
        $popularProduct = $this->popularProduct();

        return view('admin.visitor.index', compact('mostViewsByPage', 'totalUsersPerMonth', 'totalUsersPerDay', 'popularProduct'));
    }

    private function popularProduct()
    {
        $popularProduct = LaravelGoogleAnalytics::dateRanges(Period::days(30))
            ->metrics('screenPageViews')
            ->dimensions('pagePath', 'pageTitle')
            ->whereDimension('pagePath', MatchType::CONTAINS, '/produk/')
            ->orderByDimensionDesc('screenPageViews')
            ->limit(5)
            ->get();

        return $popularProduct;
    }
}
