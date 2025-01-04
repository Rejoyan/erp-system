<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'message',
        'is_read',
        'created_at',
        'updated_at',
    ];

    // Define the relationship with User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}