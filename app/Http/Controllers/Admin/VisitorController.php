<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class VisitorController extends Controller
{
    public function index()
    {
        return view('admin.visitor.index');
    }
}
