<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateInventoriesTable extends Migration
{
    public function up()
    {
        Schema::table('inventories', function (Blueprint $table) {
            // Add new columns to the existing 'inventories' table
            $table->string('description')->after('part_number'); // description column
            $table->decimal('cost_price', 10, 2)->after('quantity'); // cost price column
            $table->decimal('sell_price', 10, 2)->after('cost_price'); // sell price column
            $table->string('stock_location')->nullable()->after('sell_price'); // nullable stock location
        });
    }

    public function down()
    {
        Schema::table('inventories', function (Blueprint $table) {
            // Drop the new columns in case of a rollback
            $table->dropColumn(['description', 'cost_price', 'sell_price', 'stock_location']);
        });
    }
}
