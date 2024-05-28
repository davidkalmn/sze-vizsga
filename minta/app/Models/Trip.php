<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
    use HasFactory;

    protected $fillable = ['destination_id', 'transportation_id', 'price'];

    public function destination()
    {
        return $this->belongsTo(Destination::class);
    }

    public function transportation()
    {
        return $this->belongsTo(Transportation::class);
    }

    public function tripDates()
    {
        return $this->hasMany(TripDate::class);
    }
}
