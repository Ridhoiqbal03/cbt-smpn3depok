<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class TeacherController extends Controller
{
    public function index()
    {
        $teachers = User::role('teacher')->orderBy('id', 'DESC')->get();
        return view('superadmin.teacher.index', compact('teachers'));
    }

    public function create()
    {
        return view('superadmin.teacher.create');
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
            $user->assignRole('teacher');

            DB::commit();
            return redirect()->route('dashboard.teachers.index');
        } catch (\Exception $e) {
            DB::rollBack();
            throw ValidationException::withMessages([
                'system_error' => ['System error: ' . $e->getMessage()],
            ]);
        }
    }

    public function show(User $teacher)
    {
        return view('superadmin.teacher.show', ['teacher' => $teacher]);
    }

    public function edit(User $teacher)
    {
        return view('superadmin.teacher.edit', compact('teacher'));
    }

    public function update(Request $request, User $teacher)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $teacher->id,
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
            $teacher->update($validated);

            DB::commit();
            return redirect()->route('dashboard.teachers.index');
        } catch (\Exception $e) {
            DB::rollBack();
            throw ValidationException::withMessages([
                'system_error' => ['System error: ' . $e->getMessage()],
            ]);
        }
    }

    public function destroy(User $teacher)
    {
        try {
            $teacher->delete();
            return redirect()->route('dashboard.teachers.index');
        } catch (\Exception $e) {
            DB::rollBack();
            throw ValidationException::withMessages([
                'system_error' => ['System error: ' . $e->getMessage()],
            ]);
        }
    }
}
