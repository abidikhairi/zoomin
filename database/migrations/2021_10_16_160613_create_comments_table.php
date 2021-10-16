<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->string('content', 255);
            $table->unsignedBigInteger('report_id');
            $table->unsignedBigInteger('magistrate_id');
            $table->timestamps();

            $table->foreign('report_id')->references('id')->on('reports')
                ->onDelete('cascade');
            $table->foreign('magistrate_id')->references('id')->on('magistrates')
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
        Schema::dropIfExists('comments');
    }
}
