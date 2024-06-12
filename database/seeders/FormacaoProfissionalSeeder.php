<?php

namespace Database\Seeders;

use App\Models\FormacaoProfissional;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FormacaoProfissionalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $profissionals = [
            'Administrador',
            'Acompanhante Terapêutica',
            'Assistente Social',
            'Bio Médico',
            'Enfermeiro',
            'Fisioterapeuta',
            'Fonoaudiólogo',
            'Médico',
            'Nutricionista',
            'Pedagogo',
            'Psicologo',
            'Psicomotricista',
            'Psicopedagogo',
            'Téc. Enfermagem',
            'Téc. Radiologia',
            'Terapeuta Ocupacional',
        ];

        foreach ($profissionals as $profissional) {
            FormacaoProfissional::create(['nome' => $profissional]);
        }
    }
}
