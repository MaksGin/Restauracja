@extends('layouts.app')
@extends('layouts.prac_nav')
@section('content')


<div class="container">
    <h1>Lista rezerwacji</h1>


        <div class="row">
            <div class="col text-right">
                <a class="m-3 btn btn-dark m-3 text-white" >Przeszłe rezerwacje stolików </a>
            </div>
            <div class="col text-center">
                <a class="m-3 btn btn-dark m-3 text-white" href="{{ route('ListaRezerwacji')}}}" id="todayReservations">Rezerwacje stolików na dzisiaj</a>


            </div>
            <div class="col text-left">
                <a class="m-3 btn btn-dark m-3 text-white" >Przyszłe rezerwacje stolików </a>
            </div>
          </div>
</div>
<div class="container">
    <table class="table table-striped">
        <thead style="background-color: ">
            <tr>
            <th scope="col">#</th>
            <th scope="col">id_stołu</th>
            <th scope="col">Godzina rozpoczęcia</th>
            <th scope="col">Godzina zakończenia</th>
            <th scope="col">Nazwisko</th>
            </tr>
        </thead>
        <tbody>
            @foreach($lista_rezerwacji as $rezerwacja)
                <tr>
                <th scope="row">{{$rezerwacja->id}}</th>
                <th scope="row">{{$rezerwacja->id_stoly}}</th>
                <td>{{$rezerwacja->od}}</td>
                <td>{{$rezerwacja->do}}</td>
                <td>{{$rezerwacja->nazwisko}}</td>
                </tr>
            @endforeach

        </tbody>
    </table>
</div>
<div id="reservationTable" class="mt-5">
    <!-- Tutaj zostanie wstawiona tabela z rezerwacjami -->
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        $('#todayReservations').click(function () {
            $.ajax({
                url: '/listaRezerwacji', // To jest poprawna ścieżka do Twojego kontrolera
                type: 'GET',
                dataType: 'json',
                success: function (data) {
                    var tableHtml = '<table><thead><tr><th>ID</th><th>Od</th><th>Do</th><th>Nazwisko</th></tr></thead><tbody>';

                    // Tworzenie wierszy tabeli na podstawie danych zwróconych z serwera
                    for (var i = 0; i < data.length; i++) {
                        tableHtml += '<tr><td>' + data[i].id + '</td><td>' + data[i].od + '</td><td>' + data[i].do + '</td><td>' + data[i].nazwisko + '</td></tr>';
                    }

                    tableHtml += '</tbody></table>';

                    $('#reservationTable').html(tableHtml);
                },
                error: function (xhr, status, error) {
                    console.log(error); // Wyświetl błąd w konsoli
                }
            });
        });
    });
</script>


@endsection
