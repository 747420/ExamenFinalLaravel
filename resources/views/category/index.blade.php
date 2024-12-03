@extends('layouts.app')

@section('title', 'Categorías')

@section('content')
<main class="container mx-auto px-4 py-8">
    <header class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold">Gestión de Categorías</h1>
        <button class="btn btn-primary" onclick="document.getElementById('create-modal').showModal()">Nueva Categoría</button>
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
                    <th>Nombre</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($categories as $category)
                <tr>
                    <td>{{ $category->id }}</td>
                    <td>{{ $category->name }}</td>
                    <td class="flex gap-2">
                        <button class="btn btn-sm btn-info" 
                                onclick="openEditModal({{ $category->id }}, '{{ $category->name }}')">
                            Editar
                        </button>
                        <form action="{{ route('categories.destroy', $category->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-error" 
                                    onclick="return confirm('¿Estás seguro de eliminar esta categoría?')">
                                Eliminar
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
        <h3 class="font-bold text-lg mb-4">Nueva Categoría</h3>
        <form action="{{ route('categories.store') }}" method="POST">
            @csrf
            <fieldset class="form-control">
                <label class="label">
                    <span class="label-text">Nombre de la categoría</span>
                </label>
                <input type="text" name="name" class="input input-bordered" required>
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
        <h3 class="font-bold text-lg mb-4">Editar Categoría</h3>
        <form id="edit-form" method="POST">
            @csrf
            @method('PUT')
            <fieldset class="form-control">
                <label class="label">
                    <span class="label-text">Nombre de la categoría</span>
                </label>
                <input type="text" name="name" id="edit-name" class="input input-bordered" required>
            </fieldset>
            <footer class="modal-action">
                <button type="submit" class="btn btn-primary">Actualizar</button>
                <button type="button" class="btn" onclick="document.getElementById('edit-modal').close()">Cancelar</button>
            </footer>
        </form>
    </article>
</dialog>

<script>
function openEditModal(id, name) {
    const modal = document.getElementById('edit-modal');
    const form = document.getElementById('edit-form');
    const nameInput = document.getElementById('edit-name');
    
    form.action = `/categories/${id}`;
    nameInput.value = name;
    modal.showModal();
}
</script>
@endsection
