<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEstablishmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();
        Schema::create('establishments', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();

            $table->unsignedBigInteger('sector_id');
            $table->foreign('sector_id')->references('id')
                ->on('sectors')
                ->onDelete('cascade');

            $table->unsignedBigInteger('governorate_id');
            $table->foreign('governorate_id')->references('id')
                ->on('governorates')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('establishments');
    }
}
