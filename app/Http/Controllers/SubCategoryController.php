<?php

namespace App\Http\Controllers;

use App\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Validation\Rule;

class SubCategoryController extends Controller
{
    public function delete(int $id)
    {
        $subCategory = Subcategory::select(['id', 'name'])
            ->find($id);

        if ($subCategory !== null) {
            $subCategory->subcategories()->delete();
            $subCategory->delete();
            return redirect()->route('categories', [
                'message' => [
                    'type' => 'success',
                    'message' => 'Kategoria ' . $subCategory->name . ' została usunięta.'
                ]
            ]);
        }

        return redirect()->route('categories', [
            'message' => [
                'type' => 'danger',
                'message' => 'Kategoria o id ' . $id . ' nie istnieje.'
            ]
        ]);
    }

    public function show(int $id)
    {
        $subCategory = Subcategory::with('subcategories')
            ->findOrFail($id);

        return view('categories.show', [
            'subCategory' => $subCategory
        ]);
    }

    public function insert(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:subcategories|min:3|max:100',
            'description' => 'required|min:6',
            'image' => 'required|image'
        ]);

        $subCategory = new Subcategory();
        $subCategory->categories_id = $request->get('id');
        $subCategory->name = $request->get('name');
        $subCategory->description = $request->get('description');
        $subCategory->picture_file_name = "";

        $subCategory->save();
        $extension = File::extension($request->file('image')->getClientOriginalName());

        $path = $request->file('image')->storeAs('subcategories', $subCategory->id . '.' . $extension);
        $subCategory->picture_file_name = $path;

        $subCategory->save();

        return redirect()->route('editCategory', [
            'id' => $request->get('id')
        ]);

    }

    public function edit($id)
    {
        $category = Subcategory::with('subcategories')
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
                Rule::unique('subcategories')->ignore($id),
                'min:3',
                'max:100',
            ],
            'description' => 'required|min:6'
        ]);
        $category = Subcategory::findOrFail($id);
        $category->name = $request->get('name');
        $category->description = $request->get('description');
        $category->picture_file_name = "";

        $category->save();

        return redirect()->route('editCategory', [
            'id' => $category->id
        ]);

    }
}
