<?php

use App\Models\Course;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\Rule;

Route::redirect('/', '/students');

// ---------- STUDENTS ----------

// List
Route::get('/students', function () {
    $students = Student::all();
    return view('student.list', ['students' => $students]);
})->name('students.index');

// Create form (must come BEFORE /students/{id})
Route::get('/students/create', function () {
    return view('student.create');
})->name('students.create');

// Store
Route::post('/students', function (Request $request) {
    $validated = $request->validate([
        'name'          => 'required|string|max:255',
        'email'         => 'required|email|max:255|unique:students,email',
        'phone'         => 'required|string|max:20',
        'address'       => 'nullable|string|max:500',
        'date_of_birth' => 'nullable|date',
    ]);

    $student = Student::create($validated);

    return redirect()->route('students.index')
        ->with('success', "Student {$student->name} created successfully!");
})->name('students.store');

// Detail
Route::get('/students/{id}', function ($id) {
    $student = Student::findOrFail($id);   // 404 if not found
    return view('student.detail', ['student' => $student]);
})->name('students.show');

// Edit form
Route::get('/students/{id}/edit', function ($id) {
    $student = Student::findOrFail($id);
    return view('student.edit', ['student' => $student]);
})->name('students.edit');

// Update
Route::put('/students/{id}', function (Request $request, $id) {
    $student = Student::findOrFail($id);

    $validated = $request->validate([
        'name'          => 'required|string|max:255',
        'email'         => ['required', 'email', 'max:255',
                            Rule::unique('students', 'email')->ignore($student->id)],
        'phone'         => 'required|string|max:20',
        'address'       => 'nullable|string|max:500',
        'date_of_birth' => 'nullable|date',
    ]);

    $student->update($validated);

    return redirect('/students/' . $student->id)
        ->with('success', 'Student updated successfully!');
})->name('students.update');

// Delete
Route::delete('/students/{id}', function ($id) {
    $student = Student::findOrFail($id);
    $student->delete();

    return redirect('/students')->with('success', 'Student deleted successfully!');
})->name('students.destroy');


// ---------- COURSES ----------

$courseRules = [
    'name'        => 'required|string|max:255',
    'description' => 'required|string|max:2000',
    'duration'    => 'required|integer|min:1|max:520',
    'fee'         => 'required|numeric|min:0|max:999999.99',
    'difficulty'  => 'required|in:Easy,Medium,Hard',
];

// List
Route::get('/courses', function () {
    return view('course.list', ['courses' => Course::all()]);
})->name('courses.index');

// Create form (must come BEFORE /courses/{id})
Route::get('/courses/create', function () {
    return view('course.create');
})->name('courses.create');

// Store
Route::post('/courses', function (Request $request) use ($courseRules) {
    $validated = $request->validate($courseRules);
    $validated['is_active'] = $request->boolean('is_active');  // unchecked checkbox sends nothing

    $course = Course::create($validated);

    return redirect()->route('courses.index')
        ->with('success', "Course {$course->name} created successfully!");
})->name('courses.store');

// Detail
Route::get('/courses/{id}', function ($id) {
    return view('course.detail', ['course' => Course::findOrFail($id)]);
})->name('courses.show');

// Edit form
Route::get('/courses/{id}/edit', function ($id) {
    return view('course.edit', ['course' => Course::findOrFail($id)]);
})->name('courses.edit');

// Update
Route::put('/courses/{id}', function (Request $request, $id) use ($courseRules) {
    $course = Course::findOrFail($id);

    $validated = $request->validate($courseRules);
    $validated['is_active'] = $request->boolean('is_active');

    $course->update($validated);

    return redirect('/courses/' . $course->id)
        ->with('success', 'Course updated successfully!');
})->name('courses.update');

// Delete
Route::delete('/courses/{id}', function ($id) {
    Course::findOrFail($id)->delete();

    return redirect('/courses')->with('success', 'Course deleted successfully!');
})->name('courses.destroy');