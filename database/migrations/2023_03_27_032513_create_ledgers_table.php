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
        Schema::create('ledgers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cattle_id')->nullable()->index();
            $table->foreign('cattle_id')->references('id')->on('cattle');
            $table->unsignedBigInteger('calf_id')->nullable()->index();
            $table->foreign('calf_id')->references('id')->on('calves');
            $table->string('medication_name')->nullable();
            $table->enum('ledger_type',['Income','Expense']);
            $table->string('date');
            $table->string('name')->nullable();
            $table->enum('inventory_type',['Asset','Stock'])->nullable();
            $table->unsignedBigInteger('tag_id')->index()->nullable();
            $table->foreign('tag_id')->references('id')->on('tags');
            $table->string('description')->nullable();
            $table->string('unit')->nullable();
            $table->string('quantity')->nullable();
            $table->string('remaining_quantity')->nullable();
            $table->string('warrant')->nullable();
            $table->string('amount');
            $table->string('source');
            $table->string('contact');
            $table->string('vet_remarks')->nullable();
            $table->string('next_appointment')->nullable();
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
        Schema::dropIfExists('ledgers');
    }
};
