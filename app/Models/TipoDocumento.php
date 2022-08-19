<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TipoDocumento
 *
 * @property $id
 * @property $uuid
 * @property $nombre
 * @property $abreviatura
 * @property $status
 * @property $created_at
 * @property $updated_at
 *
 * @property User[] $users
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class TipoDocumento extends Model
{
    use HasFactory;

    static $rules = [
        'nombre' => 'required',
        'abreviatura' => 'required'
    ];

    /**
     * table
     *
     * @var string
     */
    protected $table = 'tipo_documento';

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
    protected $fillable = ['uuid', 'nombre', 'abreviatura', 'status'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function users()
    {
        return $this->hasMany('App\Models\User', 'tipo_documento_id', 'id');
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
