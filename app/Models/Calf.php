<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Calf extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class)->withDefault();
    }

    public function cattle()
    {
        return $this->belongsTo(Cattle::class, 'parent_id','id')->withDefault();
    }

    public function stall()
    {
        return $this->belongsTo(Stall::class)->withDefault();
    }
}
