<?php

namespace App\Http\Controllers;

use App\Models\Episode;
use App\Models\Season;
use App\Repositories\EloquentSeriesRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EpisodesController extends Controller
{
    public function __construct(private EloquentSeriesRepository $repository)
    {
    }

    public function index(Season $season, Request $request)
    {
        $episodiosMarcados = $request->session()->get('mensagem.marcados');
        return view('episodes.index', [
            'id' => $season->id,
            'episodes' => $season->episodes,
            'mensagemMarcados' => $episodiosMarcados,
            'condition' => $request->session()->get('condition')
        ]);
    }

    public function update(Request $request, Season $season) {
        $arrayEpisodes = [];
        foreach ($season->episodes()->get() as $episodes) {
            $arrayEpisodes[] = [
                'id' => $episodes->id,
                'number' => $episodes->number,
                'watched' => $episodes->watched,
                'season_id' => $season->id
            ];
        }

        $this->repository->updateEpisodesMarked($request->episodes, $arrayEpisodes);

        return to_route('episodes.index', $season->id)->with('mensagem.marcados', 'Episodios atualizados');
    }

    public function selectAll(Request $request) {
        return to_route('episodes.index', $request->route()->id)
            ->with('condition', true);
    }
}
