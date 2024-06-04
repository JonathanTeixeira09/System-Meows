<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ParturientesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
//       return view('admin.anamnese.formAnamnese', ['title' => 'Incluir Anamnese']);
       return view('admin.anamnese.formAnamnese');
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
        $validated = $request->validate([
            'frequenciaCardiaca' => 'required|numeric',
        ],[
            'frequenciaCardiaca.required'  => 'Esse campo é obrigatório',
        ]);

        $fc = $request->input('frequenciaCardiaca');
        $scoreFC = 0;
        $status = 'green';
        $message = 'Não existe Mensagem';

        if ($fc >= 51 && $fc <= 100) {
            $scoreFC = 0;
            $status = 'green';
            $message = 'REAVALIAR A CADA 6 HORAS';
        } elseif (($fc >= 41 && $fc <= 50) || ($fc >= 101 && $fc <= 110)) {
            $scoreFC = 1;
            $status = 'yellow';
            $message = 'REAVALIAR A CADA 6 HORAS E COMUNICAR AO ENFERMEIRO';
        } elseif ($fc <= 40 || ($fc >= 111 && $fc <= 120)) {
            $scoreFC = 2;
            $status = 'orange';
            $message = 'REAVALIAR A CADA 4 HORAS E COMUNICAR AO ENFERMEIRO';
        } elseif ($fc > 120) {
            $scoreFC = 3;
            $status = 'red';
            $message = 'REAVALIAR A CADA 2 HORAS E COMUNICAR AO ENFERMEIRO';
        }

        if ($request->ajax()) {
            return response()->json(['status' => $status, 'message' => $message]);
        }
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
