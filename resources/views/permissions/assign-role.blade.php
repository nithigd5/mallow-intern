@props(['permissions'])

@extends('layouts.dashboard')

@section('title', 'Assign Roles')

@section('content')
    <div class="row justify-content-center">
        <div class="card col-md-8">
            <div class="card-header">Assign Your Roles Here</div>
            <div class="card-body">
                <form action="/dashboard/roles/assign" class="row needs-validation pt-4" method="post" novalidate>
                    @csrf
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Users</label>
                        <div class="col-sm-10">
                            <select name="form_user" class="form-select @error('form_user') is-invalid @enderror"
                                    aria-label="Default select example">
                                <option selected="" disabled>Users</option>
                                @foreach($users as $user)
                                    @if($user->hasRole('superAdmin'))
                                        @continue
                                    @endif
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback">
                                @error('form_user')
                                {{ $message }}
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <legend class="col-form-label col-sm-2 pt-0">Roles</legend>
                        <div class="col-sm-10">
                            @foreach($roles as $role)
                                @if($role->name === 'superAdmin')
                                    @continue
                                @endif
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

