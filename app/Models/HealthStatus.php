<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HealthStatus extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function cattle()
    {
        return $this->belongsTo(Cattle::class)->withDefault();
    }

    public function calf()
    {
        return $this->belongsTo(Calf::class)->withDefault();
    }

    public function user()
    {
        return $this->belongsTo(User::class,'added_by','id');
    }
}
