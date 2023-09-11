<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Serie extends Model
{
    use HasFactory;

    public static function create(array $serieNome) {
        $serie = new Serie();
        $serie->nome = $serieNome["nome"];
        $serie->save();
        return $serie;
    }
}
