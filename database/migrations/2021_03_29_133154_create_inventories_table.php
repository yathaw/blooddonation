<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInventoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventories', function (Blueprint $table) {
            $table->id();

            $table->string('count');

            $table->date('dod')->nullable();
            $table->date('dofd')->nullable();
            $table->string('status')->nullable();

            $table->foreignId('blood_id')
                    ->references('id')
                    ->on('bloods')
                    ->onDelete('cascade');

            $table->foreignId('donor_id')
                    ->references('id')
                    ->on('donors')
                    ->onDelete('cascade');

            $table->foreignId('user_id')
                    ->references('id')
                    ->on('users')
                    ->onDelete('cascade');

            $table->softDeletes();
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
        Schema::dropIfExists('inventories');
    }
}
