<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddJobNumberAndStatusToJobsTable extends Migration
{
    public function up()
    {
        Schema::table('jobs', function (Blueprint $table) {
            // Check if the column doesn't exist before adding it
            if (!Schema::hasColumn('jobs', 'job_status')) {
                $table->string('job_status')->nullable(); // Add job status if it doesn't exist
            }
        });
    }

    public function down()
    {
        Schema::table('jobs', function (Blueprint $table) {
            if (Schema::hasColumn('jobs', 'job_status')) {
                $table->dropColumn('job_status'); // Drop job status if it exists
            }
        });
    }
};