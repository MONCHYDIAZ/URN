<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Talla
 *
 * @property $id
 * @property $uuid
 * @property $nombre
 * @property $descripcion
 * @property $status
 * @property $created_at
 * @property $updated_at
 * @property $user_creator
 * @property $user_last_update
 *
 * @property Producto[] $productos
 * @property TallasProducto $tallasProducto
 * @property User $user
 * @property User $user
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Talla extends Model
{

    /**
     * table
     *
     * @var string
     */
    protected $table = 'talla';

    static $rules = [
        'nombre' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['uuid', 'nombre', 'descripcion', 'status', 'user_creator', 'user_last_update'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function productos()
    {
        return $this->hasMany('App\Models\Producto', 'id_categoria', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function tallasProducto()
    {
        return $this->hasOne('App\Models\TallasProducto', 'talla_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user_creator()
    {
        return $this->hasOne('App\Models\User', 'id', 'user_creator');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user_last_update()
    {
        return $this->hasOne('App\Models\User', 'id', 'user_last_update');
    }

    /**
     * The roles that belong to the user.
     */
    public function tallasProductos()
    {
        return $this->belongsToMany('App\Models\TallasProducto', 'tallas_productos', 'talla_id', 'producto_id');
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
