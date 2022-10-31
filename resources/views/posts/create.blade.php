@props(['posts'])

@extends('layouts.dashboard')

@section('title', 'Create Posts')

@section('content')
    <div class="row justify-content-center">
        <div class="card col-md-8">
            <div class="card-header">Create Your Post Here</div>
            <div class="card-body">
                <form action="/dashboard/posts/" class="row needs-validation pt-4" method="post" novalidate>
                    @csrf
                    <div class="row mb-3">
                        <label for="title" class="col-sm-2 col-form-label">Title</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control @error('title') is-invalid @enderror" name="title"
                                   value="{{ old('title') }}" id="title" required>
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
                              style="height: 100px" required>{{ old('content') }}</textarea>
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
                </form>
            </div>
        </div>
    </div>
@endsection

