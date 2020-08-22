<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255);
            $table->text('description');
            $table->string('image', 255);
            $table->timestamps();
        });

        Schema::create('posts_comments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('post_id')->index();
            $table->text('description');
            $table->timestamps();

            $table->foreign('post_id')->references('id')->on('posts')->onDelete('cascade');
        });

        Schema::create('posts_likes', function (Blueprint $table) {
            $table->id();
            $table->integer('count');
            $table->unsignedBigInteger('post_id')->index();

            $table->foreign('post_id')->references('id')->on('posts')->onDelete('cascade');
        });

        Schema::create('posts_tags', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255);
            $table->unsignedBigInteger('post_id')->index();

            $table->foreign('post_id')->references('id')->on('posts')->onDelete('cascade');
        });

        Schema::create('posts_views', function (Blueprint $table) {
            $table->id();
            $table->integer('count');
            $table->unsignedBigInteger('post_id')->index();

            $table->foreign('post_id')->references('id')->on('posts')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('posts_comments', function (Blueprint $table) {
            $table->dropForeign('posts_comments_post_id_foreign');
        });

        Schema::dropIfExists('posts_comments');

        Schema::table('posts_likes', function (Blueprint $table) {
            $table->dropForeign('posts_likes_post_id_foreign');
        });

        Schema::dropIfExists('posts_likes');

        Schema::table('posts_tags', function (Blueprint $table) {
            $table->dropForeign('posts_tags_post_id_foreign');
        });

        Schema::dropIfExists('posts_tags');

        Schema::table('posts_views', function (Blueprint $table) {
            $table->dropForeign('posts_views_post_id_foreign');
        });

        Schema::dropIfExists('posts_views');

        Schema::dropIfExists('posts');
    }
}
