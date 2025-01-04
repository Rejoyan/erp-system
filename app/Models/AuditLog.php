<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuditLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'action',
        'model_type',
        'model_id',
        'created_at',
        'updated_at',
    ];

    // Define the relationship with User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}