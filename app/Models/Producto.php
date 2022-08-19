<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Producto
 *
 * @property $id
 * @property $uuid
 * @property $nombre
 * @property $color
 * @property $precio
 * @property $descripcion
 * @property $id_categoria
 * @property $cantidad
 * @property $status
 * @property $created_at
 * @property $updated_at
 * @property $user_creator
 * @property $user_last_update
 *
 * @property Categorium $categorium
 * @property Talla $talla
 * @property TallasProducto[] $tallasProductos
 * @property User $user
 * @property User $user
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Producto extends Model
{
    /**
     * table
     *
     * @var string
     */
    protected $table = 'producto';

    static $rules = [
        'nombre' => 'required',
        'color' => 'required',
        'precio' => 'required|integer',
        'descripcion' => 'required',
        'id_categoria' => 'required|integer',
        'cantidad' => 'required'
    ];

    /**
     * perPage
     *
     * @var int
     */
    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['uuid', 'nombre', 'color', 'precio', 'descripcion', 'id_categoria', 'cantidad', 'status', 'user_creator', 'user_last_update'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function categorium()
    {
        return $this->hasOne('App\Models\Categoria', 'id', 'id_categoria');
    }

    /**
     * The roles that belong to the user.
     */
    public function tallasProductos()
    {
        return $this->belongsToMany('App\Models\TallasProducto', 'tallas_productos', 'producto_id', 'talla_id');
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
