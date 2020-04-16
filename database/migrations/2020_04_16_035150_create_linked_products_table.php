<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLinkedProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_links', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('code',6);
            $table->string('first_site',400)->nullable();
            $table->string('second_site',400)->nullable();
            $table->string('third_site',400)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_links');
    }
}
