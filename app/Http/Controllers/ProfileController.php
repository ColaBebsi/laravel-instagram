<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function index(User $user)
    {
        $user = User::findOrFail($user->id);

        return view('profiles.index', compact('user'));
    }

    public function edit(User $user)
    {
        $user = User::findOrFail($user->id);

        return view('profiles.edit', compact('user'));
    }

    public function update(User $user)
    {
        
    }
}
