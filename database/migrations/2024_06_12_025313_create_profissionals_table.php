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
        Schema::create('profissionals', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('nome');
            $table->string('sexo');
            $table->date('dataNascimento');
            $table->string('cpf', 14);
            $table->string('status', 50);
            $table->unsignedBigInteger('formacao_id');
            $table->foreign('formacao_id')->references('id')->on('formacao_profissionals')->restrictOnDelete();
            $table->unsignedBigInteger('cargo_id');
            $table->foreign('cargo_id')->references('id')->on('cargos')->restrictOnDelete();
            $table->string('conselho', 100)->nullable();
            $table->string('registro', 100)->nullable();
            $table->string('thumbnail')->nullable();
            $table->string('rqe', 100)->nullable();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profissionals');
    }
};
