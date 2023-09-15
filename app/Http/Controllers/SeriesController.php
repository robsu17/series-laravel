<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\SeriesFormRequest;
use App\Models\Episode;
use App\Models\Season;
use App\Models\Series;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SeriesController extends Controller
{
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
        $serie = Series::create($request->all());
        for ($i = 1; $i <= $request->seasonsQty; $i++) {
            $seasons[] = [
              'series_id' => $serie->id,
              'number' => $i,
            ];
        }
        Season::insert($seasons);

        $episodes = [];
        foreach ($serie->seasons as $season) {
            for ($j = 1; $j <= $request->episodesPerSeason; $j++) {
                $episodes[] = [
                    'season_id' => $season->id,
                    'number' => $j,
                ];
            }
        }
        Episode::insert($episodes);
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
