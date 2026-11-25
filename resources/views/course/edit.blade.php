@extends('layouts.app')
@section('title', 'Edit Course')
@section('content')
    <h1>Edit Course</h1>
    <form action="/courses/{{ $course->id }}" method="POST">
        @csrf
        @method('PUT')
        @include('course._form')
        <button type="submit">Update Course</button>
    </form>
    <p><a href="/courses">Back to Courses</a></p>
@endsection