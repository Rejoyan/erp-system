<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->id();
            $table->string('purchase_order_number')->unique();
            $table->date('order_date')->default(DB::raw('CURRENT_DATE'))->change();            $table->date('expected_delivery_date');
            $table->string('item_code');
            $table->string('revision_drawing')->nullable();
            $table->string('description');
            $table->integer('quantity_required');
            $table->decimal('unit_price', 8, 2);
            $table->integer('quantity_delivered')->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('jobs');
    }
};
