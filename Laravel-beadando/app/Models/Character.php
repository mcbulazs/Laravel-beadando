<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\User;
use App\Models\Contest;

class Character extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'defence',
        'strength',
        'accuracy',
        'magic'
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function contests()
    {
        return $this->belongsToMany(Contest::class);
    }
}
