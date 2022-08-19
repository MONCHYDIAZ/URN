<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class TallasProducto
 *
 * @property $talla_id
 * @property $producto_id
 * @property $created_at
 * @property $updated_at
 * @property $user_creator
 *
 * @property Producto $producto
 * @property Talla $talla
 * @property User $user
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class TallasProducto extends Model
{

    static $rules = [
        'talla_id' => 'required',
        'producto_id' => 'required',
    ];

    /**
     * table
     *
     * @var string
     */
    protected $table = 'talla';

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['talla_id', 'producto_id', 'user_creator'];


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
    public function talla()
    {
        return $this->hasOne('App\Models\Talla', 'id', 'talla_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user()
    {
        return $this->hasOne('App\Models\User', 'id', 'user_creator');
    }
}
