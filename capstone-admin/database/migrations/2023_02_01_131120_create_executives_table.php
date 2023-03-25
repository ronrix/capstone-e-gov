<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('executives', function (Blueprint $table) {
            $table->id();
            $table->string("executive_name");
            $table->string("position");
            $table->string("img_link")->nullable();
            $table->timestamp("start_term");
            $table->timestamp("end_term");
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
        Schema::dropIfExists('executives');
    }
};
