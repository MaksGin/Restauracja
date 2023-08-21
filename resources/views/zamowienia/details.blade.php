@extends('layouts.app')
@extends('layouts.prac_nav')
@section('content')
<style>
    h3{
        margin-top: 30px;
    }

</style>
<center><h1>Szczegóły zamówienia</h1></center>
<div class="container">
    <div class="row">
      <div class="col">
        <h3>Stolik:</h3> <br>
        <p>{{$zamowienie->stolik->nazwa}} <br>Piętro: {{$zamowienie->stolik->umiejscowienie}}</p>


        <h3>Zawartość zamówienia:</h3>
        @foreach($potrawy_zamowienia as $potrawy)
            {{$potrawy->potrawy->nazwa}}<br>
        @endforeach

        <h3>Wartość zamówienia</h3>
        <p>{{$zamowienie->cena}}zł</p>
      </div>
      <div class="col">

      </div>
      <div class="col">

      </div>
    </div>
  </div>
@endsection
