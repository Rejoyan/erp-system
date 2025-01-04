<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobsTable extends Migration
{
    public function up()
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->id();
            $table->date('order_date')->index(); // Indexed for faster queries
            $table->date('delivery_date')->index(); // Indexed for faster queries
            $table->string('po_number', 50)->unique(); // Length constraint added
            $table->string('part_number', 50); // Length constraint added
            $table->string('revision', 20)->nullable(); // Length constraint added
            $table->text('description')->nullable();
            $table->unsignedInteger('units_required'); // Ensures no negative values
            $table->unsignedDecimal('price_per_unit', 10, 2); // Unsigned for non-negative values
            $table->string('job_number', 20)->nullable(); // Length constraint added
            $table->unsignedDecimal('cost_per_unit', 10, 2)->nullable(); // Unsigned for non-negative values
            $table->unsignedInteger('stock_in_hand')->nullable(); // Ensures no negative values
            $table->string('stock_location', 50)->nullable(); // Length constraint added
            $table->enum('job_status', [
                'Not Opened Yet',
                'In Process - Material Ordered',
                'In Process - Labour',
                'In Process - External Process',
                'Ready in Dispatch',
                'Delivered'
            ])->default('Not Opened Yet')->index(); // Default value added and indexed
            $table->timestamps();
            $table->softDeletes(); // Adds deleted_at column for soft deletes
        });
    }

    public function down()
    {
        Schema::dropIfExists('jobs');
    }
}
