<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use JD\Cloudder\Facades\Cloudder;


class ProfileController extends Controller
{
    public function index(User $user)
    {
        // Check if the following user has a user id
        $follows = (Auth::user()) ? auth()->user()->following->contains($user->id) : false;

        // Cache  
        $postsCount = Cache::remember(
            'count.posts.' . $user->id,
            now()->addSeconds(30),
            function () use ($user) {
                return $user->posts->count();
            }
        );

        // Cache  
        $followersCount = Cache::remember(
            'count.followers.' . $user->id,
            now()->addSeconds(30),
            function () use ($user) {
                return $user->profile->followers->count();
            }
        );

        // Cache  
        $followingCount = Cache::remember(
            'count.following.' . $user->id,
            now()->addSeconds(30),
            function () use ($user) {
                return $user->following->count();
            }
        );

        return view('profiles.index', compact('user', 'follows', 'postsCount', 'followersCount', 'followingCount'));
    }

    public function edit(User $user)
    {
        // Check if user is authorized to update the profile
        $this->authorize('update', $user->profile);

        return view('profiles.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        // Check if user is authorized to update the profile
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
