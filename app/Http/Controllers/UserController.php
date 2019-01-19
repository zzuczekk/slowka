<?php

namespace App\Http\Controllers;

use App\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function index()
    {
        $users = User::orderBy('name')
            ->with('roles')
            ->select(['id', 'name', 'email', 'created_at'])
            ->get();

        $roles = Role::orderByDesc('id')
            ->pluck('name', 'id');

        return view('users.index', [
            'users' => $users,
            'roles' => $roles
        ]);
    }

    public function update(int $id, Request $request)
    {
        $request->validate([
            'roles' => [
                function ($attribute, $values, $fail) {
                    if (!empty($values) && !is_array($values)) {
                        $values = [$values];
                    }
                    if (count($values) > 0 && Role::whereIn('id', $values)->count() !== count($values)) {
                        $fail('Niepoprawne role.');
                    }
                }
            ]

        ]);
        $user = User::findOrFail($id);

        $user->roles()->sync($request->get('roles'));

        Session::flash('notification', [
            'type' => 'success',
            'text' => 'Role użytkownikia ' . $user->name . ' zostały zaktualizaowane.'
        ]);

        return redirect()->route('users');

    }
}
