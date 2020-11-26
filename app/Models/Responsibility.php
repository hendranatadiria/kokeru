<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Responsibility extends Model
{
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'cleaning_service_id',
        'room_id',
        'assigned_from',
        'assigned_to',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'cleaning_service_id' => 'integer',
        'room_id' => 'integer',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'assigned_from',
        'assigned_to',
    ];


    public function cleaningService()
    {
        return $this->belongsTo(\App\Models\Cleaningservice::class);
    }

    public function room()
    {
        return $this->belongsTo(\App\Models\Room::class);
    }
}
