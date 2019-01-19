<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;

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
        $category = Category::select(['id', 'name'])
            ->find($id);

        if ($category !== null) {
            $category->delete();
            Session::flash('notification', [
                'type' => 'success',
                'text' => 'Kategoria ' . $category->name . ' została usunięta.'
            ]);

            return redirect()->route('categories');
        }

        Session::flash('notification', [
            'type' => 'danger',
            'text' => 'Kategoria o id ' . $id . ' nie istnieje.'
        ]);

        return redirect()->route('categories');
    }

    public function show(int $id)
    {
        $category = Category::with('subcategories')
            ->findOrFail($id);

        return view('categories.show', [
            'category' => $category
        ]);
    }

    public function add()
    {
        return view('categories.add');
    }

    public function insert(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:categories|min:3|max:100',
            'description' => 'required|min:6',
            'image' => 'required|image'
        ]);

        $category = new Category();
        $category->name = $request->get('name');
        $category->description = $request->get('description');
        $category->picture_file_name = "";

        $category->save();
        $extension = File::extension($request->file('image')->getClientOriginalName());

        $path = $request->file('image')->storeAs('categories', $category->id . '.' . $extension);
        $category->picture_file_name = $path;

        $category->save();

        return redirect()->route('editCategory', [
            'id' => $category->id
        ]);

    }

    public function edit($id)
    {
        $category = Category::with('subcategories')
            ->findOrFail($id);

        return view('categories.edit', [
            'category' => $category
        ]);
    }

    public function update(int $id, Request $request)
    {
        $request->validate([
            'name' => [
                'required',
                Rule::unique('categories')->ignore($id),
                'min:3',
                'max:100',
            ],
            'description' => 'required|min:6',
            'file' => 'image'
        ]);
        $category = Category::findOrFail($id);
        $category->name = $request->get('name');
        $category->description = $request->get('description');

        if ($request->hasFile('image')) {
            $extension = File::extension($request->file('image')->getClientOriginalName());

            $path = $request->file('image')->storeAs('categories', $category->id . '.' . $extension);
            $category->picture_file_name = $path;
        }

        $category->save();

        return redirect()->route('editCategory', [
            'id' => $category->id
        ]);

    }

}
