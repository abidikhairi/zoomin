<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClaimsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('claims', function (Blueprint $table) {
            $table->id();
            $table->text('subject');
            $table->json('files');
            $table->boolean('assigned')->default(false);

            $table->enum('status', App\Models\Citizen\Claim::STATUS)->nullable();

            $table->unsignedBigInteger('citizen_id');
            $table->foreign('citizen_id')->references('id')
                ->on('citizens')
                ->onDelete('cascade');

            $table->unsignedBigInteger('magistrate_id')->nullable();
            $table->foreign('magistrate_id')->references('id')
                ->on('magistrates')
                ->onDelete('cascade');

            $table->unsignedBigInteger('governorate_id');
            $table->foreign('governorate_id')->references('id')
                ->on('governorates');

            $table->unsignedBigInteger('sector_id');
            $table->foreign('sector_id')->references('id')
                ->on('sectors')
                ->onDelete('cascade');

            $table->unsignedBigInteger('establishment_id');
            $table->foreign('establishment_id')->references('id')
                ->on('establishments')
                ->onDelete('cascade');

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
        Schema::dropIfExists('claims');
    }
}
