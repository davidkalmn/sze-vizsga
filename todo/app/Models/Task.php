<?php

// app/Models/Task.php

// app/Models/Task.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'user_id',
        'status',
        'deadline',
        'priority'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
