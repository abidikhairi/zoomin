<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResponsesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('responses', function (Blueprint $table) {
            $table->id();
            $table->string('report_file');
            $table->unsignedBigInteger('magistrate_id');
            $table->unsignedBigInteger('claim_id');
            $table->timestamps();

            $table->foreign('magistrate_id')->references('id')->on('magistrates')
                ->onDelete('cascade');
            $table->foreign('claim_id')->references('id')->on('claims')
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
        Schema::dropIfExists('responses');
    }
}
