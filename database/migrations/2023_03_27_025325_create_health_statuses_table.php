<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('health_statuses', function (Blueprint $table) {
            $table->id();
            $table->string('date');
            $table->unsignedBigInteger('cattle_id')->nullable()->index();
            $table->foreign('cattle_id')->references('id')->on('cattle');
            $table->unsignedBigInteger('calf_id')->nullable()->index();
            $table->foreign('calf_id')->references('id')->on('calves');
            $table->string('health_status');
            $table->string('body_fitness');
            $table->string('description')->nullable();
            $table->string('remarks');
            $table->unsignedBigInteger('added_by')->nullable()->index();
            $table->foreign('added_by')->references('id')->on('users');
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
        Schema::dropIfExists('health_statuses');
    }
};
