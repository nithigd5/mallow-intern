@props(['post'])

@extends('layouts.dashboard')

@section('title', 'Edit Post')

@section('content')
    <div class="container text-center">

        <form action="{{ route('posts.update', $post->id) }}" method="post">
            @csrf
            @method('put')
            <div class="row mb-3">
                <label for="title" class="col-sm-2 col-form-label">Title</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control @error('title') is-invalid @enderror" name="title"
                           value="{{ $post->title }}" id="title">
                    @error('title')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>
            <div class="row mb-3">
                <label for="content" class="col-sm-2 col-form-label">Post Content</label>
                <div class="col-sm-10">
                    <textarea class="form-control @error('content') is-invalid @enderror" id="content" name="content"
                              style="height: 100px">{{ $post->content }}</textarea>
                    @error('content')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-primary">Submit</button>
                <button type="reset" class="btn btn-secondary">Reset</button>
            </div>
        </form><!-- End Horizontal Form -->


    </div>
@endsection

