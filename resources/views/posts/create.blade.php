@props(['posts'])

@extends('layouts.dashboard')

@section('title', 'Create Posts')

@section('content')
    <div class="container text-center">

        <form action="/dashboard/posts/" class="container w-75" method="post">
            @csrf
            <div class="row mb-3">
                <label for="title" class="col-sm-2 col-form-label">Title</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control @error('title') is-invalid @enderror" name="title"
                           value="{{ old('title') }}" id="title">
                    <div class="invalid-feedback">
                        @error('title')
                        {{ $message }}
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <label for="content" class="col-sm-2 col-form-label">Post Content</label>
                <div class="col-sm-10">
                    <textarea class="form-control @error('content') is-invalid @enderror" id="content" name="content"
                              style="height: 100px">{{ old('content') }}</textarea>
                    <div class="invalid-feedback">
                        @error('content')
                        {{ $message }}
                        @enderror
                    </div>
                </div>
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-primary">Submit</button>
                <button type="reset" class="btn btn-secondary">Reset</button>
            </div>
        </form><!-- End Horizontal Form -->


    </div>
@endsection

