<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Factura
 *
 * @property $id
 * @property $uuid
 * @property $cliente_id
 * @property $total
 * @property $subtotal
 * @property $iva
 * @property $status
 * @property $created_at
 * @property $updated_at
 * @property $user_creator
 * @property $user_last_update
 *
 * @property DetalleFactura[] $detalleFacturas
 * @property User $user
 * @property User $user
 * @property User $user
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Factura extends Model
{

    static $rules = [
        'cliente_id' => 'required',
        'subtotal' => 'required',
    ];

    /**
     * table
     *
     * @var string
     */
    protected $table = 'factura';

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
    protected $fillable = ['uuid', 'cliente_id', 'total', 'subtotal', 'iva', 'status', 'user_creator', 'user_last_update'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function detalleFacturas()
    {
        return $this->hasMany('App\Models\DetalleFactura', 'factura_id', 'id');
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
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function cliente()
    {
        return $this->hasOne('App\Models\User', 'id', 'cliente_id');
    }
}
