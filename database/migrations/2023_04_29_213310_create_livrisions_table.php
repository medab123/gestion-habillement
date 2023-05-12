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
        Schema::create('livrisions', function (Blueprint $table) {
            $table->id();

            $table->date("date_livrison");
            $table->unsignedBigInteger("commande_id");
            $table->foreign('commande_id')->references('id')->on('commandes')->onDelete('cascade');
            $table->unsignedBigInteger("tailleur_id");
            $table->foreign('tailleur_id')->references('id')->on('tailleurs')->onDelete('cascade');
            // $table->unsignedBigInteger("vetement_id");
            // $table->foreign('vetement_id')->references('id')->on('vetements')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('livrisions');
    }
};
