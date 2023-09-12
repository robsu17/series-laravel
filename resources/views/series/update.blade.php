<x-layout title="Editar">
    <form action="{{ route('series.editar', $serie->id) }}" method="post">
        @csrf
        <div class="mb-3">
            <label class="form-label" for="nome">Nome:</label>
            <input class="form-control" type="text" name="nome" id="nome" autocomplete="off" required value="{{ $serie->nome }}">
        </div>
        <button class="btn btn-primary" type="submit">Editar</button>
        <a class="btn btn-dark" href="/series">Voltar</a>
    </form>
</x-layout>
