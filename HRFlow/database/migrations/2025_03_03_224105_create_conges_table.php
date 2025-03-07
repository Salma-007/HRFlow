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
        Schema::create('conges', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->date('date_debut');
            $table->date('date_fin');
            $table->enum('status', ['pending', 'refused','accepted'])->default('pending');
            $table->boolean('manager_approval')->nullable()->default(null);
            $table->boolean('rh_approval')->nullable()->default(null);
            $table->enum('type_conge', ['annuel', 'maternite', 'parental', 'maladie'])->default('annuel');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('conges');
    }
};
