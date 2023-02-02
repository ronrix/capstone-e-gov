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
        Schema::create('tourism', function (Blueprint $table) {
            $table->id();
            $table->text("tourist_name");
            $table->text("tourist_type");
            $table->longText("tourist_description");
            $table->json("tourist_img_links");
            $table->text("location");
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
        Schema::dropIfExists('tourism');
    }
};
