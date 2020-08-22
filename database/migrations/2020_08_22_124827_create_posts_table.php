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
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255);
            $table->text('description');
            $table->string('image', 255);
            $table->timestamps();
        });

        Schema::create('articles_comments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('article_id')->index();
            $table->text('description');
            $table->timestamps();

            $table->foreign('article_id')->references('id')->on('articles')->onDelete('cascade');
        });

        Schema::create('articles_likes', function (Blueprint $table) {
            $table->id();
            $table->integer('count');
            $table->unsignedBigInteger('article_id')->index();

            $table->foreign('article_id')->references('id')->on('articles')->onDelete('cascade');
        });

        Schema::create('articles_tags', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255);
            $table->unsignedBigInteger('article_id')->index();

            $table->foreign('article_id')->references('id')->on('articles')->onDelete('cascade');
        });

        Schema::create('articles_views', function (Blueprint $table) {
            $table->id();
            $table->integer('count');
            $table->unsignedBigInteger('article_id')->index();

            $table->foreign('article_id')->references('id')->on('articles')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('articles_comments', function (Blueprint $table) {
            $table->dropForeign('articles_comments_article_id_foreign');
        });

        Schema::dropIfExists('articles_comments');

        Schema::table('articles_likes', function (Blueprint $table) {
            $table->dropForeign('articles_likes_article_id_foreign');
        });

        Schema::dropIfExists('articles_likes');

        Schema::table('articles_tags', function (Blueprint $table) {
            $table->dropForeign('articles_tags_article_id_foreign');
        });

        Schema::dropIfExists('articles_tags');

        Schema::table('articles_views', function (Blueprint $table) {
            $table->dropForeign('articles_views_article_id_foreign');
        });

        Schema::dropIfExists('articles_views');

        Schema::dropIfExists('articles');
    }
}
