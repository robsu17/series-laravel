<x-layout title="Séries">
    @auth
        <a href="{{ route('series.create') }}" class="btn btn-dark mb-2">Adicionar</a>
    @endauth

    @isset($serieAdicionada)
        <div class="alert alert-success">
            {{ $serieAdicionada }}
        </div>
    @endisset

    @isset($serieRemovida)
        <div class="alert alert-success">
            {{ $serieRemovida }}
        </div>
    @endisset
    <ul class="list-group">
        @foreach ($series as $serie)
            <li class="list-group-item d-flex justify-content-between align-items-center">
                @auth<a href="{{ route('seasons.index', $serie->id) }}" class="icon-link-hover text-decoration-none">@endauth
                    {{ $serie->nome }}
                @auth</a>@endauth
                <div class="d-flex align-items-center justify-content-center gap-3 btn-sm">
                    @auth
                        <a href="{{ route('series.edit', $serie->id) }}" class="btn btn-primary btn-sm">Editar</a>
                    @endauth

                    @auth
                        <form action="{{ route('series.destroy', $serie->id) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm">
                                Excluir
                            </button>
                        </form>
                    @endauth
                </div>
            </li>
        @endforeach
    </ul>
</x-layout>
