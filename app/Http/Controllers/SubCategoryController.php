<?php

namespace App\Http\Controllers;

use App\Language;
use App\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;

class SubCategoryController extends Controller
{
    public function delete(int $id)
    {
        $subCategory = Subcategory::select(['id', 'name'])
            ->find($id);

        if ($subCategory !== null) {
            $subCategory->delete();
            Session::flash('notification', [
                'type' => 'success',
                'text' => 'Subkategoria ' . $subCategory->name . ' została usunięta.'
            ]);
            return redirect()->back();
        }

        Session::flash('notification', [
            'type' => 'danger',
            'text' => 'Subkategoria o id ' . $id . ' nie istnieje.'
        ]);

        return redirect()->back();
    }

    public function show(int $id)
    {
        $sets = Subcategory::with([
            'sets',
            'sets.language1',
            'sets.language2'
        ])->findOrFail($id);

        return view('subCategories.show', [
            'subCategory' => $sets
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
        $subCategory = Subcategory::with([
                'sets',
                'sets.language1',
                'sets.language2'
            ])->findOrFail($id);

        $languages = Language::pluck('name', 'id');

        return view('subCategories.edit', [
            'subCategory' => $subCategory,
            'languages' => $languages
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
        $subCategory = Subcategory::findOrFail($id);
        $subCategory->name = $request->get('name');
        $subCategory->description = $request->get('description');

        if ($request->hasFile('image')) {
            $extension = File::extension($request->file('image')->getClientOriginalName());

            $path = $request->file('image')->storeAs('categories', $subCategory->id . '.' . $extension);
            $subCategory->picture_file_name = $path;
        }

        $subCategory->save();

        return redirect()->route('editSubCategory', [
            'id' => $subCategory->id
        ]);

    }
}
