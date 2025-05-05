<?php

namespace App\Http\Controllers;

use App\Models\Avaliacao;


class AvaliacaoController extends Controller
{


    public function show(Avaliacao $avaliacao)
    {
        return view('avaliacoes.show', compact('avaliacao'));
    }
}
