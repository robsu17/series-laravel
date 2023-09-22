<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Episode;
use App\Models\Season;
use App\Models\Series;
use Illuminate\Http\Request;


class EpisodesController extends Controller
{
    public function index(Season $season, Request $request)
    {
        $episodiosMarcados = $request->session()->get('mensagem.marcados');
        return view('episodes.index', [
            'episodes' => $season->episodes,
            'mensagemMarcados' => $episodiosMarcados
        ]);
    }

    public function update(Request $request, Season $season) {
        $watchedEpisoes = $request->episodes;
        $season->episodes->each(function (Episode $episode) use ($watchedEpisoes) {
            $episode->watched = in_array($episode->id, $watchedEpisoes);
        });

        $season->push();

        return to_route('episodes.index', $season->id)->with('mensagem.marcados', 'Episodios marcados como assistidos');
    }
}
