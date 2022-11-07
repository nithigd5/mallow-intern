@props(['users'])

@extends('layouts.dashboard')

@section('title', 'View Roles')

@section('content')
    <div class="container text-center">

        <div class="row p-2 fs-6 align-items-center fw-semibold fs-5 bg-primary text-white rounded-3 shadow-md mb-3">
            <div class="col-4 col-md-4">User</div>
            <div class="col-4 col-md-4">Role</div>
{{--            <div class="col-4 col-md-4">Action</div>--}}
        </div>
        @foreach($users as $user)
            <div class="row p-2 fs-6 align-items-center fw-semibold rounded-3 bg-white shadow my-2">
                <div class="col-4 col-md-4"> {{ $user->name  }} </div>
                <div class="col-4 col-md-4"> @foreach($user->getRoleNames() as $role)
                        {{ $role }}
                    @endforeach </div>
{{--                <div--}}
{{--                    class="col-4 col-md-4 d-flex flex-column  flex-xl-row  gap-2 align-content-center justify-content-center">--}}
{{--                    <form action="{{ route('roles.revoke', ['role' => $user->getRoleNames()->first(), 'user' => $user->id]) }}"--}}
{{--                          method="post" class="col p-0">--}}
{{--                        @csrf--}}
{{--                        @method('DELETE')--}}
{{--                        <x-danger-button height="min-content" width="100%">Delete--}}
{{--                        </x-danger-button>--}}
{{--                    </form>--}}
{{--                </div>--}}
            </div>
        @endforeach
    </div>
@endsection
