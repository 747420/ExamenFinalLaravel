<?php

namespace App\Http\Controllers;

use App\Services\TaskService;
use App\Services\CategoryService;
use Illuminate\Http\Request;

/**
 * Class TaskController
 * 
 * Controlador para manejar las operaciones relacionadas con las tareas.
 * 
 * @package App\Http\Controllers
 * @author Jheivy Stiven Moreno Silva
 */
class TaskController extends Controller
{
    /** @var TaskService */
    protected $taskService;
    
    /** @var CategoryService */
    protected $categoryService;

    /**
     * Constructor del controlador.
     *
     * @param TaskService $taskService
     * @param CategoryService $categoryService
     */
    public function __construct(TaskService $taskService, CategoryService $categoryService)
    {
        $this->taskService = $taskService;
        $this->categoryService = $categoryService;
    }

    /**
     * Muestra la lista de tareas.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $tasks = $this->taskService->getAllTasks();
        $categories = $this->categoryService->getAllCategories();
        return view('task.index', compact('tasks', 'categories'));
    }

    /**
     * Almacena una nueva tarea.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'completed' => 'boolean'
        ]);

        $this->taskService->createTask($validated);
        return redirect()->route('tasks.list')->with('success', 'Tarea creada exitosamente');
    }

    /**
     * Actualiza una tarea existente.
     *
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'completed' => 'boolean'
        ]);

        $this->taskService->updateTask($id, $validated);
        return redirect()->route('tasks.list')->with('success', 'Tarea actualizada exitosamente');
    }

    /**
     * Elimina una tarea.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $this->taskService->deleteTask($id);
        return redirect()->route('tasks.list')->with('success', 'Tarea eliminada exitosamente');
    }

    /**
     * Cambia el estado de completado de una tarea.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function toggleComplete($id)
    {
        $this->taskService->toggleComplete($id);
        return redirect()->route('tasks.list')->with('success', 'Estado de la tarea actualizado exitosamente');
    }
}
