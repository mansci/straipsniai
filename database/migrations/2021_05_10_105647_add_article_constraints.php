<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddArticleConstraints extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('comments', function (Blueprint $table) {
            $table->dropForeign(['article_id']);
            $table->foreign('article_id')->references('id')->on('articles')->onDelete('cascade');
        });
        Schema::table('citations', function (Blueprint $table) {
            $table->dropForeign(['article_id']);
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
        Schema::table('comments', function (Blueprint $table) {
            $table->dropForeign(['article_id']);
            $table->foreign('article_id')->references('id')->on('articles');
        });
        Schema::table('citations', function (Blueprint $table) {
            $table->dropForeign(['article_id']);
            $table->foreign('article_id')->references('id')->on('articles');
        });
    }
}
