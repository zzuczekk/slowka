<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::orderBy('name')
            ->get();

        return view('categories.index', [
            'categories' => $categories
        ]);
    }

    public function delete(int $id)
    {
        $category = Category::select('id, name')
            ->find($id);

        if ($category !== null) {
            $category->delete();
            return view('categories.show', [
                'message' => [
                    'type' => 'success',
                    'message' => 'Kategoria ' . $category->name . ' została usunięta.'
                ]
            ]);
        }

        return view('categories.show', [
            'message' => [
                'type' => 'danger',
                'message' => 'Kategoria o id ' . $id . ' nie istnieje.'
            ]
        ]);
    }

    public function show(int $id)
    {
        $category = Category::with('subcategories')
            ->findOrFail($id);

        return view('categories.show', [
            'category' => $category
        ]);
    }

}
