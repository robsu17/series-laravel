<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use function PHPUnit\TestFixture\func;

class Series extends Model
{
    use HasFactory;
    protected $fillable = ['nome'];

    public static function create(array $serieName) {
        $serie = new Series();
        $serie->nome = $serieName["nome"];
        $serie->save();
        return $serie;
    }

    public static function updateName($series, array $newNameSerie) {
        $series->nome = $newNameSerie["nome"];
        $series->save();
        return $series;
    }

    public function seasons() {
        return $this->hasMany(Season::class, 'series_id');
    }

    protected static function booted()
    {
        self::addGlobalScope('ordered', function (Builder $queryBuilder) {
            $queryBuilder->orderBy('nome');
        });
    }
}
