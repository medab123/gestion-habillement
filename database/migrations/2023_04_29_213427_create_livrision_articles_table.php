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
        Schema::create('livrision_articles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("livrision_id");
            $table->unsignedBigInteger("vetement_id");
            $table->unsignedBigInteger("couleur_id");
            $table->integer("taille");
            $table->integer("qte");
            $table->foreign('livrision_id')->references('id')->on('livrisions')->onDelete('cascade');
            $table->foreign('vetement_id')->references('id')->on('vetements')->onDelete('cascade');
            $table->foreign('couleur_id')->references('id')->on('couleurs')->onDelete('cascade');


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('livrision_articles');
    }
};
