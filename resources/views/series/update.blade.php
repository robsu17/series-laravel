<x-layout title="Editar">
    <form action="{{ route('series.update', $serie->id) }}" method="post">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label class="form-label" for="nome">Nome:</label>
            <input class="form-control" type="text" name="nome" id="nome" autocomplete="off" value="{{ $serie->nome }}">
        </div>
        <button class="btn btn-primary" type="submit">Editar</button>
        <a class="btn btn-dark" href="/series">Voltar</a>
    </form>
</x-layout>
