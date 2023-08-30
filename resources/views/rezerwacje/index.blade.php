@extends('layouts.app')

@section('content')

<!--wybieranie daty rezerwacji-->
<div class="container text-center" style="margin-top: 100px;">

<form action="{{ route('rezerwacje.wybor.daty') }}" method="post">
    @csrf
    <fieldset>
        <legend>@lang('public.Wybierz datę rezerwacji')</legend>
        <label for="od">@lang('public.Dnia'):</label><br>
        <input type="datetime-local" id="od" name="od"><br>
        <label for="czas">@lang('public.Na czas'):</label><br>
        <select id="czas"  name="czas">
            <option value="5400">1:30</option>
            <option value="7200">2:00</option>
            <option value="9000">2:30</option>
            <option value="10800">3:00</option>
        </select><br>
        <label for="id_stolu">@lang('public.Wybierz stolik'):</label><br>
        <select id="id_stolu" name="id_stolu">
            @foreach($stoliki as $stolik)
                <option value='{{$stolik->id}}'>Stolik {{$stolik->id}} - {{$stolik->nazwa}} - {{$stolik->umiejscowienie}}</option>
            @endforeach
        </select><br>
        <label for="nazwisko">@lang('public.Na nazwisko'):</label><br>
        <input type="text" id="nazwisko" name="nazwisko"><br>
        <br><br>
        <input type="submit" class="btn przycisk_style" value="@lang('public.Zarezerwuj')">
    </fieldset>





</form>
@if(isset($wiadomosc))
    <div class="alert alert-success">
        {{ $wiadomosc }}
    </div>
@endif
@if(isset($wiadomosc1))
    <div class="alert alert-danger">
        {{ $wiadomosc1 }}
    </div>
@endif
</div>
@endsection
