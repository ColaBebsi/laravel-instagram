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
                        <h5 class="card-title">{{ $post->caption }}</h5>
                        <p class="card-text">It's a broader card with text below as a natural lead-in to extra content.
                            This content is a little longer.</p>
                        <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                    </div>
                </div>
            </div>  {{-- row no-gutters --}}
        </div>  {{-- card mb-3 --}}
    </div>  {{-- row justify-content-md-center --}}
</div>  {{-- container --}}
@endsection