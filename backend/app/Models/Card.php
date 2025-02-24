<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    protected $fillable = [
        'front',
        'back',
    ];

    public function deck()
    {
        return $this->belongsTo(Deck::class);
    }
}
