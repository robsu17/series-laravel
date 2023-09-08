<x-layout title="Nova Série">
    <form action="/series/salvar" method="post">
        @csrf
        <div class="mb-3">
            <label class="form-label" for="nome">Nome:</label>
            <input class="form-control" type="text" name="nome" id="nome" autocomplete="off" required>
        </div>
        <button class="btn btn-primary" type="submit">Adicionar</button>
        <a class="btn btn-dark" href="/series">Voltar</a>
    </form>
</x-layout>
