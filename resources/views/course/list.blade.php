@extends('layouts.app')
@section('title', 'Courses')
@section('content')
    <h1>Courses</h1>
    <p><a href="/courses/create">Create Course</a></p>

    <table>
        <thead>
            <tr><th>ID</th><th>Name</th><th>Weeks</th><th>Fee</th><th>Difficulty</th><th>Active</th><th>Actions</th></tr>
        </thead>
        <tbody>
            @forelse($courses as $course)
                <tr>
                    <td>{{ $course->id }}</td>
                    <td>{{ $course->name }}</td>
                    <td>{{ $course->duration }}</td>
                    <td>{{ number_format($course->fee, 2) }}</td>
                    <td>{{ $course->difficulty }}</td>
                    <td>{{ $course->is_active ? 'Yes' : 'No' }}</td>
                    <td>
                        <a href="/courses/{{ $course->id }}">View</a>
                        <a href="/courses/{{ $course->id }}/edit">Edit</a>
                        <form action="/courses/{{ $course->id }}" method="POST" style="display:inline"
                              onsubmit="return confirm('Delete this course?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="7">No courses found.</td></tr>
            @endforelse
        </tbody>
    </table>
@endsection