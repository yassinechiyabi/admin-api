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
        Schema::create('liste_element', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_entreprise')->constrained(
                table: 'entreprise', indexName: 'entreprise_constraint'
            );
            $table->foreignId('id_liste_entreprise')->constrained(
                table: 'liste_entreprise', indexName: 'liste_entreprise_constraint'
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
