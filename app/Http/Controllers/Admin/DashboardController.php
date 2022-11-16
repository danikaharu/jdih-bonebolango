<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $survey = new \App\Models\Survey;

        $averageRating = number_format($survey->avg('rating'), 2);
        $totalSurvey = $survey->totalSurvey();
        $total5Rating = $survey->totalRating(5);
        $total4Rating = $survey->totalRating(4);
        $total3Rating = $survey->totalRating(3);
        $total2Rating = $survey->totalRating(2);
        $total1Rating = $survey->totalRating(1);


        $percent5Rating =  number_format($total5Rating / $totalSurvey * 100, 2);
        $percent4Rating =  number_format($total4Rating / $totalSurvey * 100, 2);
        $percent3Rating =  number_format($total3Rating / $totalSurvey * 100, 2);
        $percent2Rating =  number_format($total2Rating / $totalSurvey * 100, 2);
        $percent1Rating =  number_format($total1Rating / $totalSurvey * 100, 2);

        $data = [
            'totalCategory' => \App\Models\Category::count(),
            'totalProduct' => \App\Models\Product::count(),
            'totalNews' => \App\Models\News::count(),
            'totalGallery' => \App\Models\Gallery::count(),
            'totalProductByCategory' => \App\Models\Category::withCount('products')->get(),
            'totalSurvey' => $totalSurvey,
            'totalDiscussion' => \App\Models\Discussion::count(),
            'totalRequestProduct' => \App\Models\RequestProduct::count(),
            'averageRating' => $averageRating,
            'percent5Rating' => number_format($percent5Rating, 2),
            'percent4Rating' => number_format($percent4Rating, 2),
            'percent3Rating' => number_format($percent3Rating, 2),
            'percent2Rating' => number_format($percent2Rating, 2),
            'percent1Rating' => number_format($percent1Rating, 2),
            'notApprovedDiscussion' => \App\Models\Discussion::where('is_approved', 0)->get(),
        ];

        return view('admin.dashboard.index', compact('data'));
    }
}
