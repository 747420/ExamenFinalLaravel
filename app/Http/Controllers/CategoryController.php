<?php

namespace App\Http\Controllers;

use App\Services\CategoryService;
use Illuminate\Http\Request;

/**
 * Class CategoryController
 * 
 * Controlador para manejar operaciones CRUD de categorías.
 * 
 * @package App\Http\Controllers
 * @author Jheivy Stiven Moreno Silva
 */
class CategoryController extends Controller
{
    /** @var CategoryService */
    protected $categoryService;

    /**
     * Constructor del controlador.
     * 
     * @param CategoryService $categoryService Servicio de categorías inyectado
     */
    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    /**
     * Muestra la lista de todas las categorías.
     * 
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $categories = $this->categoryService->getAllCategories();
        return view('category.index', compact('categories'));
    }

    /**
     * Almacena una nueva categoría en la base de datos.
     * 
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255'
        ]);

        $this->categoryService->createCategory($request->name);
        return redirect()->route('categories.index')->with('success', 'Categoría creada exitosamente');
    }

    /**
     * Actualiza una categoría existente en la base de datos.
     * 
     * @param Request $request
     * @param int $id ID de la categoría a actualizar
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255'
        ]);

        $this->categoryService->updateCategory($id, $request->name);
        return redirect()->route('categories.index')->with('success', 'Categoría actualizada exitosamente');
    }

    /**
     * Elimina una categoría de la base de datos.
     * 
     * @param int $id ID de la categoría a eliminar
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $this->categoryService->deleteCategory($id);
        return redirect()->route('categories.index')->with('success', 'Categoría eliminada exitosamente');
    }
}
