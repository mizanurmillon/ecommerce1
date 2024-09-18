<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogpostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blogposts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('blogcategory_id');
            $table->string('blog_title')->nullable();
            $table->string('blog_slug')->nullable();
            $table->string('banner_image')->nullable();
            $table->string('short_description')->nullable();
            $table->text('description')->nullable();
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->string('meta_image')->nullable();
            $table->string('meta_keyword')->nullable();
            $table->string('status')->nullable()->default(0);
            $table->timestamps();
            $table->foreign('blogcategory_id')->references('id')->on('blogcategories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('blogposts');
    }
}
