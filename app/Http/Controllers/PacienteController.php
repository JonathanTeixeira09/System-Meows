<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\Paciente;

class PacienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.paciente.createPaciente');
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

        $validated=$request->validate([
            'nome' => 'required|string|max:255',
            'data_nascimento' => 'required|date',
            'cpf' => 'required|string|size:11|unique:pacientes',
            'data_gestacao' => 'required|date',
        ],
        [
            'nome.required' => 'O nome da paciente é obrigatório.',
            'data_nascimento.required' => 'A data de nascimento da paciente é obrigatória.',
            'cpf.required' => 'O CPF da paciente é obrigatório.',
            'data_gestacao.required' => 'A data de gestação da paciente é obrigatória.',
        ]);

        // Verifica se a opção de excluir a foto foi marcada
        if ($request->has('deletar_foto') && $request->deletar_foto) {
            $thumbnail = 'pacientes/paciente.png'; // Caminho da imagem padrão
        } else {
            if ($request->hasFile('thumbnail')) {
                $file = $request->file('thumbnail');
                $path = $file->store('pacientes', 'public');
                $thumbnail = $path;
            } else {
                // Se não foi enviada nenhuma imagem, usa a imagem padrão
                $thumbnail = 'pacientes/paciente.png'; // Caminho da imagem padrão
            }
        }

        // Gera o número do prontuário automático
        $codigoProntuario = $this->gerarCodigoProntuario();

        // Cria o paciente com todos os dados
        $paciente = Paciente::create([
            'codigo_prontuario' => $codigoProntuario,
            'thumbnail' => $thumbnail,
            'nome' => $validated['nome'],
            'data_nascimento' => $validated['data_nascimento'],
            'cpf' => $validated['cpf'],
            'data_gestacao' => $validated['data_gestacao'],
            'nome_mae' => $request->nome_mae,
            'nome_pai' => $request->nome_pai,
            'rg' => $request->rg,
            'cns' => $request->cns,
            'cep' => $request->cep,
            'uf' => $request->uf,
            'cidade' => $request->cidade,
            'bairro' => $request->bairro,
            'logradouro' => $request->logradouro,
            'numero' => $request->numero,
            'complemento' => $request->complemento,
            'email' => $request->email,
            'celular' => $request->celular,
            'celular2' => $request->celular2,
            'telefone_fixo' => $request->telefone_fixo,
            'observacoes' => $request->observacoes,
            'sexo' => $request->sexo ?? 'Feminino'
        ]);

        flash('Paciente cadastrado com sucesso!')->success();
        return redirect()->route('iniciarAtendimento.index');

    }

    /**
     * Gera um código de prontuário único.
     */
    private function gerarCodigoProntuario()
    {
        $prefixo = 'PR-';
        $data = now()->format('Ymd');
        $sufixo = Str::upper(Str::random(3));

        // Verifica se já existe (improvável, mas garantindo)
        do {
            $codigo = $prefixo . $data . '-' . $sufixo;
            $sufixo = Str::upper(Str::random(3));
        } while (Paciente::where('codigo_prontuario', $codigo)->exists());

        return $codigo;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $paciente = Paciente::findOrFail($id);
        return view('admin.paciente.showPaciente', compact('paciente'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $paciente = Paciente::findOrFail($id);
        return view('admin.paciente.editPaciente', compact('paciente'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $paciente = Paciente::findOrFail($id);

        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'data_nascimento' => 'required|date',
            'cpf' => 'required|string|size:11',
            'data_gestacao' => 'required|date',
        ], [
                'nome.required' => 'O nome da paciente é obrigatório.',
                'data_nascimento.required' => 'A data de nascimento da paciente é obrigatória.',
                'cpf.required' => 'O CPF da paciente é obrigatório.',
                'data_gestacao.required' => 'A data de gestação da paciente é obrigatória.',
        ]);


        $codigoProntuario = $paciente->codigo_prontuario;

        // Processar foto
        if ($request->hasFile('thumbnail')) {
            // Remove a foto antiga se existir
            if ($paciente->thumbnail && $paciente->thumbnail !== 'pacientes/paciente.png') {
                Storage::disk('public')->delete($paciente->thumbnail);
            }
            $path = $request->file('thumbnail')->store('pacientes', 'public');
            $thumbnail = $path;
        } elseif ($request->has('deletar_foto') && $request->deletar_foto) {
            // Remove a foto antiga se existir
            if ($paciente->thumbnail && $paciente->thumbnail !== 'pacientes/paciente.png') {
                Storage::disk('public')->delete($paciente->thumbnail);
            }
            $thumbnail = 'pacientes/paciente.png';
        } else {
            // Mantém a foto existente
            $thumbnail = $paciente->thumbnail;
        }

        $paciente->update([
            'codigo_prontuario' => $codigoProntuario,
            'thumbnail' => $thumbnail,
            'nome' => $validated['nome'],
            'data_nascimento' => $validated['data_nascimento'],
            'cpf' => $validated['cpf'],
            'data_gestacao' => $validated['data_gestacao'],
            'nome_mae' => $request->nome_mae,
            'nome_pai' => $request->nome_pai,
            'rg' => $request->rg,
            'cns' => $request->cns,
            'cep' => $request->cep,
            'uf' => $request->uf,
            'cidade' => $request->cidade,
            'bairro' => $request->bairro,
            'logradouro' => $request->logradouro,
            'numero' => $request->numero,
            'complemento' => $request->complemento,
            'email' => $request->email,
            'celular' => $request->celular,
            'celular2' => $request->celular2,
            'telefone_fixo' => $request->telefone_fixo,
            'observacoes' => $request->observacoes,
            'sexo' => $request->sexo ?? 'Feminino'
        ]);

        flash('Paciente atualizado com sucesso!')->success();
        return redirect()->route('listarpaciente.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    /**
     * Busca o endereço de um CEP na API ViaCEP.
     */
    public function buscarCep($cep)
    {
        try {
            $cep = preg_replace('/[^0-9]/', '', $cep);

            if (strlen($cep) != 8) {
                return response()->json(['error' => 'CEP deve ter 8 dígitos'], 400);
            }

            $response = Http::timeout(3)->get("https://viacep.com.br/ws/{$cep}/json/");

            if ($response->successful()) {
                $data = $response->json();
                if (!isset($data['erro'])) {
                    return response()->json([
                        'uf' => $data['uf'] ?? '',
                        'cidade' => $data['localidade'] ?? '',
                        'bairro' => $data['bairro'] ?? '',
                        'logradouro' => $data['logradouro'] ?? '',
                        'found' => true
                    ]);
                }
            }

            return response()->json(['found' => false]);

        } catch (\Exception $e) {
            return response()->json(['found' => false]);
        }
    }

    public function listarPaciente()
    {
        $pacientes = Paciente::with(['ultimoAtendimento' => function($query) {
            $query->latest();
        }])
            ->orderBy('nome')
            ->paginate(5); // Altere o número conforme necessário

        return view('admin.paciente.listarPaciente', ['title' => 'Listando Pacientes', 'pacientes' => $pacientes]);
    }

}
