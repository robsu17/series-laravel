<x-layout title="Séries">
    <a href="{{ route('series.create') }}" class="btn btn-dark mb-2">Adicionar</a>

    @isset($mensagemSucesso)
        <div class="alert alert-success">
            {{ $mensagemSucesso }}
        </div>
    @endisset
    @isset($serieAdicionada)
        <div class="alert alert-success">
            {{ $serieAdicionada }}
        </div>
    @endisset
    <ul class="list-group">
        @foreach ($series as $serie)
            <li class="list-group-item d-flex justify-content-between align-items-center">
                {{ $serie->nome }}
                <div class="d-flex align-items-center justify-content-center gap-3 btn-sm">
                    <a href="{{ route('series.edit', $serie->id) }}" class="btn btn-primary btn-sm">Editar</a>
                    <form action="{{ route('series.destroy', $serie->id) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm">
                            Excluir
                        </button>
                    </form>
                </div>
            </li>
        @endforeach
    </ul>
</x-layout>
