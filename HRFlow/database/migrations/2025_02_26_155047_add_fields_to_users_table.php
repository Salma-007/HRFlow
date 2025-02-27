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
        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('grade_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('contract_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('department_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('post_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('role_id')->nullable()->constrained()->onDelete('set null');
            
            $table->decimal('salary', 10, 2)->nullable();
            $table->date('birthdate')->nullable();
            $table->string('address')->nullable();
            $table->date('hire_date')->nullable();
            $table->string('phone')->nullable();
            $table->enum('status', ['active', 'inactive'])->default('active');
        });
    }
    
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('grade_id');
            $table->dropColumn('contract_id');
            $table->dropColumn('department_id');
            $table->dropColumn('post_id');
            $table->dropColumn('role_id');
            $table->dropColumn('salary');
            $table->dropColumn('birthdate');
            $table->dropColumn('address');
            $table->dropColumn('hire_date');
            $table->dropColumn('phone');
            $table->dropColumn('status');
        });
    }
    
};
