<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Contracts\UserServiceInterface;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function __construct(
        protected UserServiceInterface $userService
    ) {
    }

    // public function index()
    // {
    //     $users= [];
    //     $role= Auth::user()->role;
    //     if ($role === 'admin') {
    //         $users = $this->userService->all();
    //     } elseif ($role === 'employee') {
    //         $users = $this->userService->customer();
    //     } else {
    //         abort(403, 'No tienes permiso para acceder a esta página.');
    //     }
        
    //     return view('users.index', compact('users'));
    // }

    public function index()
{
    $users = $this->userService->all();

    // Si quien está mirando es un empleado, filtramos los administradores
    if (auth()->user()->role === 'employee') {
        $users = array_filter($users, fn($u) => ($u['role'] ?? '') !== 'admin');
    }

    return view('users.index', compact('users'));
}


    public function create()
    {
        return view('users.create');
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:8',
            'role' => 'required|in:admin,employee,customer',
        ]);

        // Hasheamos la contraseña antes de mandarla al servicio
        $validated['password'] = Hash::make($validated['password']);

        $this->userService->create($validated);

        return redirect()->route('users.index')->with('success', 'Usuario creado con éxito.');
    }

    public function show(string $id)
    {
        $user = $this->userService->find($id);
        abort_if(!$user, 404, 'Usuario no encontrado.');
        return view('users.show', compact('user'));
    }


    public function edit(string $id)
    {
        $user = $this->userService->find($id);
        abort_if(!$user, 404, 'Usuario no encontrado.');
        return view('users.edit', compact('user'));
    }


    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'role' => 'required|in:admin,employee,customer',
        ]);

        $updated = $this->userService->update($id, $validated);
        abort_if(!$updated, 404, 'Usuario no encontrado.');

        return redirect()->route('users.index')->with('success', 'Usuario actualizado con éxito.');
    }

    public function destroy(string $id)
    {
        $deleted = $this->userService->delete($id);
        abort_if(!$deleted, 404, 'Usuario no encontrado.');

        return redirect()->route('users.index')->with('success', 'Usuario eliminado con éxito.');
    }

    public function reset(): RedirectResponse
    {
        $this->userService->reset();
        return redirect()->route('users.index')->with('success', 'Usuarios reiniciados con éxito.');
    }
}
