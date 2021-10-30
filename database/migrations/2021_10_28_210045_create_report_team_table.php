<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReportTeamTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('report_type_team', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('report_type_id');
            $table->unsignedBigInteger('team_id');
            $table->timestamps();

            $table->foreign('report_type_id')->references('id')->on('report_types')
                ->onDelete('cascade');
            $table->foreign('team_id')->references('id')->on('teams')
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
        Schema::dropIfExists('report_team');
    }
}
