<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CleaningHistory extends Model
{
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'room_id',
        'cleaning_service_id',
        'responsibility_id',
        'proof_1',
        'proof_2',
        'proof_3',
        'proof_4',
        'proof_5',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'room_id' => 'integer',
        'cleaning_service_id' => 'integer',
        'responsibility_id' => 'integer',
    ];


    public function room()
    {
        return $this->belongsTo(\App\Models\Room::class);
    }

    public function cleaningService()
    {
        return $this->belongsTo(\App\Models\Cleaningservice::class);
    }

    public function responsibility()
    {
        return $this->belongsTo(\App\Models\Responsibility::class);
    }
}
