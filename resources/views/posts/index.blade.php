@props(['posts'])

@extends('layouts.dashboard')

@section('title', 'Posts')

@section('content')
    <div class="container text-center">

        <div class="row p-2 fs-6 align-items-center fw-semibold fs-5 bg-primary text-white rounded-3 shadow-md mb-3">
            <div class="col-2">Title</div>
            <div class="col-1">Created</div>
            <div class="col-1">Updated</div>
            <div class="col-5">Content</div>
            <div class="col-3">Action</div>
        </div>
        @foreach($posts as $post)
            <div class="row p-2 fs-6 align-items-center fw-semibold rounded-3 shadow my-2">
                <div class="col-2"> {{ $post->title  }} </div>
                <div class="col-1"> {{ $post->created_at->diffForHumans()  }} </div>
                <div class="col-1"> {{ $post->updated_at->diffForHumans()  }} </div>
                <p class="col-5 font-monospace">{{ $post->content }}</p>
                <div class="col-3 d-flex flex-column  flex-xl-row  gap-2 align-content-center justify-content-center">
                    <a class="col btn btn-primary" href="{{ route('posts.show', $post->id) }}"> View
                    </a>
                    <a class="col btn btn-info" href="{{ route('posts.edit', $post->id) }}"> Edit
                    </a>
                    <form action="{{ route('posts.destroy', $post->id) }}" method="post" class="col p-0">
                        @csrf
                        @method('DELETE')
                        <x-danger-button height="min-content" width="100%">Delete
                        </x-danger-button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>
@endsection

