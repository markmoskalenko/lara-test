<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddInitTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table)
        {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('products', function (Blueprint $table)
        {
            $table->id();
            $table->string('name');
            $table->decimal('price');
            $table->boolean('is_published')->default(false);
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('product_categories', function (Blueprint $table)
        {
            $table->id();
            $table->foreignId('product_id');
            $table->foreignId('category_id');
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
        //
    }
}
