<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('jobs', function (Blueprint $table) {
            $table->string('job_number')->unique()->nullable(); // Add a unique job number
            $table->string('job_status')->default('Pending');   // Add a status with default value 'Pending'
        });
    }

    public function down()
    {
        Schema::table('jobs', function (Blueprint $table) {
            $table->dropColumn(['job_number', 'job_status']);
        });
    }
};