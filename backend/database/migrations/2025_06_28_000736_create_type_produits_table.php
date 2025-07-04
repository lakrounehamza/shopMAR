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
        Schema::create('type_produits', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('produit_id')->unsigned();
            $table->foreign('produit_id')->references('id')->on('produits')->onDelete('cascade');
            $table->string('type')->unique();
            $table->decimal('prix', 10, 2);
            $table->string('image')->nullable();
            $table->integer('quantiteStock')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('type_produits');
    }
};
