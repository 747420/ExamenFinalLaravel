<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Auth\LoginRequest;

/**
 * Class LoginController
 *
 * Controlador para manejar la autenticación de usuarios.
 *
 * @package App\Http\Controllers
 * @author Jheivy Stiven Moreno Silva
 */
class LoginController extends Controller
{
    /**
     * Muestra la vista de inicio de sesión.
     *
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request) {
        return view("login.index");
    }

    /**
     * Autentica al usuario y lo redirige a la página de inicio.
     *
     * @param LoginRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function authenticate(LoginRequest $request) {
        $request->authenticate();

        $request->session()->regenerate();

        return redirect(route("home", absolute: false));
    }
}
