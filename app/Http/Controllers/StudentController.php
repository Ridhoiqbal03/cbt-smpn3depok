<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class StudentController extends Controller
{
    public function index()
    {
        $students = User::role('student')->orderBy('id', 'DESC')->get();
        return view('superadmin.student.index', compact('students'));
    }

    public function create()
    {
        return view('superadmin.student.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
        ]);

        DB::beginTransaction();

        try {
            $validated['password'] = bcrypt($validated['password']);
            $validated['slug'] = Str::slug($request->name);

            $user = User::create($validated);
            $user->assignRole('student');

            DB::commit();
            return redirect()->route('dashboard.students.index');
        } catch (\Exception $e) {
            DB::rollBack();
            throw ValidationException::withMessages([
                'system_error' => ['System error: ' . $e->getMessage()],
            ]);
        }
    }

    public function show(User $student)
    {
        return view('superadmin.student.show', ['student' => $student]);
    }

    public function edit(User $student)
    {
        return view('superadmin.student.edit', compact('student'));
    }

    public function update(Request $request, User $student)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $student->id,
            'password' => 'nullable|string|min:6',
        ]);

        DB::beginTransaction();

        try {
            if (!empty($validated['password'])) {
                $validated['password'] = bcrypt($validated['password']);
            } else {
                unset($validated['password']);
            }

            $validated['slug'] = Str::slug($request->name);
            $student->update($validated);

            DB::commit();
            return redirect()->route('dashboard.students.index');
        } catch (\Exception $e) {
            DB::rollBack();
            throw ValidationException::withMessages([
                'system_error' => ['System error: ' . $e->getMessage()],
            ]);
        }
    }

    public function destroy(User $student)
    {
        try {
            $student->delete();
            return redirect()->route('dashboard.students.index');
        } catch (\Exception $e) {
            DB::rollBack();
            throw ValidationException::withMessages([
                'system_error' => ['System error: ' . $e->getMessage()],
            ]);
        }
    }
}
