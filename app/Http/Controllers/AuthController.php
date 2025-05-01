<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Profissional;

class AuthController extends Controller
{

    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        return view('auth.login', ['title' => 'Login']);
    }

    /**
     * Save the user in the database
     */
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ],[
            'email.required' => 'Esse campo de email é obrigatório',
            'email.email' => 'Esse campo tem que ter um email válido',
            'password.required' => 'Esse campo de password é obrigatório'
        ]);

        $credentials = $request->only('email', 'password');

        // Verifica se o usuário está ativo
        $user = User::where('email', $credentials['email'])->first();
        if ($user && $user->status !== 'Ativo') {
            return back()->withErrors([
                'errorLogin' => 'Usuário inativo. Entre em contato com o administrador.',
            ])->onlyInput('errorLogin');
        }

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // Armazena o caminho da thumbnail do usuário na sessão
            session([
                'user_thumbnail' => Auth::user()->profissional->thumbnail,
                'user_name' => Auth::user()->profissional->nome,
            ]);

            return redirect()->intended('/');
        }

        return back()->withErrors([
            'errorLogin' => 'As credenciais fornecidas não correspondem aos nossos registros.',
        ])->onlyInput('errorLogin');

    }

    /**
     * Logout the user
     */
    public function destroy(Request $request)
    {
        Auth::logout();

        //invalidamos e destruímos a sessão
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function createUser(Request $request)
    {
        // Busca profissionais que NÃO possuem usuário vinculado
        $profissional = Profissional::whereDoesntHave('user')->get();
        return view('auth.createUser', ['title' => 'Criar Usuário', 'profissional' => $profissional]);
    }

    /**
     * Store user in Users table
     */
    public function storeUser(Request $request)
    {
        // Validação dos dados do formulário
        $validated = $request->validate([
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed',
            'nome_profissional' => 'required',
            'permissao' => 'required|in:admin,profissional,superadmin'
        ], [
            'email.required' => 'Esse campo de email é obrigatório',
            'email.email' => 'Esse campo tem que ter um email válido',
            'email.unique' => 'Esse email já está cadastrado',
            'password.required' => 'Esse campo de password é obrigatório',
            'password.min' => 'A senha deve ter pelo menos 8 caracteres',
            'password.confirmed' => 'As senhas não conferem',
            'nome_profissional.required' => 'O nome do profissional é obrigatório',
            'permissao.required' => 'A permissão é obrigatória',
            'permissao.in' => 'A permissão deve ser admin, profissional ou superadmin'
        ]);

        // Criação do usuário
        $user = User::create([
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'profissionals_id' => $request->profissional_id,
            'role' => $request->permissao, // 'role' => $request->permissao,
            'status' => 'Ativo',
        ]);

        // Redireciona para a página de login com uma mensagem de sucesso
        flash('Usuário criado com sucesso!')->success();
        return redirect()->route('listarusuarios.index');
    }

    /**
     * Listando os Usuários
     *
     */
    public function listarUser()
    {
        $users = User::select('users.*')
            ->join('profissionals', 'users.profissionals_id', '=', 'profissionals.id')
            ->orderBy('profissionals.nome')
            ->paginate(10);
        return view('auth.listarUser', ['title' => 'Listar Usuários', 'users' => $users]);
    }

    /**
     * Exibe o formulário para edição do recurso especificado.
     */
    public function editUser(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $profissional = Profissional::whereDoesntHave('user')->get();
        return view('auth.editUser', ['title' => 'Editando Usuário', 'users' => $user, 'profissional' => $profissional]);
    }

    /**
     * Atualiza o recurso especificado no armazenamento.
     */
    public function updateUser(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
            'nome_profissional' => 'required',
            'permissao' => 'required|in:admin,profissional,superadmin'
        ], [
            'email.required' => 'Esse campo de email é obrigatório',
            'email.email' => 'Esse campo tem que ter um email válido',
            'email.unique' => 'Esse email já está cadastrado',
            'password.required' => 'Esse campo de password é obrigatório',
            'password.min' => 'A senha deve ter pelo menos 8 caracteres',
            'password.confirmed' => 'As senhas não conferem',
            'nome_profissional.required' => 'O nome do profissional é obrigatório',
            'permissao.required' => 'A permissão é obrigatória',
            'permissao.in' => 'A permissão deve ser admin, profissional ou superadmin'
        ]);
        $validated['status'] = 'Ativo';
        $validated['role'] = $request->permissao;

        // Verifica se o usuário está autenticado e se o ID do usuário autenticado é igual ao ID do usuário a ser atualizado
        if (Auth::check() && Auth::user()->id == $request->id) {
            // Se o usuário estiver autenticado e for o mesmo que está sendo editado, atualize a sessão
            session([
                'user_thumbnail' => Auth::user()->profissional->thumbnail,
                'user_name' => Auth::user()->profissional->nome,
            ]);
        }

        User::findOrFail($request->id)->update($validated);


        flash('Usuário alterado com sucesso')->success();
        return redirect()->route('listarusuarios.index');
    }

    /**
     * Desativa o usuário
     */
    public function disable(User $user)
    {
        // Verifica se o usuário alvo é o mesmo que está logado
        if (auth()->id() === $user->id) {
            flash('Você não pode desativar sua própria conta')->error();
            return redirect()->back();
        }

        try {
            $user->status = 'inativo';
            $saved = $user->save();

            if (!$saved) {
                flash('Falha ao desativar o usuário')->error();
                return redirect()->back();
            }

            flash('Usuário desativado com sucesso')->success();
            return redirect()->back();

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Erro: ' . $e->getMessage());
        }

    }

    /**
     * Funcão para ativar o usuário
     */
    public function enable(User $user)
    {
        // Verifica se o usuário alvo é o mesmo que está logado
        if (auth()->id() === $user->id) {
            flash('Você não pode ativar sua própria conta')->error();
            return redirect()->back();
        }

        try {
            $user->status = 'Ativo';
            $saved = $user->save();

            if (!$saved) {
                flash('Falha ao ativar o usuário')->error();
                return redirect()->back();
            }

            flash('Usuário ativado com sucesso')->success();
            return redirect()->back();

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Erro: ' . $e->getMessage());
        }
    }

    public function show(User $user)
    {
        return view('auth.showUser', ['user' => $user]);
    }
}
