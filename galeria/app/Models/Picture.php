<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Picture extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'description', 'user_id', 'img', 'date',
    ];
    protected $casts = [
        'date' => 'datetime',
    ];
}
