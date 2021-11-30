<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->string('slug');
            $table->double('price');
            $table->smallInteger('discount')->nullable();
            $table->string('code');
            $table->integer('quantity');
            $table->string('condition')->nullable()->default('normal');
            $table->integer('status')->nullable()->default(1)->comment('0=inactive, 1=live, 2=discontinued, 3=force_stock_out');
            $table->string('image')->nullable();
            $table->boolean('is_featured')->nullable()->default(0)->comment('0=not featured, 1=featured');
            $table->tinyText('short_description');
            $table->text('long_description');
            $table->bigInteger('brand_id');
            $table->bigInteger('category_id');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
