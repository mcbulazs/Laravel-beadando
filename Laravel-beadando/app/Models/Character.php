<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Character extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'enemy',
        'defence',
        'strength',
        'accuracy',
        'magic'
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
