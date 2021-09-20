<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesItensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('idSale')->constrained('sales');
            $table->foreignId('idProduct')->constrained('products');
            $table->foreignId('idFinancePlan')->constrained('financeplans');
            $table->double('value');
            $table->double('unitvalue');
            $table->integer('quantity');
            $table->string('description');
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
        Schema::dropIfExists('sales_items');
    }
}
