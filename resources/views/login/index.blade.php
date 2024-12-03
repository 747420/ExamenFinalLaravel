@extends('layouts.auth')

@section('title', 'Iniciar Sesión')

@section('content')
    <main class="container mx-auto mt-8 p-4">
        <h1 class="text-3xl font-bold mb-6 text-center">Iniciar Sesión</h1>
        <form action="{{ route('login.authenticate') }}" method="POST" class="max-w-md mx-auto space-y-4">
            @csrf
            <fieldset class="space-y-4">
                <legend class="sr-only">Información de inicio de sesión</legend>

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
            </fieldset>

            <button type="submit" class="btn btn-primary w-full mt-6">Iniciar Sesión</button>
            <section class="text-center mt-4">
                <p class="text-sm">¿No tienes una cuenta?</p>
                <a href="{{ route('register.index') }}" class="text-primary hover:underline">Registrarse</a>
            </section>
        </form>
    </main>
@endsection
