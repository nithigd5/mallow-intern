@props(['permissions'])

@extends('layouts.dashboard')

@section('title', 'Create Roles')

@section('content')
    <div class="row justify-content-center">
        <div class="card col-md-8">
            <div class="card-header">Edit Your Roles Here</div>
            <div class="card-body">
                <form action="/dashboard/roles/{{ $role->id }}" class="row needs-validation pt-4" method="post" novalidate>
                    @csrf
                    @method('PUT')
                    <div class="row mb-3">
                        <label for="title" class="col-sm-2 col-form-label">Role</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control @error('role') is-invalid @enderror" name="role"
                                   value="{{ $role->name }}" id="role" required>
                            <div class="invalid-feedback">
                                @error('role')
                                {{ $message }}
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <legend class="col-form-label col-sm-2 pt-0">Permssions</legend>
                        <div class="col-sm-10">
                            @foreach($permissions as $permission)
                                <div class="form-check">
                                    <input class="form-check-input" name="{{ $permission->name }}" type="checkbox" id="{{ $permission->name }}">
                                    <label class="form-check-label" for="gridCheck1">
                                        {{ $permission->name }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Create</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

