<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('manage', compact('users'));
    }

    public function create()
    {
        return view('create-user');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => 'required|in:user,admin',
            'rank' => 'required|in:0,1,2,3,4,5,6',
        ]);

        try {
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => $request->role,
                'rank' => $request->rank,
            ]);

            // return $request;
            return redirect()->route('users.create')->with('success', 'User created successfully.');
        } catch (\Exception $e) {
            return redirect()->route('users.create')->with('error', 'There was an error creating the user: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('manage')->with('success', 'ลบผู้ใช้สำเร็จแล้ว');
    }
}
