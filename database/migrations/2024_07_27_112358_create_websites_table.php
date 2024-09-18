<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWebsitesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('websites', function (Blueprint $table) {
            $table->id();
            $table->integer('language_id')->nullable();
            $table->integer('currency_id')->nullable();
            $table->string('header_logo')->nullable();
            $table->string('banner_large')->nullable();
            $table->string('banner_medium')->nullable();
            $table->string('banner_small')->nullable();
            $table->string('banner_link')->nullable();
            $table->string('phone')->nullable();
            $table->string('main_email')->nullable();
            $table->string('support_email')->nullable();
            $table->string('address')->nullable();
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
        Schema::dropIfExists('websites');
    }
}
