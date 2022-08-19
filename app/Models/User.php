<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/**
 * Class User
 *
 * @property $id
 * @property $uuid
 * @property $name
 * @property $email
 * @property $email_verified_at
 * @property $password
 * @property $rol_id
 * @property $tipo_documento_id
 * @property $documento
 * @property $direccion
 * @property $telefono
 * @property $fecha_nacimiento
 * @property $remember_token
 * @property $created_at
 * @property $updated_at
 *
 * @property Rol $rol
 * @property TipoDocumento $tipoDocumento
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;


    const PROFILES = ['admin' => 1, 'vendedor' => 2];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'documento',
        'direccion',
        'telefono',
        'rol_id',
        'tipo_documento_id',
        'fecha_nacimiento'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    static $rules = [
        'name' => 'required',
        'email' => 'required|email||unique:users',
        'rol_id' => 'required|integer',
        'tipo_documento_id' => 'required|integer',
        'documento' => 'required|integer|unique:users',
        'direccion' => 'required',
        'telefono' => 'required|integer||unique:users',
        'fecha_nacimiento' => 'required|date',
    ];

    /**
     * perPage
     *
     * @var int
     */
    protected $perPage = 20;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function rol()
    {
        return $this->hasOne('App\Models\Rol', 'id', 'rol_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function TipoDocumento()
    {
        return $this->hasOne('App\Models\TipoDocumento', 'id', 'tipo_documento_id');
    }

    /**
     * boot
     *
     * @return void
     */
    public static function boot()
    {
        parent::boot();

        self::creating(function ($model) {
            $uuid = \Ramsey\Uuid\Uuid::uuid4();
            $model->uuid = $uuid->toString();
            $model->user_creator = auth()->id();
            return $model;
        });

        self::created(function ($model) {
            // ... code here
        });

        self::updating(function ($model) {
            $model->user_last_update = auth()->id();
            return $model;
        });

        self::updated(function ($model) {
            // ... code here
        });

        self::deleting(function ($model) {
            // ... code here
        });

        self::deleted(function ($model) {
            // ... code here
        });
    }
}
