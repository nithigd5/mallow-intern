@extends('layouts.dashboard')

@section('title', 'Edit Roles')

@section('content')
    <div class="row justify-content-center">
        <div class="card col-md-8">
            <div class="card-header">Edit Your Roles Here</div>
            <div class="card-body">
                <form action="/dashboard/roles/assign/{{ $user->id }}}" class="row needs-validation pt-4" method="post" novalidate>
                    @csrf
                    @method('PUT')
                    <h3>User: {{ $user->name }}</h3>
                    <div class="row mb-3">
                        <legend class="col-form-label col-sm-2 pt-0">Roles</legend>
                        <div class="col-sm-10">
                            @foreach($roles as $role)
                                <div class="form-check">
                                    <input class="form-check-input" name="{{ $role->name }}" type="checkbox"
                                           id="{{ $role->name }}">
                                    <label class="form-check-label" for="{{ $role->name }}">
                                        {{ $role->name }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Assign</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

