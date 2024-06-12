<?php

namespace Database\Seeders;

use App\Models\Profissional;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProfissionalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Profissional::create([
            'nome' => 'Jonathan Teixeira',
            'sexo' => 'Masculino',
            'dataNascimento' => '1980-01-01',
            'cpf' => '123.456.789-00',
            'status' => 'Ativo',
            'formacao_id' => 1, // Supondo que a formação com ID 1 existe
            'cargo_id' => 1, // Supondo que o cargo de Administrador tem ID 2
            'conselho' => 'CRM',
            'registro' => '123456',
            'thumbnail' => 'logo/user-admin.jpg',
            'rqe' => '123456',
        ]);
    }
}
