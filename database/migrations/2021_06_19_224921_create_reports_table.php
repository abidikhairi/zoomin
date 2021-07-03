<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('link');
            $table->enum('type', \App\Models\CourtOfAudit\Report::TYPES);
            $table->string('year', 4);
            $table->string('pdf_file');
            $table->unsignedBigInteger('sector_id');
            $table->unsignedBigInteger('establishment_id');
            $table->unsignedBigInteger('magistrate_id');
            $table->timestamps();

            $table->foreign('sector_id')->references('id')->on('sectors')
                ->onDelete('cascade');
            $table->foreign('establishment_id')->references('id')->on('establishments')
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
        Schema::dropIfExists('reports');
    }
}
