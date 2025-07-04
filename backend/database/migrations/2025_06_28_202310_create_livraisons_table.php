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
        Schema::create('livraisons', function (Blueprint $table) {
             $table->id();
            $table->unsignedBigInteger('commande_id');
            $table->unsignedBigInteger('livreur_id');
            $table->dateTime('date_livraison')->nullable();
            $table->enum('statut', ['EN_COURS', 'LIVREE', 'ANNULEE'])->default('EN_COURS');
            $table->timestamps();
            $table->foreign('commande_id')->references('id')->on('commandes')->onDelete('cascade');
            $table->foreign('livreur_id')->references('id')->on('livreurs')->onDelete('cascade');
       
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('livraisons');
    }
};
