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

    public function edit(Request $request)
    {
        $serie = Serie::find($request->route('id'));
        return view('series.update', ["serie" => $serie]);
    }

    public function editar(Request $request)
    {
        $serie = Serie::find($request->route('id'));
        $serie->nome = $request->get('nome');
        $serie->save();
        return to_route('series.index')
            ->with('mensagem.sucesso', "Serie '{$serie->nome}' editada com sucesso!");
    }

}
