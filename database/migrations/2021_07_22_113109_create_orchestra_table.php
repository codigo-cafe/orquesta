<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrchestraTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orchestra', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description');
            $table->text('mission');
            $table->text('vission');
            $table->string('email');
            $table->string('phone', 20);
            $table->string('direction');
            $table->string('banner', 2048)->nullable();
            $table->decimal('latitude', 9, 6);
            $table->decimal('longitude', 9, 6);
            $table->mediumText('iframe')->nullable();
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
        Schema::dropIfExists('orchestra');
    }
}
