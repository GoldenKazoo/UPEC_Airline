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
        Schema::create('vols', function (Blueprint $table) {
            $table->id();
            $table->string('numero_vol')->unique();
            $table->foreignId('aeroport_depart_id')->constrained('aeroports');
            $table->foreignId('aeroport_arrivee_id')->constrained('aeroports');
            $table->date('date_depart');
            $table->time('heure_depart');
            $table->date('date_arrivee');
            $table->time('heure_arrivee');
            $table->integer('places_disponibles');
            $table->decimal('prix', 8, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vols');
    }
};
