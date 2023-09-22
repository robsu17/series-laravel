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
                        @if($episode->watched) checked @endif
                    />
                </li>
            @endforeach
        </ul>
        <button class="btn btn-primary mt-2 mb-2">Salvar</button>
        <a class="btn btn-dark" href="{{ route('series.index') }}">Voltar</a>
    </form>
</x-layout>
