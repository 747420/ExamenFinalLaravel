<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\UserService;
use App\Models\User;
use App\Http\Requests\Auth\LoginRequest;

/**
 * Class RegisterController
 *
 * Controlador para manejar el registro y autenticación de usuarios.
 *
 * @package App\Http\Controllers
 * @author Jheivy Stiven Moreno Silva
 */
class RegisterController extends Controller
{
    /**
     * Muestra la vista de registro.
     *
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request) {
        return view("register.index");
    }

    /**
     * Procesa el registro de un nuevo usuario.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request) {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required'],
            'password_confirmation' => ['required', 'same:password'],
        ]);

        UserService::create(
            $request->name,
            $request->email,
            $request->password
        );

        $loginRequest = new LoginRequest($request->all());
        $loginRequest->authenticate();

        $request->session()->regenerate();

        return redirect(route("home", absolute: false));
    }

    /**
     * Cierra la sesión del usuario actual.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(Request $request) {
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect("/");
    }
}
