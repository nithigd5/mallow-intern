@props(['permissions'])

@extends('layouts.dashboard')

@section('title', 'Create Roles')

@section('content')
    <div class="row justify-content-center">
        <div class="card col-md-8">
            <div class="card-header">Create Your Roles Here</div>
            <div class="card-body">
                <form action="/dashboard/roles/assign" class="row needs-validation pt-4" method="post" novalidate>
                    @csrf
                    @method('PUT')
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Users</label>
                        <div class="col-sm-10">
                            <select name="user" class="form-select" aria-label="Default select example">
                                <option selected="" disabled>Users</option>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Roles</label>
                        <div class="col-sm-10">
                            <select name="role" class="form-select" aria-label="Default select example">
                                <option selected="" disabled>Roles</option>
                                @foreach($roles as $role)
                                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                                @endforeach
                            </select>
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

