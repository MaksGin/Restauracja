@extends('layouts.app')
@extends('layouts.prac_nav')
@section('content')
<style>


</style>



<center>
    <a href="{{ route('Panelzamowienia')}}">
        <button type="submit" class="btn btn-dark" style="margin-top: 20px;">Dodaj zamówienie</button>
    </a>
</center>
<div class="container" style="margin-top: 50px;">
    <table class="table table-hover">
        <thead>
            <tr >
              <th scope="col">#</th>
              <th scope="col">Kelner</th>
              <th scope="col">Stolik</th>
              <th scope="col">Status</th>
              <th scope="col">Cena</th>
            </tr>
          </thead>
          <tbody>
            @foreach($zamowienia as $zamowienie)
            <tr onclick="window.location='{{ route('details', $zamowienie['id']) }}'">
                <td>{{$zamowienie->id}}</td>
                <td>{{$zamowienie->id_kelnera}}</td> <!-- wyswietlic imie kelnera , nazwe stolika z relacji -->
                <td>{{$zamowienie->id_stoliku}}</td>
                <td>{{$zamowienie->status->status}}</td>
                <td>{{$zamowienie->cena}} zł</td>
            </tr>
            @endforeach
          </tbody>
    </table>
</div>

@endsection
