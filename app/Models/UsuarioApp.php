<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsuarioApp extends Model
{
    use HasFactory;

    protected $table = 'USUARIO_APP';

    protected $fillable = [
        'usr_nombre',
        'cli_cedula',
        'usr_contrasena',
    ];

    protected $hidden = [
        'usr_contrasena'
    ];



    /**
     * Relación: Un usuario_app pertenece a un cliente
     */
    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'cli_cedula', 'cli_cedula');
    }

    /**
     * Hashear contraseña automáticamente al asignarla
     */
    public function setContrasenaAttribute($value)
    {
        $this->attributes['usr_contrasena'] = \Hash::make($value);
    }

    /**
     * Verificar contraseña
     */
    public function verificarContrasena($clave)
    {
        return \Hash::check($clave, $this->usr_contrasena);
    }

    /**
     * Scope para usuarios activos
     */
    public function scopeActivos($query)
    {
        return $query->where('activo', true);
    }
}
