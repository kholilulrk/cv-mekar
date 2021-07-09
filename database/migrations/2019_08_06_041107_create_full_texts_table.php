<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFullTextsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('full_texts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('abstraction_id');
            $table->longText('description')->nullable();
            $table->string('url');
            $table->string('status')->nullable(); // Approve / Refuse
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
        Schema::dropIfExists('full_texts');
    }
}
