<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DeleteColumnFromAbstractions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('abstractions', function (Blueprint $table) {
            $table->dropColumn('email');
            $table->dropColumn('title');
            $table->dropColumn('description');
            $table->dropColumn('keyword');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('abstractions', function (Blueprint $table) {
            $table->string('email')->after('id');
            $table->string('title');
            $table->text('description');
            $table->string('keyword');
        });
    }
}
