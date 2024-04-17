<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\User;
use App\Models\Place;
use App\Models\Character;

class Contest extends Model
{
    use HasFactory;
    protected $fillable = [
        'win',
        'history',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function place()
    {
        return $this->belongsTo(Place::class, 'place_id');
    }

    public function characters()
    {
        return $this->belongsToMany(Character::class);
    }
}
