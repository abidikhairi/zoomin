<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReportTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('reports', function (Blueprint $table) {
            $table->dropColumn('type');
        });

        Schema::create('report_types', function (Blueprint $table) {
            $table->id();
            $table->string('type')->nullable(false);
            $table->timestamps();
        });

        Schema::table('reports', function (Blueprint $table) {
            $table->unsignedBigInteger('report_type_id');
            $table->foreign('report_type_id')->references('id')->on('report_types')
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
        Schema::dropIfExists('report_types');
    }
}
