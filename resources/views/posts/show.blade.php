@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-md-center">
        <div class="card mb-3" style="max-width: 640px;">
            <div class="row no-gutters">
                <div class="col-md-5">
                    <img src="{{ $post->image}}" alt="{{ $post->caption }}" class="">
                </div>
                <div class="col-md-7">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="pr-3">
                                <img src="{{ $post->user->profile->profileImage() }}" class="rounded-circle w-100"
                                    style="max-width: 40px;">
                            </div>
                            <div>
                                <div class="font-weight-bold">
                                    <a href="/profile/{{ $post->user->id }}">
                                        <span class="text-dark">{{ $post->user->username }}</span>
                                    </a>
                                    <span class="ml-1 mr-1">•</span>
                                    <a href="#"> Follow</a>
                                </div>
                            </div>
                        </div>
                        <p class="card-text pt-3">
                            <span class="font-weight-bold">
                                <a href="/profile/{{ $post->user->id }}">
                                    <span class="text-dark">{{ $post->user->username }}</span>
                                </a>
                            </span> {{ $post->caption }}
                        </p>
                        <hr>
                        <p class="card-text">
                            It's a broader card with text below as a natural lead-in to extracontent. This content is a
                            little longer.
                        </p>
                        {{-- <p class="card-text"><small class="text-muted">Created {{$post->created_at}} </small></p> --}}
                    </div>
                </div>
            </div> {{-- row no-gutters --}}
        </div> {{-- card mb-3 --}}
    </div> {{-- row justify-content-md-center --}}
</div> {{-- container --}}
@endsection