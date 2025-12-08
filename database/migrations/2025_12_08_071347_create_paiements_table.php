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
        Schema::create('paiements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('contenu_id')->constrained('contenus', 'id_contenu')->onDelete('cascade');
            $table->decimal('montant', 8, 2);
            $table->string('reference_paiement')->unique()->comment("Référence unique de la transaction du fournisseur de paiement");
            $table->string('statut_paiement')->default('en_attente')->comment("Ex: en_attente, reussi, echec");
            $table->timestamps();

            // Assurer qu'un utilisateur ne peut payer qu'une seule fois pour le même contenu
            $table->unique(['user_id', 'contenu_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('paiements');
    }
};
