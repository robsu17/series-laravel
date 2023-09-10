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
        $nomeSerie = $request->input('nome');
        $serie = new Serie();
        $serie->nome = $nomeSerie;
        $serie->save();

        $request->session()->flash('mensagem.adicionada', 'Série adicionada com sucesso!');

        return to_route('series.index');
    }

    public function destroy(Request $request) {
        Serie::destroy($request->series);
        $request->session()->flash('mensagem.sucesso', 'Serie removida com sucesso!');
        return to_route('series.index');
    }
}
