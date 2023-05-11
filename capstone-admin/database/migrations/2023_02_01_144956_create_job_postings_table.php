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
        Schema::create('job_postings', function (Blueprint $table) {
            $table->id();
            $table->longText("logo");
            $table->longText("author");
            $table->longText("company_name");
            $table->longText("email");
            $table->string("job_title");
            $table->string("job_location");
            $table->longText("job_description");
            $table->string("job_schedule");
            $table->string("job_salary");
            $table->timestamps();
        });
        DB::statement('ALTER TABLE job_postings ADD FULLTEXT fulltext_index (job_title, job_description)');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('job_postings');
    }
};
