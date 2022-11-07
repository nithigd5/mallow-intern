@props(['users'])

@extends('layouts.dashboard')

@section('title', 'View User Roles')

@section('content')
    <div class="container text-center">

        <div class="row p-2 fs-6 align-items-center fw-semibold fs-5 bg-primary text-white rounded-3 shadow-md mb-3">
            <div class="col-4 col-md-4">User</div>
            <div class="col-4 col-md-4">Role</div>
            <div class="col-4 col-md-4">Action</div>
        </div>
        @foreach($users as $user)
            <div class="row p-2 fs-6 align-items-center fw-semibold rounded-3 bg-white shadow my-2">
                <div class="col-4 col-md-4"> {{ $user->name  }} </div>
                <div class="col-4 col-md-4"> @foreach($user->getRoleNames() as $role)
                        {{ $role }}
                    @endforeach </div>
                <div
                    class="col-4 col-md-4 d-flex flex-column  flex-xl-row  gap-2 align-content-center justify-content-center">
                    @if(!$user->hasRole('superAdmin'))
                        <a class="col btn btn-secondary" href="/dashboard/roles/assign/{{$user->id}}/edit"> Edit
                        </a>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
@endsection
