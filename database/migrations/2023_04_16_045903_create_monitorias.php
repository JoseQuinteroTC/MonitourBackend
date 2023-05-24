<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('monitorias', function (Blueprint $table) {

            $table->id();
            $table->string('monitor');//x
            $table->string('url_img_profile');//x
            $table->integer('idMonitor');//x
            $table->integer('views');//x
            $table->integer('request');//x
            $table->bigInteger('price');//x
            $table->string('course');//x
            $table->string('modality');//x
            $table->string('description');//x
            $table->timestamps();
        });


    }



    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('monitorias');
    }
};
