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
        Schema::create('formulaire', function (Blueprint $table) {
            $table->id();
            $table->string('nom_formulaire');
            $table->datetime('created_at');
            $table->datetime('updated_at');
            $table->text('contenu_formulaire');
            $table->foreignId('id_liste_entreprise')->constrained(
                table: 'liste_entreprise', indexName: 'formulaire_entreprise_constraint'
            );
            
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
