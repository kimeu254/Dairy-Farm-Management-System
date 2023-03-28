<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cattle extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class)->withDefault();
    }

    public function breed()
    {
        return $this->belongsTo(Breed::class)->withDefault();
    }

    public function stall()
    {
        return $this->belongsTo(Stall::class)->withDefault();
    }
}
