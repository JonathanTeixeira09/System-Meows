<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Paciente;

class ParturientesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       return view('admin.atendimentos.formAnamnese');
    }

    public function indexAtendimento()
    {
        $paciente = Paciente::orderBy('nome')->get();
        return view(('admin.atendimentos.formIniciarAtendimento'), ['pacientes' => $paciente]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validação dos dados do formulário
        $validated = $request->validate([
            'nomeDaPaciente' => 'required|string|max:255',
            'fc' => 'required',
            'fr' => 'required',
            'PA' => 'required',
            'PAD' => 'required',
            'Temp' => 'required',
            'SO' => 'required',
            'obs' => 'nullable|string|max:10000',
        ], [
            // Mensagens de erro personalizadas
            'nomeDaPaciente.required' => 'O nome da parturiente é obrigatório.',
            'fc.required' => 'Selecione uma opção para a frequência cardíaca.',
            'fr.required' => 'Selecione uma opção para a frequência respiratória.',
            'PA.required' => 'Selecione uma opção para a pressão arterial sistólica.',
            'PAD.required' => 'Selecione uma opção para a pressão arterial diastólica.',
            'Temp.required' => 'Selecione uma opção para a temperatura.',
            'SO.required' => 'Selecione uma opção para a saturação de oxigênio.',
        ]);

        // dd($request);

        // Recebe os dados do formulário
        $fc = $request->input('fc');
        $fr = $request->input('fr');
        $pas = $request->input('PA');
        $pad = $request->input('PAD');
        $temp = $request->input('Temp');
        // $avpu = $request->input('condicaoNeurologica');
        $so = $request->input('SO');
        // $diurese = $request->input('diurese');

        $scores = [
            'fc' => 0,
            'fr' => 0,
            'pas' => 0,
            'pad' => 0,
            'temp' => 0,
            // 'condicaoNeurologica' => 0,
            'so' => 0,
            // 'diurese' => 0,
        ];

        
        // Inicializa a pontuação total
        $pontuacaoTotal = 0;

        // Calcula a pontuação total
        // Frequência Cardíaca
        if ($fc == 1){
            $scores['fc'] = 3;
            $fc = '< 50';
        } elseif ($fc == 2){
            $scores['fc'] = 1;
            $fc = '50 - 59';
        } elseif ($fc == 3){
            $scores['fc'] = 0;
            $fc = '60 - 99';
        } elseif ($fc == 4){
            $scores['fc'] = 1;
            $fc = '100 - 109';
        } elseif ($fc == 5){
            $scores['fc'] = 2;
            $fc = '110 - 129';
        } elseif ($fc == 6){
            $scores['fc'] = 3;
            $fc = '> 130';
        }
        
        // Frequência Respiratória
        if ($fr == 1){
            $scores['fr'] = 3;
            $fr = '<= 12';
        } elseif ($fr == 2){
            $scores['fr'] = 2;
            $fr = '13 - 15';
        } elseif ($fr == 3){
            $scores['fr'] = 0;
            $fr = '16 - 20';
        } elseif ($fr == 4){
            $scores['fr'] = 1;
            $fr = '21 - 24';
        } elseif ($fr == 5){
            $scores['fr'] = 2;
            $fr = '25 - 30';
        } elseif ($fr == 6){
            $scores['fr'] = 3;
            $fr = '>= 31';
        }

        // Pressão Arterial Sistólica
        if ($pas == 1){
            $scores['pas'] = 3;
            $pas = '< 70';
        } elseif ($pas == 2){
            $scores['pas'] = 2;
            $pas = '70 - 89';
        } elseif ($pas == 3){
            $scores['pas'] = 0;
            $pas = '90 - 139';
        } elseif ($pas == 4){
            $scores['pas'] = 1;
            $pas = '140 - 149';
        } elseif ($pas == 5){
            $scores['pas'] = 2;
            $pas = '150 - 159';
        } elseif ($pas == 6){
            $scores['pas'] = 3;
            $pas = '>= 160';
        } 

        // Pressão Arterial Diastólica
        if ($pad == 1){
            $scores['pad'] = 2;
            $pad = '< 45';
        } elseif ($pad == 2){
            $scores['pad'] = 0;
            $pad = '45 - 89';
        } elseif ($pad == 3){
            $scores['pad'] = 1;
            $pad = '90 - 99';
        } elseif ($pad == 4){
            $scores['pad'] = 2;
            $pad = '100 - 109';
        } elseif ($pad == 5){
            $scores['pad'] = 3;
            $pad = '>= 110';
        }

        // Temperatura
        if ($temp == 1){
            $scores['temp'] = 2;
            $temp = '< 35';
        } elseif ($temp == 2){
            $scores['temp'] = 0;
            $temp = '35 - 37.4';
        } elseif ($temp == 3){
            $scores['temp'] = 1;
            $temp = '37.5 - 37.9';
        } elseif ($temp == 4){
            $scores['temp'] = 2;
            $temp = '38 - 38.9';
        } elseif ($temp == 5){
            $scores['temp'] = 3;
            $temp = '>= 39.0';
        }

        // Saturação de Oxigênio
        if ($so == 1){
            $scores['so'] = 3;
            $so = '< 92';
        } elseif ($so == 2){
            $scores['so'] = 2;
            $so = '92 - 95';
        } elseif ($so == 3){
            $scores['so'] = 0;
            $so = '>= 96';
        } 
        
        $scoresTotal = $scores['fc'] + $scores['fr'] + $scores['pas'] + $scores['pad'] + $scores['temp'] + $scores['so'];
               
        if ($scoresTotal == 0){
            $avaliacao = 'Não há risco de deterioração';
        } elseif ($scoresTotal >= 1 && $scoresTotal <= 3){
            $avaliacao = 'Baixo risco de deterioração';
        } elseif ($scoresTotal >= 4 && $scoresTotal <= 5){
            $avaliacao = 'Risco moderado de deterioração';
        } elseif ($scoresTotal >= 6){
            $avaliacao = 'Risco alto de deterioração';
        }

        dd($avaliacao, $scoresTotal);
        
        return redirect()->route('incluirAnamenese.index')->with('success', 'Anamnese cadastrada com sucesso!');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
