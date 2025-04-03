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


    public function destroy(Request $request)
    {
        Auth::logout();

        //invalidamos e destruímos a sessão
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login.index');
    }


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
        return redirect()->route('register.index');
    }

    public function listarUser()
    {
        $users = User::all();
        return view('auth.listarUser', ['title' => 'Listar Usuários', 'users' => $users]);
    }

}
