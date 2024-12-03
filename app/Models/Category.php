<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Task;

/**
 * Class Category
 * 
 * Modelo que representa una categoría en la aplicación.
 * 
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * 
 * @package App\Models
 * @author Jheivy Stiven Moreno Silva
 */
class Category extends Model
{
    /**
     * Los atributos que son asignables en masa.
     *
     * @var array
     */
    protected $fillable = [
        'name',
    ];

    /**
     * Obtiene las tareas asociadas a esta categoría.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}
