<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\Password;

class EmployeeController extends Controller
{
    public function index(Request $request)
    {
        $query = Employee::query();

        // Search functionality
        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%$search%")
                  ->orWhere('email', 'like', "%$search%")
                  ->orWhere('username', 'like', "%$search%")
                  ->orWhere('nik', 'like', "%$search%")
                  ->orWhere('phone', 'like', "%$search%");
            });
        }

        // Filter functionality
        if ($request->has('filter')) {
            $filter = $request->filter;
            if (in_array($filter, ['Active', 'Inactive'])) {
                $query->where('status', $filter);
            } else {
                $query->where('role', $filter);
            }
        }

        $employees = $query->latest()->paginate(10);

        return view('employees.index', compact('employees'));
    }

    public function create()
    {
        return view('employees.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:employees',
            'email' => 'required|email|unique:employees|max:255',
            'password' => ['required', 'confirmed', Password::min(8)],
            'nik' => 'required|string|max:20|unique:employees',
            'phone' => 'required|string|max:20',
            'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'role' => 'required|in:Project Manager,Developer,QA/Tester,Admin',
            'status' => 'required|in:Active,Inactive',
        ]);

        if ($request->hasFile('profile_photo')) {
            $validated['profile_photo'] = $request->file('profile_photo')->store('profile-photos', 'public');
        }

        $employee = Employee::create([
            ...$validated,
            'password' => bcrypt($validated['password']),
        ]);

        User::create([
            'full_name' => $validated['name'],
            'username' => $validated['username'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']),
            'role' => $validated['role'],
            'email_verified_at' => now(),
        ]);

        return redirect()->route('employees.index')->with('success', 'Employee created and can now log in.');
    }

    public function edit(Employee $employee)
    {
        return view('employees.edit', compact('employee'));
    }

    public function update(Request $request, Employee $employee)
    {
        $rules = [
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:employees,username,' . $employee->id,
            'email' => 'required|email|max:255|unique:employees,email,' . $employee->id,
            'nik' => 'required|string|max:20|unique:employees,nik,' . $employee->id,
            'phone' => 'required|string|max:20',
            'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'role' => 'required|in:Project Manager,Developer,QA/Tester,Admin',
            'status' => 'required|in:Active,Inactive',
        ];

        if ($request->filled('password')) {
            $rules['password'] = ['confirmed', Password::min(8)];
        }

        $validated = $request->validate($rules);

        if ($request->filled('password')) {
            $validated['password'] = bcrypt($request->password);
        } else {
            unset($validated['password']);
        }

        if ($request->has('remove_photo')) {
            if ($employee->profile_photo) {
                Storage::disk('public')->delete($employee->profile_photo);
            }
            $validated['profile_photo'] = null;
        }

        if ($request->hasFile('profile_photo')) {
            if ($employee->profile_photo) {
                Storage::disk('public')->delete($employee->profile_photo);
            }
            $validated['profile_photo'] = $request->file('profile_photo')->store('profile-photos', 'public');
        }

        $employee->update($validated);

        // Sinkronisasi ke tabel users jika ada
        $user = User::where('email', $employee->email)->first();
        if ($user) {
            $user->full_name = $validated['name'];
            $user->username = $validated['username'];
            $user->email = $validated['email'];
            $user->role = $validated['role'];
            if (isset($validated['password'])) {
                $user->password = $validated['password'];
            }
            $user->save();
        }

        return redirect()->route('employees.index')->with('success', 'Employee updated successfully.');
    }

   public function destroy(Employee $employee)
{
    if ($employee->profile_photo) {
        Storage::disk('public')->delete($employee->profile_photo);
    }

    // Hapus user yang berkaitan
    $user = User::where('email', $employee->email)->first();
    if ($user) {
        $user->delete();
    }

    $employee->delete();

    return redirect()->route('employees.index')->with('success', 'Employee deleted successfully.');
}

}
