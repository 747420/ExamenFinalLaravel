@extends('layouts.auth')

@section('title', 'Registro')

@section('content')
    <main class="container mx-auto mt-8 p-4 h-screen">
        <h1 class="text-3xl font-bold mb-6 text-center">Registro de Usuario</h1>
        <form action="{{ route('register.store') }}" method="POST" class="max-w-md mx-auto space-y-4">
            @csrf
            <fieldset class="space-y-4">
                <legend class="sr-only">Información de registro</legend>

                <label class="form-control">
                    <span class="label-text">Nombre</span>
                    <input type="text" name="name" class="input input-bordered w-full" value="{{ old('name') }}">
                    @error('name')
                        <span class="text-error text-xs mt-1">{{ $message }}</span>
                    @enderror
                </label>

                <label class="form-control">
                    <span class="label-text">Correo Electrónico</span>
                    <input type="email" name="email" class="input input-bordered w-full" value="{{ old('email') }}">
                    @error('email')
                        <span class="text-error text-xs mt-1">{{ $message }}</span>
                    @enderror
                </label>

                <label class="form-control">
                    <span class="label-text">Contraseña</span>
                    <input type="password" name="password" class="input input-bordered w-full">
                    @error('password')
                        <span class="text-error text-xs mt-1">{{ $message }}</span>
                    @enderror
                </label>

                <label class="form-control">
                    <span class="label-text">Confirmar Contraseña</span>
                    <input type="password" name="password_confirmation" class="input input-bordered w-full">
                    @error('password_confirmation')
                        <span class="text-error text-xs mt-1">{{ $message }}</span>
                    @enderror
                </label>
            </fieldset>

            <button type="submit" class="btn btn-primary w-full mt-6">Registrarse</button>
            <section class="text-center mt-4">
                <p class="text-sm">¿Ya tienes una cuenta?</p>
                <a href="{{ route('login.index') }}" class="text-primary hover:underline">Iniciar sesión</a>
            </section>

        </form>
    </main>
@endsection
