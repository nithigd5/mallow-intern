@props(['post'])

@extends('layouts.dashboard')

@section('title', 'View Post')

@section('content')
    <div class="container w-75 text-center">
        <div class="card">
            <div class="card-header">
                <div class="text-start">
                    Author : {{ $post->user->name }}
                </div>
            </div>
            <div class="card-body">
                <h5 class="card-title">{{ $post->title }}</h5>
                {{ $post->content }}
            </div>
            <div class="card-footer">
                <div class="row">
                    <div class="col">
                        Created At: {{ $post->updated_at->diffForHumans() }}
                    </div>
                    <div class="col">
                        Last Updated: {{ $post->created_at->diffForHumans() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

