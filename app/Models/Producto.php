<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;




    protected $table = 'PRODUCTO';

    // Clave primaria personalizada
    protected $primaryKey = 'pro_codigo';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'pro_codigo',
        'cat_codigo',
        'cla_codigo',
        'bod_codigo',
        'pro_nombre',
        'pro_descripcion',
        'pro_existencia',
        'pro_precio_venta_ant',
        'pro_precio_venta',
        'pro_utilidad',
        'pro_imagen',
        'pro_alt_imagen',
    ];

    protected $casts = [
        'pro_existencia'       => 'integer',
        'pro_precio_venta_ant' => 'decimal:2',
        'pro_precio_venta'     => 'decimal:2',
        'pro_utilidad'         => 'decimal:2',
    ];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'cat_codigo', 'cat_codigo');
    }


}
