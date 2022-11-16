<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Client\Response;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = \App\Models\Product::all();;

        return Response::json(
            array(
                'status' => 'success',
                'pages' => $products->toArray()
            ),
            200
        );
    }
}
