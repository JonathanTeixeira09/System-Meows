<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Atendimento;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('evolucaos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('atendimento_id')->constrained('atendimentos')->onDelete('restrict');
            $table->string('fr')->nullable()->comment('Frequência Respiratória');
            $table->string('fc')->nullable()->comment('Frequência Cardíaca');
            $table->string('pas')->nullable()->comment('Pressão Arterial Sistólica');
            $table->string('pad')->nullable()->comment('Pressão Arterial Diastólica');
            $table->string('temp')->nullable()->comment('Temperatura');
            $table->string('so')->nullable()->comment('Saturação de Oxigênio');
            $table->string('obs')->nullable()->comment('Observações');
            $table->string('grauDeterioracao')->nullable()->comment('Grau de Deterioração');
            $table->foreignId('local_id')->constrained('locals')->onDelete('restrict');
            $table->foreignId('user_id')->constrained('users')->onDelete('restrict');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('evolucaos');
    }
};
