<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPolymorphToCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('comments', function (Blueprint $table) {
            $table->dropForeign(['blog_post_id']);
            $table->dropColumn(['blog_post_id']);

            $table->morphs('comment_for');
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
            $table->dropMorphs('comment_for');

            $table->unsignedBigInteger('blog_post_id')->index();
            $table->foreign('blog_post_id')->references('id')->on('blog_posts');
        });
    }
}