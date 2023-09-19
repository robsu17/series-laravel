<?php

namespace App\Repositories;

use App\Models\Episode;
use App\Models\Season;
use App\Models\Series;
use Illuminate\Support\Facades\DB;

class EloquentSeriesRepository implements SeriesRepository
{
    public function add(array $dataArray): Series {
        return DB::transaction(function () use ($dataArray) {
            $serie = Series::create($dataArray);
            $seasons = [];
            for ($i = 1; $i <= $dataArray["seasonsQty"]; $i++) {
                $seasons[] = [
                    'series_id' => $serie->id,
                    'number' => $i,
                ];
            }
            Season::insert($seasons);

            $episodes = [];
            foreach ($serie->seasons as $season) {
                for ($j = 1; $j <= $dataArray["episodesPerSeason"]; $j++) {
                    $episodes[] = [
                        'season_id' => $season->id,
                        'number' => $j,
                    ];
                }
            }
            Episode::insert($episodes);

            return $serie;
        });
    }
}
