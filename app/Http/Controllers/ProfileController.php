<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use JD\Cloudder\Facades\Cloudder;


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
        // $user = User::findOrFail($user->id);

        return view('profiles.index', compact('user'));
    }

    public function edit(User $user)
    {
        $this->authorize('update', $user->profile);

        return view('profiles.edit', compact('user'));
    }

    public function update(Request $request ,User $user)
    {
        $this->authorize('update', $user->profile);

        // Validate request data
        $validatedData = request()->validate([
            'title' => 'required',
            'description' => 'required',
            'url' => '',
            'image' => ''
        ]);

        
        if (request('image')) {
            $imagePath = $request->file('image')->getRealPath();
            
            // Upload image to Cloudinary
            Cloudder::upload($imagePath, null);
            
            // Get the image url and resize the image
            // One could also set the options in cloudder.php
            $imageURL = Cloudder::show(Cloudder::getPublicId(), ["crop" => "fill", "width" => 250, "height" => 250]);

            $imageArray = ['image' => $imageURL];
        }
        
        // Update the currently authenticated user profile 
        Auth::user()->profile->update(array_merge(
            $validatedData,
            $imageArray ?? []   // Set image to the requested image, if there is no image, set it to an empty array  
        ));
        
        return redirect("/profile/{$user->id}");
    }
}
