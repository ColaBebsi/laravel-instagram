<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use JD\Cloudder\Facades\Cloudder;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('index');
    }

    public function index()
    {
        $posts = Post::with('user')->latest()->paginate(5);

        return view('posts.index', compact('posts'));
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {

        // Validate request 
        $validatedData = request()->validate([
            'caption' => 'required',
            'image' => ['required', 'mimes:jpeg,bmp,jpg,png', 'between:1, 2000']
        ]);

        // Get image path 
        $imagePath = $request->file('image')->getRealPath();

        // Upload image to Cloudinary
        Cloudder::upload($imagePath, null);

        // Get the image url and resize the image
        // One could also set the options in cloudder.php
        $imageURL = Cloudder::show(Cloudder::getPublicId(), ["crop" => "fill", "width" => 250, "height" => 250]);

        // Create post 
        Auth::user()->posts()->create([
            'caption' => $validatedData['caption'],
            'image' => $imageURL
        ]);

        return redirect("/profile/" . Auth::id());
    }

    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }
}
