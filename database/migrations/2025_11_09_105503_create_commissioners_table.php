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
        Schema::create('commissioners', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('position'); // Jabatan, e.g., "Ketua"
            $table->string('photo_path'); // Path ke foto
            $table->text('bio')->nullable();
            $table->integer('order')->default(0); // Untuk mengurutkan
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('commissioners');
    }
};
