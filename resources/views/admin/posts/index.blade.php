@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            @foreach ($posts as $post)
                <div class="card mb-5">
                    <div class="card-header">
                        <span class="text-muted">{{$post->created_at}}</span>
                    </div>
                    
                    <div class="card-body">
                        <h5 class="card-title">{{ $post->title }}</h5>
                        <p class="card-text">
                            {{ $post->content }}
                        </p>
                        <div class="text-right">
                            <a href="{{route('posts.show', $post->slug)}}" class="btn btn-primary">Leggi post</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection