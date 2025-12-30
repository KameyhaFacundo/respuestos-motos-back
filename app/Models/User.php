<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $primaryKey = 'nro_usu';
    protected $fillable = [
        'des_usu',
        'email',
        'password',
        'id_sucursal',
        'usuario_cobro_rapido',
        'admin'

    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    // protected $casts = [
    //     'password' => 'hashed'
    // ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    public function permiso()
    {
        return $this->belongsTo(Permiso::class, 'id_permisos', 'id');
    }

    public function sucursal()
    {
        return $this->belongsTo(Sucursal::class, 'id_sucursal', 'id');
    }

    public function permisos()
    {
        return $this->belongsToMany(PermisoUsuario::class, 'permisos_usuarios', 'nro_usu', 'id_permisos')->withTimestamps();
    }

    public function permisosUsuarios()
    {
        return $this->belongsToMany(Permiso::class, 'permisos_usuarios', 'nro_usu', 'id_permisos');
    }

    public function chequearPermiso($permiso)
    {
        $permisosUsuarioRela = $this->permisosUsuarios()->get()->toArray();
        $codigos = array_map(function ($permiso) {
            return $permiso['permiso']['codigo'];
        }, $permisosUsuarioRela);
        return in_array($permiso, $codigos);
    }
}