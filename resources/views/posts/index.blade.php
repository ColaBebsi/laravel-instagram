@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-md-center">
        @foreach ($posts as $post)
        <div class="card mb-3" style="width: 38rem;">
            <img class="card-img-top" src="{{ $post->image }}" alt="">
            <div class="card-body d-flex align-items-center">
                <div class="pr-3">
                    <img src="{{ $post->user->profile->profileImage() }}" class="rounded-circle w-100"
                        style="max-width: 40px;">
                </div>
                <strong>
                    <a class="card-text justify-content-center"
                        href="/profile/{{ $post->user_id }}">{{ $post->user->username }}</a>
                </strong>
                <span class="mx-2">•</span>
                <span class="card-text">{{ $post->caption }}</span>
            </div>
        </div>
        @endforeach
    </div>
    <div class="row">
        <div class="col-md-12 d-flex justify-content-center">
            {{ $posts->links("pagination::bootstrap-4") }}
        </div>
    </div>
</div>

@endsection