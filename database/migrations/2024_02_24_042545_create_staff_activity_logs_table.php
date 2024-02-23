<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStaffActivityLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('staff_activity_logs', function (Blueprint $table) {
            $table->id();
            $table->string('user_name');
            $table->string('staff_name');
            $table->string('sex');
            $table->string('email_address');
            $table->string('phone_number');
            $table->string('position');
            $table->string('department');
            $table->string('salary');
            $table->string('modify_user');
            $table->string('date_time')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('staff_activity_logs');
    }
}
