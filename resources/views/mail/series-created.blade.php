@component('mail::message')
   # {{ $nomeSerie }} criada

    A série {{ $nomeSerie }} com {{ $qtdTemporadas }} temporadas e {{ $episodiosPorTemporada }} episódios foi criada

    Acesse aqui:
   @component('mail::button', ['url' => "http://127.0.0.1:8000/series/{$idSerie}/seasons"])
       Ver série
   @endcomponent
@endcomponent

