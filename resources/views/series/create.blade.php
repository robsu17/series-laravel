<x-layout title="Nova Série">
    <form action="{{ route('series.store') }}" method="post">
        @csrf


        <div class="row mb-3">
            <div class="col-8">
                <label class="form-label" for="nome">Nome:</label>
                <input
                    class="form-control"
                    type="text" name="nome"
                    id="nome" value="{{ old('nome') }}"
                    autocomplete="off"
                    autofocus
                >
            </div>
            <div class="col-2">
                <label class="form-label" for="seasonsQty">Nº de Temporadas:</label>
                <input
                    class="form-control"
                    type="text" name="seasonsQty"
                    id="seasonsQty" value="{{ old('seasonsQty') }}"
                    autocomplete="off"
                >
            </div>
            <div class="col-2">
                <label class="form-label" for="episodesPerSeason">Episodios por temporada:</label>
                <input
                    class="form-control"
                    type="text" name="episodesPerSeason"
                    id="episodesPerSeason" value="{{ old('episodesPerSeason') }}"
                    autocomplete="off"
                >
            </div>
        </div>
        <button class="btn btn-primary" type="submit">Adicionar</button>
        <a class="btn btn-dark" href="/series">Voltar</a>
    </form>
</x-layout>
