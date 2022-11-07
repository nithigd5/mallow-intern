@props(['roles'])

@extends('layouts.dashboard')

@section('title', 'View Roles')

@section('content')
    <div class="container text-center">

        <div class="row p-2 fs-6 align-items-center fw-semibold fs-5 bg-primary text-white rounded-3 shadow-md mb-3">
            <div class="col-4 col-md-2">Id</div>
            <div class="col-4 col-md-3">Role</div>
            <div class="col-4 col-md-2">Permission Count</div>
            <div class="col-4 col-md-3">Action</div>
        </div>
        @foreach($roles as $role)
            <div class="row p-2 fs-6 align-items-center fw-semibold rounded-3 bg-white shadow my-2">
                <div class="col-4 col-md-2"> {{ $role->id  }} </div>
                <div class="col-4 col-md-3"> {{ $role->name  }} </div>
                <div class="col-4 col-md-2"> {{ $role->permissions->count()  }} </div>
                <div class="col-4 col-md-3 d-flex flex-column  flex-xl-row  gap-2 align-content-center justify-content-center">
                    <a class="col btn btn-secondary" href="/dashboard/roles/{{$role->id}}/edit"> Edit
                    </a>
                </div>
            </div>
        @endforeach
    </div>
@endsection
