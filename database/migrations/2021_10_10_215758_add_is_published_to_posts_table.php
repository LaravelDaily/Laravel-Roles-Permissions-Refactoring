<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIsPublishedToPostsTable extends Migration
{
    public function up()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->boolean('is_published')->default(false)->after('post_text');
        });
    }

    public function down()
    {
        Schema::table('posts', function (Blueprint $table) {
            //
        });
    }
}