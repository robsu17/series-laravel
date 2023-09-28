<?php

namespace App\Repositories;

use App\Models\Episode;
use App\Models\Series;

interface SeriesRepository
{
    public function add(array $dataArray): Series;
    public function updateEpisodesMarked(array $episodesMarked, array $episodesAll);
}
