<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Job extends Model
{
    use HasFactory;

    protected $fillable = [
        'purchase_order_number',
        'order_date',
        'expected_delivery_date',
        'item_code',
        'revision_drawing',
        'description',
        'quantity_required',
        'unit_price',
        'quantity_delivered',
        'job_number',
        'job_status',
        'created_at',
        'updated_at',
    ];
    
    
    // Define a many-to-one relationship with Inventory
    public function inventory()
    {
        return $this->belongsTo(Inventory::class);
    }
}
