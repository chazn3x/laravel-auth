@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            @foreach ($posts as $post)
                <div class="card mb-5">
                    <div class="card-header">
                        {{ $post->title }}
                    </div>

                    <div class="card-body">
                        {{ $post->content }}
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection