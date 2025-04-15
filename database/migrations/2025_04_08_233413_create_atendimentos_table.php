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
        Schema::create('atendimentos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('paciente_id')->constrained('pacientes')->onDelete('restrict');
            $table->date('data_entrada')->default(now()->toDateString()); // Data atual como padrão
            $table->date('data_alta')->nullable(); // Pode ser nulo se ainda não teve alta
            $table->time('hora_entrada')->default(now()->toTimeString()); // Hora atual como padrão
            $table->time('hora_saida')->nullable(); // Pode ser nulo se ainda não saiu
            $table->foreignId('entrada_user_id')->constrained('users')->onDelete('restrict'); // Usuário que iniciou
            $table->foreignId('alta_user_id')->nullable()->constrained('users')->onDelete('restrict'); // Usuário que finalizou (pode ser nulo)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('atendimentos');
    }
};
