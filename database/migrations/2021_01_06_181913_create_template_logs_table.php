<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTemplateLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('template_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('template_id')->constrained('templates')->cascadeOnDelete();
            $table->string('username');
            $table->string('recipient_number');
            $table->text('message')->nullable();
            $table->integer('result_code');
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
        Schema::dropIfExists('template_logs');
    }
}
