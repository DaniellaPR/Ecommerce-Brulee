<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;

    protected $table = 'CATEGORIA';

    // Clave primaria personalizada
    protected $primaryKey = 'cat_codigo';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'cat_codigo',
        'cat_descripcion',
    ];

    /**
     * Relación: Una categoría tiene muchos productos
     */
    public function productos()
    {
        return $this->hasMany(Producto::class, 'cat_codigo', 'cat_codigo');
    }
}
