<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Intervention\Image\ImageManagerStatic as Image;

class userController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:users-create'])->only('create');
        $this->middleware(['permission:users-update'])->only('edit');
        $this->middleware(['permission:users-read'])->only('index');
        $this->middleware(['permission:users-delete'])->only('delete');
    }


    public function index(Request $request)
    {

        $users = User::whereRoleIs('admin')->when($request->search, function ($query) use ($request) {

            return $query->where('name', 'like', '%' . $request->search . '%');
        })->latest()->paginate(5);

        return view('users.index', compact('users'));
    }

    public function create()
    {

        return view('users.create');
    }

    public function store(Request $request)
    {
        $request_data = $request->validate([

            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'permissions' => 'required'
        ]);
        $request_data = $request->except('image');

        $request_data['password'] = bcrypt($request->password);

        if ($request->image) {

            Image::make($request->image)
                ->resize(300, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->save(public_path('userImage/' . $request->image->hashName()));

            $request_data['image'] = $request->image->hashName();
        }



        $users = User::create($request_data);

        $users->attachRole('admin');
        $users->syncPermissions($request->permissions);
        session()->flash('Add');

        return \redirect()->route('users.index');
    }

    public function edit($id)
    {

        $users = User::findOrFail($id);

        return view('users.edit', compact('users'));
    }
    public function update(Request $request, User $user)
    {
        $request_data = $request->validate([

            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);
        $request_data = $request->except('password');

        $request_data['password'] = bcrypt($request->password);

        if ($request->image) {

            if ($user->image != 'default.jpg') {
                unlink(public_path() .  '/userImage/' . $user->image);
            }

            Image::make($request->image)->resize(300, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save(public_path('userImage/' . $request->image->hashName()));

            $request_data['image'] = $request->image->hashName();
        }

        $user->update($request_data);

        $user->syncPermissions($request->permissions);
        session()->flash('Edit');

        return \redirect()->route('users.index');
    }

    public function destroy(User $user)
    {

        // delete images from server
        if ($user->image != 'default.jpg') {
            unlink(public_path() .  '/userImage/' . $user->image);
        }
        // delete users
        $user->delete();
        session()->flash('Delete');
        return \redirect()->route('users.index');
    }
}
