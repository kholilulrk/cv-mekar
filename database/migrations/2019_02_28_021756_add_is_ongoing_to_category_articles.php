<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIsOngoingToCategoryArticles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('category_articles', function (Blueprint $table) {
            $table->integer('is_ongoing')->nullable()->default(0)->after('description');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('category_articles', function (Blueprint $table) {
            $table->dropColumn('is_ongoing');
        });
    }
}
