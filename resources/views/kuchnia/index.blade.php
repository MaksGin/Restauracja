@extends('layouts.app')
@extends('layouts.prac_nav')
@section('content')
<div class="container">
<table class="table">
    <thead>
        <tr>
        <th scope="col">Id</th>
        <th scope="col">Potrawy</th>
        <th scope="col">Stolik</th>
        <th scope="col">Działania</th>
        </tr>
    </thead>
  <tbody>
@foreach ($zamowienia as $zamowienie)

<tr>
    <th>{{$zamowienie->id}}</th>
    <td>
       @foreach($zamowienie->potrawy as $potrawa)
        <li>{{$potrawa->nazwa}}</li>

       @endforeach
    </td>
    <td>{{$zamowienie->id_stoliku}}</td>
    <td>
        <button class="btn btn-success btn-sm">
            <i class="fa fa-pencil-square-o" aria-hidden="true"></i> Gotowe
        </button>

        <button class="btn btn-danger btn-sm">
            <i class="fa fa-pencil-square-o" aria-hidden="true"></i> Anuluj
        </button>
    </td>
</tr>

@endforeach

</tbody>
</table>
</div>

@endsection
