<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store() 
    {
        // Validate request data
        $validatedData = request()->validate([
            'caption' => 'required',
            'image' => ['required','image']
        ]);

        // Store image in uploads directory
        $imagePath = request('image')->store('uploads', 'public');

        $resizedImage = Image::make(public_path("storage/{$imagePath}"))->fit(1200, 1200)->save();
        
        // dd($resizedImage);

        Auth::user()->posts()->create([
            'caption' => $validatedData['caption'],
            'image' => $imagePath
        ]);

        return redirect("/profile/" . Auth::id());
    }
}
