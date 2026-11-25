@extends('layouts.app')
@section('title', 'Create Student')
@section('content')
    <h1>Create Student</h1>
    <form action="/students" method="POST">
        @csrf
        @include('student._form')
        <button type="submit">Create Student</button>
    </form>
    <p><a href="/students">Back to Students</a></p>
@endsection