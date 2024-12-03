@extends('layouts.app')

@section('title', 'Gestión de Tareas')

@section('content')
<main class="container mx-auto px-4 py-8">
    <header class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold">Gestión de Tareas</h1>
        <button class="btn btn-primary" onclick="document.getElementById('create-modal').showModal()">Nueva Tarea</button>
    </header>

    @if(session('success'))
        <aside class="alert alert-success mb-4">
            {{ session('success') }}
        </aside>
    @endif

    <section class="overflow-x-auto">
        <table class="table w-full">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Título</th>
                    <th>Descripción</th>
                    <th>Categoría</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($tasks as $task)
                <tr>
                    <td>{{ $task->id }}</td>
                    <td>{{ $task->title }}</td>
                    <td>{{ Str::limit($task->description, 50) }}</td>
                    <td>{{ $task->category->name }}</td>
                    <td>
                        <span class="badge {{ $task->completed ? 'badge-success' : 'badge-error' }}">
                            {{ $task->completed ? 'Completada' : 'Pendiente' }}
                        </span>
                    </td>
                    <td class="flex gap-2">
                        <button class="btn btn-sm btn-info" 
                                onclick="openEditModal({{ $task->id }}, '{{ $task->title }}', '{{ $task->description }}', {{ $task->category_id }}, {{ $task->completed ? 'true' : 'false' }})">
                            Editar
                        </button>
                        <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-error" 
                                    onclick="return confirm('¿Estás seguro de eliminar esta tarea?')">
                                Eliminar
                            </button>
                        </form>
                        <form action="{{ route('tasks.toggle-complete', $task->id) }}" method="POST" class="inline">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn btn-sm {{ $task->completed ? 'btn-warning' : 'btn-success' }}">
                                {{ $task->completed ? 'Marcar Pendiente' : 'Marcar Completada' }}
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </section>
</main>

<dialog id="create-modal" class="modal">
    <article class="modal-box">
        <h3 class="font-bold text-lg mb-4">Nueva Tarea</h3>
        <form action="{{ route('tasks.store') }}" method="POST">
            @csrf
            <fieldset class="form-control mb-4">
                <label class="label">
                    <span class="label-text">Título</span>
                </label>
                <input type="text" name="title" class="input input-bordered" required>
            </fieldset>
            <fieldset class="form-control mb-4">
                <label class="label">
                    <span class="label-text">Descripción</span>
                </label>
                <textarea name="description" class="textarea textarea-bordered" required></textarea>
            </fieldset>
            <fieldset class="form-control mb-4">
                <label class="label">
                    <span class="label-text">Categoría</span>
                </label>
                <select name="category_id" class="select select-bordered" required>
                    <option value="">Selecciona una categoría</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </fieldset>
            <fieldset class="form-control mb-4">
                <label class="label cursor-pointer">
                    <span class="label-text">Completada</span>
                    <input type="checkbox" name="completed" class="toggle" value="1">
                </label>
            </fieldset>
            <footer class="modal-action">
                <button type="submit" class="btn btn-primary">Guardar</button>
                <button type="button" class="btn" onclick="document.getElementById('create-modal').close()">Cancelar</button>
            </footer>
        </form>
    </article>
</dialog>

<dialog id="edit-modal" class="modal">
    <article class="modal-box">
        <h3 class="font-bold text-lg mb-4">Editar Tarea</h3>
        <form id="edit-form" method="POST">
            @csrf
            @method('PUT')
            <fieldset class="form-control mb-4">
                <label class="label">
                    <span class="label-text">Título</span>
                </label>
                <input type="text" name="title" id="edit-title" class="input input-bordered" required>
            </fieldset>
            <fieldset class="form-control mb-4">
                <label class="label">
                    <span class="label-text">Descripción</span>
                </label>
                <textarea name="description" id="edit-description" class="textarea textarea-bordered" required></textarea>
            </fieldset>
            <fieldset class="form-control mb-4">
                <label class="label">
                    <span class="label-text">Categoría</span>
                </label>
                <select name="category_id" id="edit-category" class="select select-bordered" required>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </fieldset>
            <fieldset class="form-control mb-4">
                <label class="label cursor-pointer">
                    <span class="label-text">Completada</span>
                    <input type="checkbox" name="completed" id="edit-completed" class="toggle" value="1">
                </label>
            </fieldset>
            <footer class="modal-action">
                <button type="submit" class="btn btn-primary">Actualizar</button>
                <button type="button" class="btn" onclick="document.getElementById('edit-modal').close()">Cancelar</button>
            </footer>
        </form>
    </article>
</dialog>

<script>
function openEditModal(id, title, description, categoryId, completed) {
    const modal = document.getElementById('edit-modal');
    const form = document.getElementById('edit-form');
    
    form.action = `/tasks/${id}`;
    document.getElementById('edit-title').value = title;
    document.getElementById('edit-description').value = description;
    document.getElementById('edit-category').value = categoryId;
    document.getElementById('edit-completed').checked = completed;
    
    modal.showModal();
}
</script>
@endsection