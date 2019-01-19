<?php

namespace App\Http\Controllers;

use App\Language;
use App\Set;
use App\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;

class SetController extends Controller
{
    public function show(int $id)
    {
        $set = Set::with(['language1', 'language2'])
            ->findOrFail($id);
        $words = [];

        if (!empty($set->words)) {
            $rows = explode("\n", $set->words);
            foreach ($rows as $row) {
                $row = explode(';', $row);
                $words[] = [
                    $row[0],
                    $row[1]
                ];
            }
        }

        return view('set.show', [
            'set' => $set,
            'words' => $words
        ]);
    }

    public function insert(Request $request)
    {
        $request->validate([
            'name' => [
                'required',
                'min:3',
                'max:100',
                'unique:sets'
            ],
            'id' => 'required',
            'lang' => [
                function ($attribute, $values, $fail) {
                    if (!is_array($values) || count($values) !== 2 || $values[0] === $values[1]) {
                        $fail('Wybierz 2 inne języki.');
                    }
                    if (count($values) === 2 && Language::whereIn('id', $values)->count() !== 2) {
                        $fail('Wybierz 2 inne języki.');
                    }
                }
            ]
        ]);

        $subCategory = Subcategory::findOrFail($request->get('id'));

        $set = new Set();
        $set->subcategories_id = $subCategory->id;
        $set->languages1_id = $request->get('lang')[0];
        $set->languages2_id = $request->get('lang')[1];
        $set->users_id = Auth::id();
        $set->words = '';
        $set->number_of_words = 0;
        $set->name = $request->get('name');
        $set->save();

        return redirect()->back();
    }

    public function delete(int $id)
    {
        $set = Set::select(['id', 'name'])
            ->find($id);

        if ($set !== null) {
            $set->delete();
            Session::flash('notification', [
                'type' => 'success',
                'text' => 'Zestaw ' . $set->name . ' został usunięty.'
            ]);

            return redirect()->back();
        }

        Session::flash('notification', [
            'type' => 'danger',
            'text' => 'Zestaw o id ' . $id . ' nie istnieje.'
        ]);

        return redirect()->back();
    }

    public function edit(int $id)
    {
        $set = Set::with(['language1', 'language2'])
            ->findOrFail($id);
        $words = [];

        if (!empty($set->words)) {
            $rows = explode("\n", $set->words);
            foreach ($rows as $row) {
                $row = explode(';', $row);
                $words[] = [
                    $row[0],
                    $row[1]
                ];
            }
        }
        return view('set.edit', [
            'set' => $set,
            'words' => $words
        ]);
    }

    public function update(int $id, Request $request)
    {
        $request->validate([
            'name' => [
                'required',
                'min:3',
                'max:100',
                Rule::unique('sets')->ignore($id),
            ]
        ]);

        $set = Set::findOrFail($id);

        $words = [];
        $words1 = $request->get('lang1');
        $words2 = $request->get('lang2');

        if (!empty($words1)) {
            foreach ($words1 as $key => $word) {
                $words[] = $word . ";" . $words2[$key];
            }
            $set->words = implode($words, "\n");
            $set->number_of_words = count($words1);
        }
        $set->name = $request->get('name');
        $set->save();

        return redirect()->back();
    }
}
