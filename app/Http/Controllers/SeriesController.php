<?php

namespace App\Http\Controllers;

use App\Http\Requests\SeriesFormRequest;
use App\Models\Series;
use App\Repositories\SeriesRepository;
use Illuminate\Http\Request;

class SeriesController extends Controller
{
    public function __construct(private SeriesRepository $repository)
    {
    }

    public function index(Request $request)
    {
        $series = Series::all();
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

    public function store(SeriesFormRequest $request)
    {
        $serie = $this->repository->add($request->all());
        return to_route('series.index')
            ->with('mensagem.adicionada', "Série '{$serie->nome}' adicionada com sucesso!");
    }

    public function destroy(Series $series)
    {
        $series->delete();
        return to_route('series.index')
            ->with('mensagem.sucesso', "Series '{$series->nome}' removida com sucesso!");
    }

    public function edit(Series $series)
    {
        return view('series.update', ["serie" => $series]);
    }

    public function update(Series $series, SeriesFormRequest $request)
    {
        $series->fill($request->all());
        $series->save();
        return to_route('series.index')
            ->with('mensagem.sucesso', "Series '{$series->nome}' editada com sucesso!");
    }

}
