<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class DetalleFactura
 *
 * @property $id
 * @property $uuid
 * @property $factura_id
 * @property $producto_id
 * @property $cantidad
 * @property $iva
 * @property $total
 * @property $subtotal
 * @property $status
 * @property $created_at
 * @property $updated_at
 * @property $user_creator
 * @property $user_last_update
 *
 * @property Factura $factura
 * @property Producto $producto
 * @property User $user
 * @property User $user
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class DetalleFactura extends Model
{

    /**
     * table
     *
     * @var string
     */
    protected $table = 'detalle_factura';

    static $rules = [
        'factura_id' => 'required',
        'producto_id' => 'required',
        'subtotal' => 'required',
        'user_creator' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['uuid', 'factura_id', 'producto_id', 'cantidad', 'iva', 'total', 'subtotal', 'status', 'user_creator', 'user_last_update'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function factura()
    {
        return $this->hasOne('App\Models\Factura', 'id', 'factura_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function producto()
    {
        return $this->hasOne('App\Models\Producto', 'id', 'producto_id');
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
