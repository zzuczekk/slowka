<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SubategoryController extends Controller
{
    public function index()
    {
        $categories = Category::orderBy('name')
            ->get();

        return view('categories.index', [
            'categories' => $categories
        ]);
    }
}
