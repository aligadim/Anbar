<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('komendants', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('staff_data');
            $table->string('image');
            $table->string('tapsiriq');
            $table->date('tarix');
            $table->time('vaxt');
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
        Schema::dropIfExists('komendants');
    }
};
