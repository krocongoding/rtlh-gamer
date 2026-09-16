<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HouseCeiling extends Model
{
    protected $fillable = [
        'house_id',
        'condition_id',
    ];

    public function house()
    {
        return $this->belongsTo(House::class);
    }
}
