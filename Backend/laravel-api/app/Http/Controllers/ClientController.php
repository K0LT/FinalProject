<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Http\Requests\StoreClientRequest;
use App\Http\Requests\UpdateClientRequest;
use App\Models\User;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return response()->json(Client::all());

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreClientRequest $request)
    {
        $request->validate([
            'full_name' => 'required',
            'email' => 'required',
            'phone_number' => 'required',
        ]);
        $user = User::create([
            'name' => $request->get('full_name'),
            'email' => $request->get('email'),
            'password' => bcrypt('password'),
        ]);

        $client = Client::create([
            'full_name' => $request->get('full_name'),
            'phone_number' => $request->get('phone_number'),
            'email' => $request->get('email'),
            'user_id' => $user->id,
        ]);


//        return redirect('people')->with('status', 'Item created successfully!');
        return "ok";
    }

    /**
     * Display the specified resource.
     */
    public function show(Client $client)
    {
        return response()->json($client);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateClientRequest $request, Client $client)
    {
        $data = $request->validate(array(
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone_number' => 'required|string|min:9|max:9',

        ));

            $client->update($data);

            return $client;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Client $client)
    {
        $clients = Client::find($client->id);
        $clients->delete();
        return "return eliminadao";
    }
}
