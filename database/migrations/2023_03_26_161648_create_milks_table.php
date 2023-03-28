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
        Schema::create('milks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cattle_id')->nullable()->index();
            $table->foreign('cattle_id')->references('id')->on('cattle');
            $table->string('date');
            $table->string('morning_amt');
            $table->string('noon_amt')->nullable();
            $table->string('evening_amt')->nullable();
            $table->string('total')->nullable();
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
        Schema::dropIfExists('milks');
    }
};
