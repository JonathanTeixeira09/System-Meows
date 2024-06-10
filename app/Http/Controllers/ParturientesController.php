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
    public function index2()
    {
//       return view('admin.anamnese.formAnamnese', ['title' => 'Incluir Anamnese']);
        return view('admin.anamnese.formAnamnese2');
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
//        $validated = $request->validate([
//            'frequenciaCardiaca' => 'required|numeric',
//        ],[
//            'frequenciaCardiaca.required'  => 'Esse campo é obrigatório',
//        ]);
//
//        $fc = $request->input('frequenciaCardiaca');
//        $scoreFC = 0;
//        $status = 'green';
//        $message = 'Não existe Mensagem';
//
//        if ($fc >= 51 && $fc <= 100) {
//            $scoreFC = 0;
//            $status = 'green';
//            $message = 'REAVALIAR A CADA 6 HORAS';
//        } elseif (($fc >= 41 && $fc <= 50) || ($fc >= 101 && $fc <= 110)) {
//            $scoreFC = 1;
//            $status = 'yellow';
//            $message = 'REAVALIAR A CADA 6 HORAS E COMUNICAR AO ENFERMEIRO';
//        } elseif ($fc <= 40 || ($fc >= 111 && $fc <= 120)) {
//            $scoreFC = 2;
//            $status = 'orange';
//            $message = 'REAVALIAR A CADA 4 HORAS E COMUNICAR AO ENFERMEIRO';
//        } elseif ($fc > 120) {
//            $scoreFC = 3;
//            $status = 'red';
//            $message = 'REAVALIAR A CADA 2 HORAS E COMUNICAR AO ENFERMEIRO';
//        }
//
//        if ($request->ajax()) {
//            return response()->json(['status' => $status, 'message' => $message]);
//        }

        $validated = $request->validate([
            'frequenciaCardiaca' => 'required|numeric',
            'frequenciaRespiratoria' => 'required|numeric',
            'pressaoArterialSistolica' => 'required|numeric',
            'pressaoArterialDiastolica' => 'required|numeric',
            'temperatura' => 'required|numeric',
            'condicaoNeurologica' => 'required|string',
            'saturacaoOxigenio' => 'required|numeric',
            'diurese' => 'required|numeric',
        ], [
            'frequenciaCardiaca.required' => 'Esse campo é obrigatório',
            'frequenciaRespiratoria.required' => 'Esse campo é obrigatório',
            'pressaoArterialSistolica.required' => 'Esse campo é obrigatório',
            'pressaoArterialDiastolica.required' => 'Esse campo é obrigatório',
            'temperatura.required' => 'Esse campo é obrigatório',
            'condicaoNeurologica.required' => 'Esse campo é obrigatório',
            'saturacaoOxigenio.required' => 'Esse campo é obrigatório',
            'diurese.required' => 'Esse campo é obrigatório',
        ]);

        $fc = $request->input('frequenciaCardiaca');
        $fr = $request->input('frequenciaRespiratoria');
        $pas = $request->input('pressaoArterialSistolica');
        $pad = $request->input('pressaoArterialDiastolica');
        $temp = $request->input('temperatura');
        $avpu = $request->input('condicaoNeurologica');
        $spo2 = $request->input('saturacaoOxigenio');
        $diurese = $request->input('diurese');

        $scores = [
            'frequenciaCardiaca' => 0,
            'frequenciaRespiratoria' => 0,
            'pressaoArterialSistolica' => 0,
            'pressaoArterialDiastolica' => 0,
            'temperatura' => 0,
            'condicaoNeurologica' => 0,
            'saturacaoOxigenio' => 0,
            'diurese' => 0,
        ];

        $messages = [
            'frequenciaCardiaca' => 'Não existe Mensagem',
            'frequenciaRespiratoria' => 'Não existe Mensagem',
            'pressaoArterialSistolica' => 'Não existe Mensagem',
            'pressaoArterialDiastolica' => 'Não existe Mensagem',
            'temperatura' => 'Não existe Mensagem',
            'condicaoNeurologica' => 'Não existe Mensagem',
            'saturacaoOxigenio' => 'Não existe Mensagem',
            'diurese' => 'Não existe Mensagem',
        ];

        // Frequência Cardíaca
        if ($fc >= 51 && $fc <= 100) {
            $scores['frequenciaCardiaca'] = 0;
            $messages['frequenciaCardiaca'] = 'REAVALIAR A CADA 6 HORAS';
        } elseif (($fc >= 41 && $fc <= 50) || ($fc >= 101 && $fc <= 110)) {
            $scores['frequenciaCardiaca'] = 1;
            $messages['frequenciaCardiaca'] = 'REAVALIAR A CADA 6 HORAS E COMUNICAR AO ENFERMEIRO';
        } elseif ($fc <= 40 || ($fc >= 111 && $fc <= 120)) {
            $scores['frequenciaCardiaca'] = 2;
            $messages['frequenciaCardiaca'] = 'REAVALIAR A CADA 4 HORAS E COMUNICAR AO ENFERMEIRO';
        } elseif ($fc > 120) {
            $scores['frequenciaCardiaca'] = 3;
            $messages['frequenciaCardiaca'] = 'REAVALIAR A CADA 2 HORAS E COMUNICAR AO ENFERMEIRO';
        }

        // Frequência Respiratória
        if ($fr >= 11 && $fr <= 20) {
            $scores['frequenciaRespiratoria'] = 0;
            $messages['frequenciaRespiratoria'] = 'REAVALIAR A CADA 6 HORAS';
        } elseif (($fr >= 21 && $fr <= 24) || ($fr >= 9 && $fr <= 10)) {
            $scores['frequenciaRespiratoria'] = 1;
            $messages['frequenciaRespiratoria'] = 'REAVALIAR A CADA 6 HORAS E COMUNICAR AO ENFERMEIRO';
        } elseif (($fr >= 25 && $fr <= 29) || ($fr >= 5 && $fr <= 8)) {
            $scores['frequenciaRespiratoria'] = 2;
            $messages['frequenciaRespiratoria'] = 'REAVALIAR A CADA 4 HORAS E COMUNICAR AO ENFERMEIRO';
        } elseif ($fr >= 30 || $fr <= 4) {
            $scores['frequenciaRespiratoria'] = 3;
            $messages['frequenciaRespiratoria'] = 'REAVALIAR A CADA 2 HORAS E COMUNICAR AO ENFERMEIRO';
        }

        // Pressão Arterial Sistólica
        if ($pas >= 101 && $pas <= 150) {
            $scores['pressaoArterialSistolica'] = 0;
            $messages['pressaoArterialSistolica'] = 'REAVALIAR A CADA 6 HORAS';
        } elseif (($pas >= 151 && $pas <= 160) || ($pas >= 91 && $pas <= 100)) {
            $scores['pressaoArterialSistolica'] = 1;
            $messages['pressaoArterialSistolica'] = 'REAVALIAR A CADA 6 HORAS E COMUNICAR AO ENFERMEIRO';
        } elseif (($pas >= 161 && $pas <= 170) || ($pas >= 81 && $pas <= 90)) {
            $scores['pressaoArterialSistolica'] = 2;
            $messages['pressaoArterialSistolica'] = 'REAVALIAR A CADA 4 HORAS E COMUNICAR AO ENFERMEIRO';
        } elseif ($pas >= 171 || $pas <= 80) {
            $scores['pressaoArterialSistolica'] = 3;
            $messages['pressaoArterialSistolica'] = 'REAVALIAR A CADA 2 HORAS E COMUNICAR AO ENFERMEIRO';
        }

        // Pressão Arterial Diastólica
        if ($pad >= 51 && $pad <= 90) {
            $scores['pressaoArterialDiastolica'] = 0;
            $messages['pressaoArterialDiastolica'] = 'REAVALIAR A CADA 6 HORAS';
        } elseif (($pad >= 91 && $pad <= 100) || ($pad >= 41 && $pad <= 50)) {
            $scores['pressaoArterialDiastolica'] = 1;
            $messages['pressaoArterialDiastolica'] = 'REAVALIAR A CADA 6 HORAS E COMUNICAR AO ENFERMEIRO';
        } elseif (($pad >= 101 && $pad <= 110) || ($pad >= 31 && $pad <= 40)) {
            $scores['pressaoArterialDiastolica'] = 2;
            $messages['pressaoArterialDiastolica'] = 'REAVALIAR A CADA 4 HORAS E COMUNICAR AO ENFERMEIRO';
        } elseif ($pad >= 111 || $pad <= 30) {
            $scores['pressaoArterialDiastolica'] = 3;
            $messages['pressaoArterialDiastolica'] = 'REAVALIAR A CADA 2 HORAS E COMUNICAR AO ENFERMEIRO';
        }

        // Temperatura
        if ($temp >= 36.1 && $temp <= 37.9) {
            $scores['temperatura'] = 0;
            $messages['temperatura'] = 'REAVALIAR A CADA 6 HORAS';
        } elseif (($temp >= 35.1 && $temp <= 36.0) || ($temp >= 38.0 && $temp <= 38.4)) {
            $scores['temperatura'] = 1;
            $messages['temperatura'] = 'REAVALIAR A CADA 6 HORAS E COMUNICAR AO ENFERMEIRO';
        } elseif ($temp <= 35.0 || ($temp >= 38.5 && $temp <= 38.9)) {
            $scores['temperatura'] = 2;
            $messages['temperatura'] = 'REAVALIAR A CADA 4 HORAS E COMUNICAR AO ENFERMEIRO';
        } elseif ($temp >= 39.0) {
            $scores['temperatura'] = 3;
            $messages['temperatura'] = 'REAVALIAR A CADA 2 HORAS E COMUNICAR AO ENFERMEIRO';
        }

        // Condição Neurológica (AVPU)
        if ($avpu == 'A') {
            $scores['condicaoNeurologica'] = 0;
            $messages['condicaoNeurologica'] = 'REAVALIAR A CADA 6 HORAS';
        } elseif ($avpu == 'V') {
            $scores['condicaoNeurologica'] = 1;
            $messages['condicaoNeurologica'] = 'REAVALIAR A CADA 6 HORAS E COMUNICAR AO ENFERMEIRO';
        } elseif ($avpu == 'P') {
            $scores['condicaoNeurologica'] = 2;
            $messages['condicaoNeurologica'] = 'REAVALIAR A CADA 4 HORAS E COMUNICAR AO ENFERMEIRO';
        } elseif ($avpu == 'U') {
            $scores['condicaoNeurologica'] = 3;
            $messages['condicaoNeurologica'] = 'REAVALIAR A CADA 2 HORAS E COMUNICAR AO ENFERMEIRO';
        }

        // Saturação de Oxigênio
        if ($spo2 >= 96) {
            $scores['saturacaoOxigenio'] = 0;
            $messages['saturacaoOxigenio'] = 'REAVALIAR A CADA 6 HORAS';
        } elseif ($spo2 >= 94 && $spo2 <= 95) {
            $scores['saturacaoOxigenio'] = 1;
            $messages['saturacaoOxigenio'] = 'REAVALIAR A CADA 6 HORAS E COMUNICAR AO ENFERMEIRO';
        } elseif ($spo2 >= 92 && $spo2 <= 93) {
            $scores['saturacaoOxigenio'] = 2;
            $messages['saturacaoOxigenio'] = 'REAVALIAR A CADA 4 HORAS E COMUNICAR AO ENFERMEIRO';
        } elseif ($spo2 <= 91) {
            $scores['saturacaoOxigenio'] = 3;
            $messages['saturacaoOxigenio'] = 'REAVALIAR A CADA 2 HORAS E COMUNICAR AO ENFERMEIRO';
        }

        // Diurese
        if ($diurese >= 30) {
            $scores['diurese'] = 0;
            $messages['diurese'] = 'REAVALIAR A CADA 6 HORAS';
        } elseif ($diurese >= 21 && $diurese <= 29) {
            $scores['diurese'] = 1;
            $messages['diurese'] = 'REAVALIAR A CADA 6 HORAS E COMUNICAR AO ENFERMEIRO';
        } elseif ($diurese >= 11 && $diurese <= 20) {
            $scores['diurese'] = 2;
            $messages['diurese'] = 'REAVALIAR A CADA 4 HORAS E COMUNICAR AO ENFERMEIRO';
        } elseif ($diurese <= 10) {
            $scores['diurese'] = 3;
            $messages['diurese'] = 'REAVALIAR A CADA 2 HORAS E COMUNICAR AO ENFERMEIRO';
        }

        if ($request->ajax()) {
            return response()->json(['scores' => $scores, 'messages' => $messages]);
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
