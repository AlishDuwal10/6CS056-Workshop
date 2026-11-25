<?php

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