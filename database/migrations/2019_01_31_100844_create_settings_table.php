<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->nullable();
            $table->string('author')->nullable();
            $table->string('keyword')->nullable();
            $table->string('short_description')->nullable();
            $table->text('description')->nullable();
            $table->text('fb_pixel')->nullable();
            $table->text('google_analytic')->nullable();
            $table->string('icon')->nullable();
            $table->string('logo')->nullable();
            $table->string('logo_grayscale')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('settings');
    }
}
