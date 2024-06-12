<?php

namespace Database\Seeders;

use App\Models\Cargo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CargoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cargos = [
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

        foreach ($cargos as $cargo) {
            Cargo::create(['nome' => $cargo]);
        }
    }
}
