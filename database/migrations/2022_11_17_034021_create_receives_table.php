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
        Schema::create('receives', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_number');
            $table->timestamps();
            $table->foreignId('products_id')->index('fk_receives_to_products');
            $table->integer('qty');
            $table->foreignId('suppliers_id')->index('fk_receives_to_suppliers')->nullable();
            $table->text('note')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('receives');
    }
};
