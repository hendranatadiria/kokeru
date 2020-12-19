<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCleaningHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();

        Schema::create('cleaning_histories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('room_id')->constrained()->cascadeOnDelete();
            $table->foreignId('cleaning_service_id')->constrained('cleaning_services')->cascadeOnDelete();
            $table->foreignId('responsibility_id')->constrained('responsibilities')->cascadeOnDelete();
            $table->string('proof_1');
            $table->string('proof_2')->nullable();
            $table->string('proof_3')->nullable();
            $table->string('proof_4')->nullable();
            $table->string('proof_5')->nullable();
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cleaning_histories');
    }
}
