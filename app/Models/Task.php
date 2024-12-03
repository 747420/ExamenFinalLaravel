<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Category;

/**
 * Class Task
 * 
 * Modelo que representa una tarea en la aplicación.
 *
 * @property int $id
 * @property string $title
 * @property string $description
 * @property bool $completed
 * @property int $category_id
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 *
 * @package App\Models
 * @author Jheivy Stiven Moreno Silva
 */
class Task extends Model
{
    /**
     * Los atributos que son asignables en masa.
     *
     * @var array<string>
     */
    protected $fillable = [
        'title',
        'description',
        'completed',
        'category_id'
    ];

    /**
     * Los atributos que deben ser convertidos.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'completed' => 'boolean',
    ];

    /**
     * Obtiene la categoría asociada a esta tarea.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
