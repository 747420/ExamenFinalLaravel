<?php

namespace App\Services;

use App\Models\Category;

/**
 * Clase CategoryService
 *
 * Esta clase de servicio maneja operaciones CRUD para categorías.
 *
 * @author Jheivy Stiven Moreno Silva
 */
class CategoryService
{
    /**
     * Obtiene todas las categorías.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAllCategories()
    {
        return Category::all();
    }

    /**
     * Crea una nueva categoría.
     *
     * @param string $name El nombre de la categoría
     * @return Category La categoría recién creada
     */
    public function createCategory($name)
    {
        return Category::create([
            'name' => $name
        ]);
    }

    /**
     * Actualiza una categoría existente.
     *
     * @param int $id El ID de la categoría a actualizar
     * @param string $name El nuevo nombre para la categoría
     * @return Category La categoría actualizada
     */
    public function updateCategory($id, $name)
    {
        $category = Category::findOrFail($id);
        $category->update([
            'name' => $name
        ]);
        return $category;
    }

    /**
     * Elimina una categoría.
     *
     * @param int $id El ID de la categoría a eliminar
     * @return bool Verdadero si la eliminación fue exitosa
     */
    public function deleteCategory($id)
    {
        $category = Category::findOrFail($id);
        return $category->delete();
    }
}