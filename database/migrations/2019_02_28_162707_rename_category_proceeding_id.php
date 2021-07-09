<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RenameCategoryProceedingId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('proceedings', function (Blueprint $table) {
            $table->renameColumn('category_proceeding_id', 'category_article_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('proceedings', function (Blueprint $table) {
            $table->renameColumn('category_article_id', 'category_proceeding_id');
        });
    }
}
