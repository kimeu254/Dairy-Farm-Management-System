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
        Schema::create('cattle', function (Blueprint $table) {
            $table->id();
            $table->string('cattle_no');
            $table->unsignedBigInteger('breed_id')->nullable()->index();
            $table->foreign('breed_id')->references('id')->on('breeds');
            $table->unsignedBigInteger('stall_id')->nullable()->index();
            $table->foreign('stall_id')->references('id')->on('stalls');
            $table->string('weight');
            $table->string('image')->nullable();
            $table->string('farm_entry_date');
            $table->string('purchase_amt')->nullable();
            $table->string('current_value')->nullable();
            $table->text('comments')->nullable();
            $table->string('status')->nullable();
            $table->unsignedBigInteger('user_id')->nullable()->index();
            $table->foreign('user_id')->references('id')->on('users');
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
        Schema::dropIfExists('cattle');
    }
};
