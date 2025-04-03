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
        Schema::create('pacientes', function (Blueprint $table) {
            $table->id();
            $table->string('thumbnail')->nullable(); // Imagem opcional
            $table->string('nome');
            $table->enum('sexo', ['Masculino', 'Feminino', 'Outro'])->nullable();
            $table->date('data_nascimento');
            $table->string('cpf', 11)->unique();
            $table->string('rg')->nullable();
            $table->date('data_gestacao');
            $table->string('nome_mae')->nullable();
            $table->string('nome_pai')->nullable();
            $table->string('cns')->nullable(); // Cartão Nacional de Saúde
            $table->string('codigo_prontuario')->unique(); // Será gerado automaticamente
            // Endereço
            $table->string('cep')->nullable(); // Buscará endereço automaticamente
            $table->string('uf')->nullable();
            $table->string('cidade')->nullable();
            $table->string('bairro')->nullable();
            $table->string('logradouro')->nullable();
            $table->string('numero')->nullable();
            $table->string('complemento')->nullable();
            // Contato
            $table->string('email')->nullable();
            $table->string('celular')->nullable();
            $table->string('celular2')->nullable();
            $table->string('telefone_fixo')->nullable();
            // Observações
            $table->text('observacoes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pacientes');
    }
};
