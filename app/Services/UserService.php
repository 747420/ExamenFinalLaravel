<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

/**
 * Clase UserService
 *
 * Esta clase proporciona métodos para gestionar usuarios en la aplicación.
 *
 * @author Jheivy Stiven Moreno Silva
 */
class UserService {
    /**
     * Crea un nuevo usuario.
     *
     * @param string $name Nombre del usuario
     * @param string $email Correo electrónico del usuario
     * @param string $password Contraseña del usuario
     * @return void
     */
    public static function create($name, $email, $password) {
        User::create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password),
        ]);
    }

    /**
     * Actualiza un usuario existente.
     *
     * @param int $id ID del usuario
     * @param string $name Nuevo nombre del usuario
     * @param string $email Nuevo correo electrónico del usuario
     * @param string $password Nueva contraseña del usuario
     * @return void
     */
    public static function update($id, $name, $email, $password) {
        User::find($id)->update([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password),
        ]);
    }

    /**
     * Elimina un usuario.
     *
     * @param int $id ID del usuario a eliminar
     * @return void
     */
    public static function delete($id) {
        User::find($id)->delete();
    }

    /**
     * Busca un usuario por su correo electrónico.
     *
     * @param string $email Correo electrónico del usuario
     * @return User|null
     */
    public static function findByEmail($email) {
        return User::where('email', $email)->first();
    }

    /**
     * Busca un usuario por su correo electrónico y contraseña.
     *
     * @param string $email Correo electrónico del usuario
     * @param string $password Contraseña del usuario
     * @return User|null
     */
    public static function findByEmailAndPassword($email, $password) {
        return User::where('email', $email)->where('password', $password)->first();
    }
}