<?php

namespace App\Http\Controllers;

use App\Models\Episode;
use App\Models\Season;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EpisodesController extends Controller
{
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
        DB::transaction(function () use ($request, $season) {
            $episodesMarked = [];
            foreach ($request->episodes as $watchedEpisodes) {
                $episodesMarked[] = [
                    'id' => $watchedEpisodes,
                    'number' => $season->episodes()->find($watchedEpisodes)->number,
                    'watched' => true,
                    'season_id' => $season->id
                ];
            }

            Episode::upsert($episodesMarked, ['id'], ['watched']);
        });

        return to_route('episodes.index', $season->id)->with('mensagem.marcados', 'Episodios marcados como assistidos');
    }

    public function selectAll(Request $request) {
        return to_route('episodes.index', $request->route()->id)
            ->with('condition', true);
    }
}
