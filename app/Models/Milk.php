<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Milk extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function cattle()
    {
        return $this->belongsTo(Cattle::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class,'added_by','id');
    }
}
