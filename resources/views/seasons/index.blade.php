<x-layout title="Temporadas">
    <ul class="list-group">
        @foreach ($seasons as $season)
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <a class="icon-link-hover text-decoration-none" href="{{ route('episodes.index', $season->id) }}">
                    Temporada {{ $season->number }}
                </a>
                <span class="badge bg-secondary">
                    {{ $season->episodes->count() }}
                </span>
            </li>
        @endforeach
    </ul>
    <a href="{{ route('series.index') }}" class="btn btn-primary mt-2 mb-2">Voltar</a>
</x-layout>
