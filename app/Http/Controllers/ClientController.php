<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('permission:users-create')->only('store');
    //     $this->middleware('permission:users-update')->only('edit');
    //     $this->middleware('permission:users-read')->only('index');
    //     $this->middleware('permission:users-delete')->only('delete');
    // }

    public function index(Request $request)
    {

        $clients = Client::when($request->search, function ($query) use ($request) {

            return $query->where('name', 'like', '%' . $request->search . '%');
        })->latest()->paginate(5);

        return view('clients.index', compact('clients'));
    }

    public function create()
    {

        return view('clients.create');
    }

    public function store(Request $request)
    {
        $rules = [

            'name' => 'required',
            'phone' => 'required',
            'address' => 'required'
        ];
        $request->validate($rules);
        $request_data = $request->all();


        Client::create($request_data);

        session()->flash('Add');

        return \redirect()->route('clients.index');
    }
    public function edit($id)
    {

        $clients = Client::findOrFail($id);

        return view('clients.edit', compact('clients'));
    }
    public function update(Request $request, Client $client)
    {
        $rules = [

            'name' => 'required',
            'phone' => 'required',
            'address' => 'required'
        ];
        $request->validate($rules);
        $request_data = $request->all();


        $client->update($request_data);

        session()->flash('Add');

        return \redirect()->route('clients.index');
    }

    public function destroy(Client $client)
    {

        $client->delete();
        session()->flash('Delete');
        return \redirect()->route('users.index');
    }
}
