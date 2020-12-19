<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'level',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
    ];



    public function cleaninghistory()
    {
        return $this->hasMany(\App\Models\CleaningHistory::class,'room_id', 'id');
    }

    public function responsibility()
    {
        return $this->hasMany(\App\Models\Responsibility::class,'room_id', 'id');
    }

}
