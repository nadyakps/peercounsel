<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::whereIn('role', ['konseli', 'konselor']);

        // Filter berdasarkan role
        if ($request->filled('role')) {
            $query->where('role', $request->role);
        }

        // Pencarian berdasarkan nama atau email
        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        $users = $query->latest()->paginate(10)->withQueryString();

        return view('admin.users.index', compact('users'));
    }
    public function create()
{
    return view('admin.users.create');
}

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:konseli,konselor',
        ]);

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']),
            'role' => $validated['role'],
        ]);

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'Pengguna berhasil ditambahkan.');
    }

    
public function edit(User $user)
{
    // Admin hanya boleh mengedit akun konseli dan konselor
    abort_unless(
        in_array($user->role, ['konseli', 'konselor']),
        404
    );

    return view('admin.users.edit', compact('user'));
}

    public function update(Request $request, User $user)
    {
        // Pastikan akun yang diedit bukan akun admin
        abort_unless(
            in_array($user->role, ['konseli', 'konselor']),
            404
        );

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'role' => 'required|in:konseli,konselor',
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->role = $validated['role'];

        // Password hanya diubah jika Admin mengisi password baru
        if (!empty($validated['password'])) {
            $user->password = bcrypt($validated['password']);
        }

        $user->save();

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'Data pengguna berhasil diperbarui.');
    }

    
    public function toggleStatus(User $user)
    {
        // Admin hanya dapat mengubah status akun konseli dan konselor
        abort_unless(
            in_array($user->role, ['konseli', 'konselor']),
            404
        );

        // Ubah status aktif menjadi nonaktif atau sebaliknya
        $user->is_active = !$user->is_active;

        $user->save();

        $message = $user->is_active
            ? 'Akun pengguna berhasil diaktifkan.'
            : 'Akun pengguna berhasil dinonaktifkan.';

        return redirect()
            ->route('admin.users.index')
            ->with('success', $message);
    }

}