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
        Schema::create('calves', function (Blueprint $table) {
            $table->id();
            $table->string('calf_no');
            $table->unsignedBigInteger('parent_id')->nullable()->index();
            $table->foreign('parent_id')->references('id')->on('cattle');
            $table->unsignedBigInteger('stall_id')->nullable()->index();
            $table->foreign('stall_id')->references('id')->on('stalls');
            $table->string('weight');
            $table->string('image')->nullable();
            $table->string('birth_date');
            $table->string('insemination_type');
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
        Schema::dropIfExists('calves');
    }
};
