<?php

namespace App\Http\Controllers;

use App\Http\Middleware\Autenticador;
use App\Http\Requests\SeriesFormRequest;
use App\Models\Series;
use App\Repositories\SeriesRepository;
use Illuminate\Http\Request;
use App\Events\SeriesCreated as SeriesCreatedEvent;
use Illuminate\Support\Facades\Storage;
use Psy\Util\Str;

class SeriesController extends Controller
{
    public function __construct(private SeriesRepository $repository)
    {
        $this->middleware(Autenticador::class)->except('index');
    }

    public function index(Request $request)
    {
        $series = Series::all();
        $serieRemovida = session('mensagem.removida');
        $serieAdicionada = session('mensagem.adicionada');

        return view("series.index", [
            'series' => $series,
            'serieRemovida' => $serieRemovida,
            'serieAdicionada' => $serieAdicionada,
        ]);
    }

    public function create()
    {
        return view('series.create');
    }

    public function store(SeriesFormRequest $request)
    {
        $coverAuthResultDefault = "series_cover/GOrLCmAM20udhGuCWK1ulsGgsDIAwKhBpJNGDHoC.png";
        $coverAuthResult = $request->hasFile('cover')
            ? $request->file('cover')->store('series_cover', 'public')
            : $coverAuthResultDefault;

        $serie = $this->repository->add([
            'nome' => $request->nome,
            'cover' => $coverAuthResult,
            'seasonsQty' => $request->seasonsQty,
            'episodesPerSeason' => $request->episodesPerSeason
        ]);

        SeriesCreatedEvent::dispatch(
            $serie->nome,
            $serie->id,
            $request->seasonsQty,
            $request->episodesPerSeason
        );

        return to_route('series.index')
            ->with('mensagem.adicionada', "Série '{$serie->nome}' adicionada com sucesso!");
    }

    public function destroy(Series $series)
    {
        $series->delete();
        return to_route('series.index')
            ->with('mensagem.removida', "Series '{$series->nome}' removida com sucesso!");
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
