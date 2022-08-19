<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


/**
 * categoria
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
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class categoria extends Model
{

    /**
     * table
     *
     * @var string
     */
    protected $table = 'categoria';

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

    use HasFactory;

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
