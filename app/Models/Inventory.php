<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Inventory extends Model
{
    use HasFactory;

    protected $table = 'inventories'; 

    protected $fillable = ['part_number', 'quantity', 'location'];

    public function jobs()
    {
        return $this->hasMany(Job::class);
    }
};