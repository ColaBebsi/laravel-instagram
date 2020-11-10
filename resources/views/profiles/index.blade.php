@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-md-center">
        <div class="col-md-3 pl-5">
            <img src="{{ $user->profile->profileImage() }}" class="rounded-circle w-100">
        </div>
        <div class="col-md-9 pl-5 pr-5 pt-2">
            {{-- <h1>{{ Auth::user()->username }}</h1> --}}
            <div class="d-flex justify-content-between align-items-baseline">
                <div class="d-flex align-items-center">
                    <h1>{{ $user->username }}</h1>
                    <follow-button user-id={{ $user->id }}></follow-button>
                </div>
                
                @can('update', $user->profile)
                    <a href="{{ url("post/create") }}">Create new post</a>
                @endcan
            </div>

            @can('update', $user->profile)
                <a href="{{ url("profile/$user->id/edit") }}">Edit profile</a>
            @endcan

            <div class="d-flex mb-4 pt-2">
                <div class="pr-5"><strong>123</strong> posts</div>
                <div class="pr-5"><strong>123</strong> followers</div>
                <div class="pr-5"><strong>123</strong> following</div>
            </div>

            <div>{{ $user->profile->title ?? 'N/A' }}</div>
            <div>{{ $user->profile->description ?? 'N/A' }}</div>
            <div><a href="#">{{ $user->profile->url ?? 'N/A' }}</a></div>
        </div>
    </div>

    <div class="row pt-5">
        @foreach ($user->posts as $post)
            <div class="col-md-4 pb-4">
                <a href="/post/{{ $post->id }}">
                <img src="{{ $post->image }}" alt="{{ $post->caption }}" class="w-100">
                </a>
            </div>
        @endforeach
    </div>


</div>



@endsection