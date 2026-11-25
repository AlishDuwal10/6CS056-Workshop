@extends('layouts.app')
@section('title', 'Create Course')
@section('content')
    <h1>Create Course</h1>
    <form action="/courses" method="POST">
        @csrf
        @include('course._form')
        <button type="submit">Create Course</button>
    </form>
    <p><a href="/courses">Back to Courses</a></p>
@endsection