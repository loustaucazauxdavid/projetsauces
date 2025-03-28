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
        Schema::create('sauces', function (Blueprint $table) {
            $table->id();

            $table->string('userId'); // Identifiant unique de l'utilisateur
            $table->string('name'); // Nom de la sauce
            $table->string('manufacturer'); // Fabricant de la sauce
            $table->text('description'); // Description de la sauce
            $table->string('mainPepper'); // Principal ingrédient épicé de la sauce
            $table->string('imageUrl'); // URL de l'image de la sauce
            $table->unsignedTinyInteger('heat'); // Niveau d'épice de 1 à 10
            $table->integer('likes')->default(0); // Nombre de likes
            $table->integer('dislikes')->default(0); // Nombre de dislikes
            $table->json('usersLiked')->nullable(); // Tableau des utilisateurs qui ont liké
            $table->json('usersDisliked')->nullable(); // Tableau des utilisateurs qui ont disliké
            
            $table->timestamps(); // Champs de timestamps (created_at et updated_at)
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sauces');
    }
};
