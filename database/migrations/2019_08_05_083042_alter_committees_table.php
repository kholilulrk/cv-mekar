<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterCommitteesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('committees', function (Blueprint $table) {
            $table->longText('description')->comment('  ')->change();
        });

        Schema::table('registrations', function (Blueprint $table) {
            $table->longText('description')->comment('  ')->change();
        });

        Schema::table('speakers', function (Blueprint $table) {
            $table->longText('description')->comment('  ')->change();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('committees', function (Blueprint $table) {
            $table->text('description')->comment(' ')->change();
        });

        Schema::table('registrations', function (Blueprint $table) {
            $table->text('description')->comment(' ')->change();
        });

        Schema::table('speakers', function (Blueprint $table) {
            $table->text('description')->comment(' ')->change();
        });
    }
}
