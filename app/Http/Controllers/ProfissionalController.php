<?php

namespace App\Http\Controllers;

use App\Models\Cargo;
use App\Models\FormacaoProfissional;
use App\Models\Profissional;
use Illuminate\Http\Request;
use LaravelLegends\PtBrValidator\Rules\Cpf;

/**
 * Controller responsável pelas operações relacionadas aos profissionais.
 *
 * @package App\Http\Controllers
 */

class ProfissionalController extends Controller
{
//    /**
//     * Exibe o formulário de criação de um novo profissional.
//     *
//     * Este método recupera todos os cargos e formações profissionais disponíveis,
//     * ordenados pelo nome, e os passa para a view `createProfissional`.
//     *
//     * @return \Illuminate\View\View
//     */
//
//    public function index()
//    {
//        $cargo = Cargo::orderBy('nome')->get();
//        $formacao = FormacaoProfissional::orderBy('nome')->get();
//        return view('admin.profissional.createProfissional', ['cargos' => $cargo, 'formacoes' => $formacao]);
//    }
//
//    /**
//     * Armazena as informações de um novo profissional no banco de dados.
//     *
//     * Este método é responsável por lidar com os dados enviados pelo formulário
//     * de criação de um profissional. No momento, ele apenas exibe os dados recebidos
//     * para fins de depuração.
//     *
//     * @param \Illuminate\Http\Request $request Os dados do formulário enviados pelo usuário.
//     *
//     * @return void
//     */
//    public function store(Request $request)
//    {
//        $request->validate([
//            'nome' => 'required',
//            'conselho' => 'required',
//            'registro' => 'required',
//            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
//            'cpf' => ['required', new Cpf],
//            'dataNascimento' => 'required',
//        ],[
//            'nome.required' => 'O campo nome é obrigatório',
//            'conselho.required' => 'O campo conselho é obrigatório',
//            'registro.required' => 'O campo registro é obrigatório',
//            'thumbnail.image' => 'O arquivo deve ser uma imagem',
//            'thumbnail.mimes' => 'O arquivo deve ser uma imagem do tipo: jpeg, png, jpg ou gif',
//            'thumbnail.max' => 'O arquivo deve ter no máximo 2MB',
//            'cpf.required' => 'O campo CPF é obrigatório',
//            'cpf.cpf' => 'CPF inválido',
//            'dataNascimento.required' => 'O campo data de nascimento é obrigatório',
//        ]);
//
//        // Verifica se a opção de excluir a foto foi marcada
//        if ($request->has('deletar_foto') && $request->deletar_foto) {
//            $data['thumbnail'] = 'profissionais/user-admin.jpg'; // Caminho da imagem padrão
//        } else {
//            if ($request->hasFile('thumbnail')) {
//                $file = $request->file('thumbnail');
//                $path = $file->store('profissionais', 'public');
//                $data['thumbnail'] = $path;
//            } else {
//                // Se não foi enviada nenhuma imagem, usa a imagem padrão
//                $data['thumbnail'] = 'profissionais/user-admin.jpg'; // Caminho da imagem padrão
//            }
//        }
//
//        $status = 'Ativo';
//
//        $data = [
//            'nome' => $request->input('nome'),
//            'sexo' => $request->input('sexo'),
//            'dataNascimento' => $request->input('dataNascimento'),
//            'cpf' => $request->input('cpf'),
//            'status' => $status,
//            'formacao_id' => $request->input('formacao_id'),
//            'cargo_id' => $request->input('cargo_id'),
//            'conselho' => $request->input('conselho'),
//            'registro' => $request->input('registro'),
//            'thumbnail' => $data['thumbnail'],
//            'rqe' => $request->input('rqe'),
//        ];
//
//        Profissional::create($data);
//        flash('Professional cadastrado com sucesso')->success();
//        return redirect()->route('listarprofissional.index');
//    }
//
//    /**
//     * Lista todos os funcionários.
//     *
//     * Este método deve ser implementado para retornar uma lista de todos os funcionários
//     * cadastrados no sistema.
//     *
//     * @return \Illuminate\Http\Response
//     */
//    public function listarProfissional()
//    {
//        $profissional = Profissional::orderBy('nome')->paginate(8);
//        return view('admin.profissional.listProfissional', ['profissionals' => $profissional]);
//    }
//
//    public function editarProfissional()
//    {
//        //
//    }
//
//    public function excluirProfissional()
//    {
//        //
//    }
//    public function buscarProfissional(Request $request)
    /**
     * Exibe o formulário de criação de profissional
     */
    public function index()
    {
        $cargos = Cargo::orderBy('nome')->get();
        $formacoes = FormacaoProfissional::orderBy('nome')->get();
        return view('admin.profissional.createProfissional', [
            'cargos' => $cargos,
            'formacoes' => $formacoes
        ]);
    }

    /**
     * Armazena um novo profissional no banco de dados
     */
    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required',
            'conselho' => 'required',
            'registro' => 'required',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'cpf' => ['required', new Cpf],
            'dataNascimento' => 'required',
            'sexo' => 'required',
            'cargo_id' => 'required',
        ],[
            'nome.required' => 'O campo nome é obrigatório',
            'conselho.required' => 'O campo conselho é obrigatório',
            'registro.required' => 'O campo registro é obrigatório',
            'thumbnail.image' => 'O arquivo deve ser uma imagem',
            'thumbnail.mimes' => 'O arquivo deve ser uma imagem do tipo: jpeg, png, jpg ou gif',
            'thumbnail.max' => 'O arquivo deve ter no máximo 2MB',
            'cpf.required' => 'O campo CPF é obrigatório',
            'cpf.cpf' => 'CPF inválido',
            'dataNascimento.required' => 'O campo data de nascimento é obrigatório',
            'sexo.required' => 'O campo sexo é obrigatório',
            'cargo_id.required' => 'O campo cargo é obrigatório',
        ]);

        // Tratamento da foto
        if ($request->has('deletar_foto') && $request->deletar_foto) {
            $thumbnail = 'profissionais/user-admin.jpg'; // Foto padrão
        } elseif ($request->hasFile('thumbnail')) {
            $path = $request->file('thumbnail')->store('profissionais', 'public');
            $thumbnail = $path;
        } elseif (!isset($data['thumbnail'])) {
            $thumbnail = 'profissionais/user-admin.jpg'; // Foto padrão se nenhuma for enviada
        }

        Profissional::create([
            'nome' => $request->nome,
            'sexo' => $request->sexo,
            'dataNascimento' => $request->dataNascimento,
            'cpf' => $request->cpf,
            'status' => 'Ativo',
            'formacao_id' => $request->formacao_id,
            'cargo_id' => $request->cargo_id,
            'conselho' => $request->conselho,
            'registro' => $request->registro,
            'thumbnail' => $thumbnail,
            'rqe' => $request->rqe,
        ]);

        flash('Profissional cadastrado com sucesso')->success();
        return redirect()->route('listarprofissional.index');
    }

    /**
     * Exibe o formulário de edição de profissional
     */
    public function edit($id)
    {
        $profissional = Profissional::findOrFail($id);
        $cargos = Cargo::orderBy('nome')->get();
        $formacoes = FormacaoProfissional::orderBy('nome')->get();

        return view('admin.profissional.createProfissional', [
            'profissional' => $profissional,
            'cargos' => $cargos,
            'formacoes' => $formacoes
        ]);
    }

    /**
     * Atualiza os dados de um profissional
     */
    public function update(Request $request, $id)
    {
        $profissional = Profissional::findOrFail($id);

        $request->validate([
            'nome' => 'required',
            'conselho' => 'required',
            'registro' => 'required',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'cpf' => ['required', new Cpf],
            'dataNascimento' => 'required',
            'sexo' => 'required',
            'cargo_id' => 'required',
        ],[
            'nome.required' => 'O campo nome é obrigatório',
            'conselho.required' => 'O campo conselho é obrigatório',
            'registro.required' => 'O campo registro é obrigatório',
            'thumbnail.image' => 'O arquivo deve ser uma imagem',
            'thumbnail.mimes' => 'O arquivo deve ser uma imagem do tipo: jpeg, png, jpg ou gif',
            'thumbnail.max' => 'O arquivo deve ter no máximo 2MB',
            'cpf.required' => 'O campo CPF é obrigatório',
            'cpf.cpf' => 'CPF inválido',
            'dataNascimento.required' => 'O campo data de nascimento é obrigatório',
            'sexo.required' => 'O campo sexo é obrigatório',
            'cargo_id.required' => 'O campo cargo é obrigatório',
        ]);

        // Tratamento da foto
        if ($request->has('deletar_foto') && $request->deletar_foto) {
            $data['thumbnail'] = 'profissionais/user-admin.jpg'; // Foto padrão
        } elseif ($request->hasFile('thumbnail')) {
            $path = $request->file('thumbnail')->store('profissionais', 'public');
            $data['thumbnail'] = $path;
        } elseif (!isset($data['thumbnail'])) {
            $data['thumbnail'] = 'profissionais/user-admin.jpg'; // Foto padrão se nenhuma for enviada
        }

        $profissional->update([
            'nome' => $request->nome,
            'sexo' => $request->sexo,
            'dataNascimento' => $request->dataNascimento,
            'cpf' => $request->cpf,
            'formacao_id' => $request->formacao_id,
            'cargo_id' => $request->cargo_id,
            'conselho' => $request->conselho,
            'registro' => $request->registro,
            'thumbnail' => $thumbnail,
            'rqe' => $request->rqe,
        ]);

        flash('Profissional atualizado com sucesso')->success();
        return redirect()->route('listarprofissional.index');
    }

    /**
     * Lista todos os profissionais ativos
     */
    public function listarProfissional()
    {
        $profissional = Profissional::where('status', 'Ativo')
            ->orderBy('nome')
            ->paginate(8);

        return view('admin.profissional.listProfissional', [
            'profissionals' => $profissional
        ]);
    }

    /**
     * Altera o status do profissional para Inativo
     */
    public function inativar($id)
    {
        $profissional = Profissional::findOrFail($id);
        $profissional->update(['status' => 'Inativo']);

        flash('Profissional inativado com sucesso')->success();
        return back();
    }

    /**
     * Altera o status do profissional para Ativo
     */
    public function ativar($id)
    {
        $profissional = Profissional::findOrFail($id);
        $profissional->update(['status' => 'Ativo']);

        flash('Profissional ativado com sucesso')->success();
        return back();
    }

    /**
     * Exibe profissionais inativos
     */
    public function listarInativos()
    {
        $profissionais = Profissional::where('status', 'Inativo')
            ->orderBy('nome')
            ->paginate(8);

        return view('admin.profissional.listProfissionalInativos', [
            'profissionais' => $profissionais
        ]);
    }


}
