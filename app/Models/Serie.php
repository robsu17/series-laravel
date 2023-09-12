<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Serie extends Model
{
    use HasFactory;

    public static function create(array $serieName) {
        $serie = new Serie();
        $serie->nome = $serieName["nome"];
        $serie->save();
        return $serie;
    }

    public static function updateName($series, array $newNameSerie) {
        $series->nome = $newNameSerie["nome"];
        $series->save();
        return $series;
    }
}
