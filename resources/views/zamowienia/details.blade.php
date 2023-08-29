@extends('layouts.app')
@extends('layouts.prac_nav')
@section('content')
<style>
    h3{
        margin-top: 30px;
    }

</style>
<center><h1>@lang('public.Szczegóły zamówienia')  {{$zamowienie->id}}</h1></center>
<div class="container">
    <div class="row">
      <div class="col">
        <h3>@lang('public.Stolik'):</h3> <br>
        <p>{{$zamowienie->stolik->nazwa}} <br>Piętro: {{$zamowienie->stolik->umiejscowienie}}</p>


        <h3>@lang('public.Zawartość zamówienia'):</h3>
        @foreach($potrawy_zamowienia as $potrawy)
        {{ trans('public.' .$potrawy->potrawy->nazwa)}}<br>
        @endforeach

        <h3>@lang('public.Wartość zamówienia')</h3>
        <p>{{$zamowienie->cena}} zł</p>
      </div>
      <div class="col">

      </div>
      <div class="col">

      </div>
    </div>
  </div>
@endsection
