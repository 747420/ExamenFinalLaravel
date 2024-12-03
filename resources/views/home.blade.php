@extends("layouts.app")

@section("title", "Gestión de Tareas")

@section("content")
<main class="bg-base-400 text-gray-800">
    <header class="p-6 text-center">
        <h1 class="text-3xl font-semibold mb-3">Bienvenido a tu Gestor de Tareas</h1>
        <p class="text-base mb-4">Organiza, planifica y alcanza tus metas con facilidad</p>
        <nav class="space-x-3">
            <a href="#" class="btn btn-outline btn-primary">Ver Tareas</a>
            <a href="#" class="btn btn-outline btn-secondary">Crear Tarea</a>
        </nav>
    </header>

    <section class="p-6 grid grid-cols-1 md:grid-cols-3 gap-6">
        <article class="text-center p-4 bg-white shadow-sm rounded">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 mx-auto mb-2 text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
            </svg>
            <h2 class="text-lg font-medium mb-2">Gestiona Tareas</h2>
            <p class="text-gray-600 text-sm">Organiza y prioriza tus actividades diarias con facilidad.</p>
        </article>

        <article class="text-center p-4 bg-white shadow-sm rounded">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 mx-auto mb-2 text-green-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
            </svg>
            <h2 class="text-lg font-medium mb-2">Crea Nuevas Tareas</h2>
            <p class="text-gray-600 text-sm">Añade rápidamente nuevas tareas y mantén tu lista actualizada.</p>
        </article>

        <article class="text-center p-4 bg-white shadow-sm rounded">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 mx-auto mb-2 text-purple-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
            </svg>
            <h2 class="text-lg font-medium mb-2">Analiza tu Progreso</h2>
            <p class="text-gray-600 text-sm">Visualiza estadísticas y mejora tu productividad día a día.</p>
        </article>
    </section>
</main>
@endsection
