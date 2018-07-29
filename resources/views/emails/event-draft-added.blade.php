@component('mail::message')
# Nowa propozycja wydarzenia

W systemie dodano nowe zgłoszenie wydarzenia:

@component('mail::table')
|                   |              |
|-------------------|--------------|
@foreach($eventDraft->format() as $key => $value)
| {{ trans($key) }} | {{ $value }} |
@endforeach
@endcomponent


@component('mail::button', ['url' => route('events.index')])
    Przejdź do listy zgłoszeń
@endcomponent

Pozdrawiamy,<br>
Zespół Rewitalizaci Miasta Leszna
@endcomponent