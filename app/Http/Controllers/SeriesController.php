<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Serie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SeriesController extends Controller
{
    public function index(Request $request)
    {
        $series = Serie::query()->orderBy('nome')->get();
        $mensagemRecebida = $request->session()->get('mensagem.sucesso');
        $serieAdicionada = $request->session()->get('mensagem.adicionada');
        return view("series.index", [
            'series' => $series,
            'mensagemSucesso' => $mensagemRecebida,
            'serieAdicionada' => $serieAdicionada
        ]);
    }

    public function create()
    {
        return view('series.create');
    }

    public function store(Request $request)
    {
        $serie = Serie::create($request->all());
        return to_route('series.index')
            ->with('mensagem.adicionada', "Série '{$serie->nome}' adicionada com sucesso!");
    }

    public function destroy(Serie $series)
    {
        $series->delete();
        return to_route('series.index')
            ->with('mensagem.sucesso', "Serie '{$series->nome}' removida com sucesso!");
    }

    public function edit(Serie $series)
    {
        return view('series.update', ["serie" => $series]);
    }

    public function update(Serie $series, Request $request)
    {
        Serie::updateName($series, $request->all());
        return to_route('series.index')
            ->with('mensagem.sucesso', "Serie '{$series->nome}' editada com sucesso!");
    }

}
