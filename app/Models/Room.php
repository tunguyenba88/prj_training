<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'manager_id',
    ];

    public function users()
    {
        return $this->hasMany(User::class, 'room_id', 'id');
    }
}
