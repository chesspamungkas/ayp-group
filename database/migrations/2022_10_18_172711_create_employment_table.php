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
        Schema::create('employment', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('workerEmail');
            $table->string('companyName');
            $table->string('jobTitle');
            $table->date('startDate');
            $table->date('endDate')->nullable();
            $table->timestamps();
            // $table->unsignedBigInteger('workerEmploymentId');
            $table->foreign('workerEmail')->references('email')->on('worker')->onDelete('cascade');
            // $table->foreign('workerEmploymentId')->references('id')->on('worker')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employment');
    }
};
