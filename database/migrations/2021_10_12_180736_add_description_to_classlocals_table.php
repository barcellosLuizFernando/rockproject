<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDescriptionToClasslocalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('classlocals', function (Blueprint $table) {
            //
            $table->string('description')->after('id');
            $table->string('district')->after('address');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('classlocals', function (Blueprint $table) {
            //
            $table->dropColumn('description');
            $table->dropColumn('district');
        });
    }
}
