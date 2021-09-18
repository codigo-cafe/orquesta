<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description');
            $table->integer('price');
            $table->date('date');
            $table->time('start_time');
            $table->time('end_time');
            $table->mediumText('place');
            $table->string('cover', 2048);
            $table->string('slug');
            $table->boolean('status')->default(1);
            $table->foreignId('category_id')->nullable()->references('id')->on('categories')->onDelete(null);
            $table->foreignId('promotion_id')->nullable()->references('id')->on('promotions')->onDelete(null);
            $table->foreignId('user_id')->nullable()->references('id')->on('users')->onDelete(null);
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
        Schema::dropIfExists('events');
    }
}
