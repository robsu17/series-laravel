<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Episode;
use App\Models\Season;
use App\Models\Series;
use Dflydev\DotAccessData\Data;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use function PHPUnit\TestFixture\func;


class EpisodesController extends Controller
{
    public function index(Season $season, Request $request)
    {
        $episodiosMarcados = $request->session()->get('mensagem.marcados');
        return view('episodes.index', [
            'episodes' => $season->episodes,
            'mensagemMarcados' => $episodiosMarcados,
            'id' => $season->id
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
}
