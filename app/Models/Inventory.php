<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    use HasFactory;

    // Define the table name explicitly (optional if default conventions are followed)
    protected $table = 'inventories'; 

    // Define which attributes are mass assignable
    protected $fillable = ['part_number', 'quantity', 'location'];

    // Define castings to ensure proper data type formatting when retrieving attributes
    protected $casts = [
        'quantity' => 'integer',
        'created_at' => 'datetime',  // Automatically cast the created_at and updated_at to Carbon instances
        'updated_at' => 'datetime',
    ];

    // Add accessors or mutators if needed
    // Example: Add an accessor to format part_number to uppercase
    public function getPartNumberAttribute($value)
    {
        return strtoupper($value);
    }

    // Define any custom scopes for frequent queries
    public function scopeByLocation($query, $location)
    {
        return $query->where('location', $location);
    }

    // Define the inverse relationship with the Job model
    public function jobs()
    {
        return $this->hasMany(Job::class);
    }

    // Example of a "soft delete" if you want to allow inventory items to be soft deleted
    // Uncomment if using soft deletes
    // use Illuminate\Database\Eloquent\SoftDeletes;
    // protected $dates = ['deleted_at'];

    // You could also add any custom methods related to inventory logic
    public function decrementQuantity($amount)
    {
        // Custom method to decrement the inventory quantity
        if ($this->quantity >= $amount) {
            $this->quantity -= $amount;
            $this->save();
        } else {
            throw new \Exception("Insufficient quantity");
        }
    }
}
