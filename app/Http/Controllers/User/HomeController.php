<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class HomeController extends Controller
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


        $percent5Rating =  divnum($total5Rating, $totalSurvey * 100);
        $percent4Rating =  divnum($total4Rating, $totalSurvey * 100);
        $percent3Rating =  divnum($total3Rating, $totalSurvey * 100);
        $percent2Rating =  divnum($total2Rating, $totalSurvey * 100);
        $percent1Rating =  divnum($total1Rating, $totalSurvey * 100);

        $data = [
            'products' => \App\Models\Product::with('category')->latest()->limit(3)->get(),
            'news' => \App\Models\News::latest()->get(),
            'survey' => \App\Models\Survey::all(),
            'galleries' => \App\Models\Gallery::latest()->get(),
            'totalProduct' => \App\Models\Product::count(),
            'totalCategoryProduct' => \App\Models\Category::withCount('products')->get(),
            'discussions' => \App\Models\Discussion::where('is_approved', 1)->latest()->limit(3)->get(),
            'totalSurvey' => $totalSurvey,
            'averageRating' => $averageRating,
            'percent5Rating' => number_format($percent5Rating, 2),
            'percent4Rating' => number_format($percent4Rating, 2),
            'percent3Rating' => number_format($percent3Rating, 2),
            'percent2Rating' => number_format($percent2Rating, 2),
            'percent1Rating' => number_format($percent1Rating, 2),
        ];

        return view('user.home.index', compact('data'));
    }

    public function berita()
    {
        $news = \App\Models\News::latest()->paginate(9);
        return view('user.news.index', compact('news'));
    }

    public function detail_berita(\App\Models\News $news)
    {
        $threeNews = \App\Models\News::where('id', '!=', $news->id)->latest()->limit(3)->get();
        return view('user.news.detail', compact('news', 'threeNews'));
    }

    public function profil()
    {
        $profiles = \App\Models\Profile::all();
        return view('user.profile.index', compact('profiles'));
    }

    public function galeri()
    {
        $galleries = \App\Models\Gallery::latest()->paginate(9);
        return view('user.gallery.index', compact('galleries'));
    }

    public function detail_galeri(\App\Models\Gallery $gallery)
    {
        $fourGallery = \App\Models\Gallery::where('id', '!=', $gallery->id)->latest()->limit(3)->get();
        return view('user.gallery.detail', compact('gallery', 'fourGallery'));
    }

    public function forum()
    {
        $discussions = \App\Models\Discussion::where('is_approved', 1)->latest()->paginate(10);
        return view('user.forum.index', compact('discussions'));
    }

    public function detail_forum(\App\Models\Discussion $discussion)
    {
        return view('user.forum.detail', compact('discussion'));
    }

    public function produk()
    {
        $products = \App\Models\Product::with('category')->latest()->paginate(10);
        return view('user.product.index', compact('products'));
    }

    public function detail_produk(\App\Models\Product $product)
    {
        $product->load('category');
        return view('user.product.detail', compact('product'));
    }

    public function unduh_produk(\App\Models\Product $product)
    {
        try {
            $file_path = storage_path('app/public/upload/produk/' . $product->file);

            return response()->download($file_path, $product->title . '.pdf', [
                'Content-Type' => 'application/octet-stream',
                'Content-Length' => filesize($file_path),
            ])->setStatusCode(200);
        } catch (\Throwable $th) {
            return redirect()->back();
        }
    }
}
