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
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->text("title");
            $table->longText("email");
            $table->longText("application_form");
            $table->longText("description");
            $table->string("service_department");
            $table->string("service_type");
            $table->json("service_requirements")->nullable()->default(null);
            $table->json("service_process")->nullable()->default(null);
            $table->softDeletes();
            $table->timestamps();
        });
        DB::statement('ALTER TABLE services ADD FULLTEXT fulltext_index (title, description)');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('services');
    }
};
