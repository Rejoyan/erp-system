<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddOrderDateToJobsTable extends Migration
{
    public function up()
    {
        Schema::table('jobs', function (Blueprint $table) {
            // Check if the column doesn't exist before adding it
            if (!Schema::hasColumn('jobs', 'order_date')) {
                $table->date('order_date')->after('purchase_order_number'); // Add the order_date column
            }
        });
    }

    public function down()
    {
        Schema::table('jobs', function (Blueprint $table) {
            // Check if the column exists before dropping it
            if (Schema::hasColumn('jobs', 'order_date')) {
                $table->dropColumn('order_date'); // Remove the order_date column if rolled back
            }
        });
    }
};
