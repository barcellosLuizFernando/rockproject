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
            $table->foreignId('idCalendar')->constrained('calendars');
            $table->string('google_id');
            $table->string('title');
            $table->string('description');
            $table->boolean('allday');
            $table->dateTime('start');
            $table->dateTime('end');
            $table->boolean('editable')->default(false);
            $table->string('backgroundColor')->nullable();
            $table->string('borderColor')->nullable();
            $table->string('textColor')->nullable();
            $table->integer('idClassRoom')->nullable();
            $table->integer('idClassLocal')->nullable();
            $table->integer('groupId')->nullable();
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
