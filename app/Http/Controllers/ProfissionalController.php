<?php

namespace App\Http\Controllers;

use App\Models\Cargo;
use App\Models\FormacaoProfissional;
use Illuminate\Http\Request;

/**
 * Controller responsável pelas operações relacionadas aos profissionais.
 *
 * @package App\Http\Controllers
 */

class ProfissionalController extends Controller
{
    /**
     * Exibe o formulário de criação de um novo profissional.
     *
     * Este método recupera todos os cargos e formações profissionais disponíveis,
     * ordenados pelo nome, e os passa para a view `createProfissional`.
     *
     * @return \Illuminate\View\View
     */

    public function index()
    {
        $cargo = Cargo::orderBy('nome')->get();
        $formacao = FormacaoProfissional::orderBy('nome')->get();
        return view('admin.profissional.createProfissional', ['cargos' => $cargo, 'formacoes' => $formacao]);
    }

    /**
     * Armazena as informações de um novo profissional no banco de dados.
     *
     * Este método é responsável por lidar com os dados enviados pelo formulário
     * de criação de um profissional. No momento, ele apenas exibe os dados recebidos
     * para fins de depuração.
     *
     * @param \Illuminate\Http\Request $request Os dados do formulário enviados pelo usuário.
     *
     * @return void
     */
    public function store(Request $request)
    {
        
        $request->validate([
            'conselho' => 'required',
            'registro' => 'required',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            // Adicione outras validações necessárias
        ]);
        
        $data = $request->all();
        dd($data);
    
        // Verifica se a opção de excluir a foto foi marcada
        if ($request->has('deletar_foto') && $request->deletar_foto) {
            $data['thumbnail'] = 'img/logo/user-admin.jpg'; // Caminho da imagem padrão
        } else {
            if ($request->hasFile('thumbnail')) {
                $file = $request->file('thumbnail');
                $path = $file->store('thumbnails', 'public');
                $data['thumbnail'] = $path;
            }
        }

        $profissional->save();

        return redirect()->route('profissional.index')->with('success', 'Profissional cadastrado com sucesso!');
    
    }

    /**
     * Lista todos os funcionários.
     *
     * Este método deve ser implementado para retornar uma lista de todos os funcionários
     * cadastrados no sistema.
     *
     * @return \Illuminate\Http\Response
     */
    public function listarFuncionarios()
    {
        //
    }

    public function editarFuncionario()
    {
        //
    }

    public function excluirFuncionario()
    {
        //
    }
}
