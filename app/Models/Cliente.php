<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    // Definir la tabla
    protected $table = 'cliente';

    // La clave primaria no es 'id', es 'cedula'
    protected $primaryKey = 'cli_cedula';

    // La clave primaria no es autoincremental
    public $incrementing = false;

    // Tipo de la clave primaria
    protected $keyType = 'string';

    // Campos que se pueden asignar masivamente
    protected $fillable = [
        'cli_cedula',
        'cli_correo',
        'cli_telefono'
    ];

    // Campos ocultos (no se incluyen en JSON)
    protected $hidden = [];

    /**
     * Relación: Un cliente puede tener un usuario_app
     */
    public function usuarioApp()
    {
        return $this->hasOne(UsuarioApp::class, 'cli_cedula', 'cli_cedula');
    }
}
