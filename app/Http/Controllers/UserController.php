<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::orderBy('id','DESC')->paginate(5);
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|min:3|max:100',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|max:15',
            'confirm_password' => 'required|same:password',
            'type' => 'required|in:admin,writer',
        ]);

        // User::create($data);
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' =>  bcrypt($data['password']),
            'type' => $data['type'],
        ]);

        return back()->with('success', 'User Added Succeffuly');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::findOrFail($id);
        return view('users.edit',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'name' => 'required|string|min:3|max:100',
            'email' => 'required|email|unique:users,email,'.$id,
            'password' => 'nullable|min:8|max:15',
            'confirm_password' => 'nullable|same:password',
            'type' => 'required|in:admin,writer',
        ]);

        $user = User::findOrFail($id);
        $data['password'] = $request->has('password') ? bcrypt($request->password) : $user->password ;
        unset($data['confirm_password']);

        User::where('id',$id)->update($data);
        return redirect()->route('users.index')->with('success','User Updated Succeffuly');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        User::findOrFail($id)->delete();
        return back()->with('success','Uaer Deleted Succeffuly');
    }

    public function posts(string $id)
    {
        $user = User::findOrFail($id);
        return view('users.posts', compact('user'));
    }
}
