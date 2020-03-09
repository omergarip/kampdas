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
            $table->bigIncrements('id');
            $table->integer('created_by');
            $table->string('title');
            $table->text('description');
            $table->integer('limit');
            $table->string('location');
            $table->string('lat');
            $table->string('lng');
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->string('slug');
            $table->integer('is_pinned');
            $table->softDeletes();
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
