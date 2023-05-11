<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tourisms', function (Blueprint $table) {
            $table->id();
            $table->text("title");
            $table->text("authors");
            $table->text("category");
            $table->longText("description");
            $table->longText("img_link");
            $table->text("location");
            $table->softDeletes();
            $table->timestamps();
        });
        DB::statement('ALTER TABLE tourisms ADD FULLTEXT fulltext_index (title, description)');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tourisms');
    }
};
