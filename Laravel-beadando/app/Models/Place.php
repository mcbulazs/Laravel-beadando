<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Contest;

class Place extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'image'
    ];

    public function contests()
    {
        return $this->hasMany(Contest::class, 'place_id');
    }
}
