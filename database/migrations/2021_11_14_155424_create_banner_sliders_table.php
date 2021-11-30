<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBannerSlidersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('banner_sliders', function (Blueprint $table) {
            $table->id();
            $table->string('short_note', 50)->nullable();
            $table->string('normal_title', 100);
            $table->string('colored_title', 50)->nullable();
            $table->string('short_description')->nullable();
            $table->string('image');
            $table->boolean('status')->nullable()->default(1)->comment('0=inactive, 1=live');
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
        Schema::dropIfExists('banner_sliders');
    }
}
