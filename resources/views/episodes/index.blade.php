<x-layout title="Episódios">
    @isset($mensagemMarcados)
        <div class="alert alert-success">
            {{ $mensagemMarcados }}
        </div>
    @endisset
    <form method="post">
        @csrf
        <ul class="list-group">
            @foreach ($episodes as $episode)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    Episódio {{ $episode->number }}
                    <input
                        type="checkbox"
                        name="episodes[]"
                        value="{{ $episode->id }}"
                        @if($episode->watched || $condition) checked @endif
                    />
                </li>
            @endforeach
        </ul>
        <div class="d-flex h-100 justify-content-between">
            <div class="d-flex gap-2">
                <button class="btn btn-primary mt-2 mb-2">Salvar</button>
                <a class="btn btn-dark mt-2 mb-2" href="{{ route('series.index') }}">Voltar</a>
            </div>
            <div>
                <a class="btn btn-dark mt-2 mb-2" href="{{ route('episodes.all', $id) }}">Selecionar todos</a>
            </div>
        </div>
    </form>
</x-layout>
