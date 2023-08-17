@extends('layouts.app')
@extends('layouts.prac_nav')
@section('content')


<div class="container">
    <h1>Lista rezerwacji</h1>


        <div class="row">
            <div class="col text-right">
                <a class="m-3 btn btn-dark m-3 text-white" id="pobierz-przeszle-rezerwacje" >Przeszłe rezerwacje stolików </a>
            </div>
            <div class="col">
                <a class="m-3 btn btn-dark m-3 text-white" id="pobierz-rezerwacje">Rezerwacje stolików na dzisiaj</a>


            </div>
            <div class="col text-left">
                <a class="m-3 btn btn-dark m-3 text-white" id="pobierz-przyszle-rezerwacje" >Przyszłe rezerwacje stolików </a>
            </div>
          </div>
</div>
<div class="container">
<table class="table">
    <thead>
    <tr>
        <th>ID</th>
        <th>Data i Godzina rozpoczęcia</th>
        <th>Data i Godzina zakończenia</th>
        <th>Nazwisko</th>
    </tr>
    </thead>
    <tbody id="wyniki"></tbody>
</table>
</div>

<script>
    document.getElementById('pobierz-rezerwacje').addEventListener('click', function () {
        // Wywołanie żądania AJAX do pobrania rezerwacji
        fetch('{{ route("getRezerwacjeToday") }}')
            .then(response => response.json())
            .then(data => {
                document.getElementById('wyniki').innerHTML = '';
                data.forEach(reservation => {
                    var row = document.createElement('tr');
                    row.innerHTML =
                        `<td> ${data[0].id} </td>
                         <td> ${data[0].od} </td>
                         <td> ${data[0].do} </td>
                         <td> ${data[0].nazwisko} </td>`;
                    document.getElementById('wyniki').appendChild(row);
                });
                console.log(data);
            })
            .catch(error => console.error(error));
    });
    document.getElementById('pobierz-przyszle-rezerwacje').addEventListener('click', function () {
        // Wywołanie żądania AJAX do pobrania rezerwacji
        fetch('{{ route("Rezerwacje7days") }}')
            .then(response => response.json())
            .then(data => {
                document.getElementById('wyniki').innerHTML = '';

                // Sparsowanie JSON
                data = JSON.parse(data);

                data.forEach(reservation => {
                    var row = document.createElement('tr');
                    row.innerHTML =
                        `<td> ${reservation.id} </td>
                     <td> ${reservation.od} </td>
                     <td> ${reservation.do} </td>
                     <td> ${reservation.nazwisko} </td>`;
                    document.getElementById('wyniki').appendChild(row);
                });
                console.log(data);
            })
            .catch(error => console.error(error));
    });
    document.getElementById('pobierz-przeszle-rezerwacje').addEventListener('click', function () {
        // Wywołanie żądania AJAX do pobrania rezerwacji
        fetch('{{ route("RezerwacjeDoTylu7Dni") }}')
            .then(response => response.json())
            .then(data => {
                document.getElementById('wyniki').innerHTML = '';

                // Sparsowanie JSON
                data = JSON.parse(data);

                data.forEach(reservation => {
                    var row = document.createElement('tr');
                    row.innerHTML =
                        `<td> ${reservation.id} </td>
                     <td> ${reservation.od} </td>
                     <td> ${reservation.do} </td>
                     <td> ${reservation.nazwisko} </td>`;
                    document.getElementById('wyniki').appendChild(row);
                });
                console.log(data);
            })
            .catch(error => console.error(error));
    });
</script>


@endsection
