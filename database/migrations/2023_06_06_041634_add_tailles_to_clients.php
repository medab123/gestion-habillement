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
        Schema::table('clients', function (Blueprint $table) {
            $table->integer("taille_chausseur")->nullable();
            $table->integer("taille_pontallon")->nullable();
            $table->integer("taille_costume")->nullable();
            $table->integer("taille_chemise")->nullable();
            $table->integer("taille_tshurt")->nullable();
            $table->integer("taille_ceinture")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('clients', function (Blueprint $table) {
            //
        });
    }
};
