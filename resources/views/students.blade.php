@props([
    'students',
    'marks'
])

@extends('layouts.app')

@section('title', 'Students Details')

@section('content')

    <div class="jumbotron text-center">
        <h1>Students Data and Uploaded Profile Image</h1>
        <p class="lead">Students details are displayed here and Images also displayed here</p>
    </div>

    <div class="container">
        <table class="table table-striped h-100 table-hover table-dark">
            <thead>
            <tr class="table-primary">
                <th>Student ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Date Of Birth</th>
                <th>Phone</th>
                <th>Address</th>
                <th>Gender</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($students as $student)
                <tr>
                    <td>{{$student->id}}</td>
                    <td>{{$student->name}}</td>
                    <td>{{$student->email}}</td>
                    <td>{{$student->dob}}</td>
                    <td>{{$student->mobile}}</td>
                    <td>{{$student->address}}</td>
                    <td>{{$student->gender ?:'null'}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <h2>Students Marks</h2>
        <table class="table table-striped h-100 table-hover table-dark">
            <thead>
            <tr class="table-primary">
                <th>Student ID</th>
                <th>MARK ID</th>
                <th>Mark 1</th>
                <th>Mark 2</th>
                <th>Mark 3</th>
                <th>Mark 4</th>
                <th>Mark 5</th>
                <th>Average</th>
                <th>Percentage</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($marks as $mark)
                @php
                    $average = $mark->mark1 + $mark->mark2 + $mark->mark3 + $mark->mark4 + $mark->mark5;
                    $percentage = ($average / 500) * 100;
                    $average /= 5;
                @endphp
                <tr>
                    <td>{{$mark->student_id}}</td>
                    <td>{{$mark->id}}</td>
                    <td>{{$mark->mark1}}</td>
                    <td>{{$mark->mark2}}</td>
                    <td>{{$mark->mark3}}</td>
                    <td>{{$mark->mark4}}</td>
                    <td>{{$mark->mark5}}</td>
                    <td>{{$average}}</td>
                    <td>{{$percentage}}%</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

@endsection
