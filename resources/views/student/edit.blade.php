@extends('layouts.app')
@section('title', 'Edit Student')
@section('content')
    <h1>Edit Student</h1>
    <form action="/students/{{ $student->id }}" method="POST">
        @csrf
        @method('PUT')
        @include('student._form')
        <button type="submit">Update Student</button>
    </form>
    <p><a href="/students">Back to Students</a></p>
@endsection