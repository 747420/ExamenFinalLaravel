<?php

namespace App\Services;

use App\Models\Task;

/**
 * Clase TaskService
 *
 * Esta clase de servicio maneja operaciones CRUD para tareas.
 *
 * @author Jheivy Stiven Moreno Silva
 */
class TaskService
{
    /**
     * Obtiene todas las tareas.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAllTasks()
    {
        return Task::with('category')->get();
    }

    /**
     * Crea una nueva tarea.
     *
     * @param array $data Datos de la tarea
     * @return Task La tarea recién creada
     */
    public function createTask(array $data)
    {
        return Task::create([
            'title' => $data['title'],
            'description' => $data['description'],
            'category_id' => $data['category_id'],
            'completed' => isset($data['completed']) ? true : false
        ]);
    }

    /**
     * Actualiza una tarea existente.
     *
     * @param int $id ID de la tarea
     * @param array $data Nuevos datos de la tarea
     * @return Task La tarea actualizada
     */
    public function updateTask($id, array $data)
    {
        $task = Task::findOrFail($id);
        $task->update([
            'title' => $data['title'],
            'description' => $data['description'],
            'category_id' => $data['category_id'],
            'completed' => isset($data['completed']) ? true : false
        ]);
        return $task;
    }

    /**
     * Elimina una tarea.
     *
     * @param int $id ID de la tarea
     * @return bool Verdadero si la eliminación fue exitosa
     */
    public function deleteTask($id)
    {
        $task = Task::findOrFail($id);
        return $task->delete();
    }

    /**
     * Cambia el estado de completado de una tarea.
     *
     * @param int $id ID de la tarea
     * @return Task La tarea actualizada
     */
    public function toggleComplete($id)
    {
        $task = Task::findOrFail($id);
        $task->completed = !$task->completed;
        $task->save();
        return $task;
    }

    /**
     * Obtiene las tareas por categoría.
     *
     * @param int $categoryId ID de la categoría
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getTasksByCategory($categoryId)
    {
        return Task::where('category_id', $categoryId)->with('category')->get();
    }
}
