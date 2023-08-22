@extends('layouts.app')
@extends('layouts.prac_nav')
@section('content')
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">

</head>


@if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="container">
    <h1>Oczekujące</h1>
<table class="table table-striped table-light">
    <thead>
        <tr>
        <th scope="col">Id</th>
        <th scope="col">Potrawy</th>
        <th scope="col">Stolik</th>
        <th scope="col">Działania</th>
        </tr>
    </thead>
  <tbody>
@foreach ($oczekujace as $zamowienie)

<tr>
    <th>{{$zamowienie->id}}</th>
    <td>
       @foreach($zamowienie->potrawy as $potrawa)
        <li>{{$potrawa->nazwa}}</li>

       @endforeach
    </td>
    <td>{{$zamowienie->id_stoliku}}</td>
    <td>
        <form method="POST" action="{{ route('kuchnia.zamowienia.modify') }}">
            @csrf
            <input type="hidden" name="orderId" value="{{$zamowienie['id']}}">
            <button type="submit" class="btn btn-success btn-sm">
                <i class="fa fa-pencil-square-o" aria-hidden="true"></i> Przyjmij
            </button>
        </form>

        <form method="POST" action="{{ route('kuchnia.zamowienia.cancel') }}">
            @csrf
            @method('DELETE')
            <input type="hidden" name="orderId" value="{{$zamowienie['id']}}">
            <button type="submit" class="btn btn-danger btn-sm">
                <i class="fa fa-pencil-square-o" aria-hidden="true"></i> Anuluj
            </button>
        </form>
    </td>
</tr>

@endforeach

</tbody>
</table>
</div>
<div class="container">
    <h1>W trakcie</h1>
    <table class="table table-striped table-warning" style="margin-top:20px;">
        <thead>
            <tr>
            <th scope="col">Id</th>
            <th scope="col">Potrawy</th>
            <th scope="col">Stolik</th>
            <th scope="col">Działania</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($wTrakcie as $zamowienie)

            <tr>
                <th>{{$zamowienie->id}}</th>
                <td>
                   @foreach($zamowienie->potrawy as $potrawa)
                    <li>{{$potrawa->nazwa}}</li>

                   @endforeach
                </td>
                <td>{{$zamowienie->id_stoliku}}</td>
                <td>
                    <form method="POST" action="{{ route('kuchnia.zamowienia.ready') }}">
                        @csrf
                        <input type="hidden" name="orderId" value="{{$zamowienie['id']}}">
                        <button type="submit" class="btn btn-success btn-sm">
                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i> Gotowe
                        </button>
                    </form>

                    <form method="POST" action="{{ route('kuchnia.zamowienia.cancel') }}">
                        @csrf
                        @method('DELETE')
                        <input type="hidden" name="orderId" value="{{$zamowienie['id']}}">
                        <button type="submit" class="btn btn-danger btn-sm">
                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i> Anuluj
                        </button>
                    </form>
                </td>
            </tr>

            @endforeach
        </tbody>
    </table>

</div>

<div id="oczekujace-potrawy"></div>
@endsection
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
    var oczekujace_potrawy = document.getElementById('oczekujace-potrawy');

    fetch('/get-waiting-potrawy')
        .then(response => response.json())
        .then(data => {
            data = JSON.parse(data);
            data.forEach(oczekujace => {
                //wygenerować tabele lub inny sposob
                const div = document.createElement("div");
                div.setAttribute("zamowienie_id", oczekujace.id);
                div.classList.add("zamowienie");

                const text = document.createTextNode(oczekujace.id_stoliku);
                div.appendChild(text);

                oczekujace_potrawy.appendChild(div);


            });
        })
        .catch(error => console.error(error));
});

</script>

