<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTitleAuthorToAbstractions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('abstractions', function (Blueprint $table) {
            $table->string('title')->after('registration_number');
            $table->string('author')->after('registration_number');
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
            $table->dropColumn('title');
            $table->dropColumn('author');
        });
    }
}
