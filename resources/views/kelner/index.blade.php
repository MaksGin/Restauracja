@extends('layouts.app')
@extends('layouts.prac_nav')
@section('content')
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">

</head>

<center><h1>Panel Kelnera</h1>
<div id="main">
    <div class="container">
            <h1>Gotowe Potrawy</h1>
        <table class="table table-striped table-warning" style="margin-top:20px;">
                <thead>
                    <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Potrawy</th>
                    <th scope="col">Stolik</th>
                    <th scope="col">Cena</th>
                    <th scope="col">Działania</th>
                    </tr>
                </thead>
                <tbody id="gotowe_potrawy">

                </tbody>
        </table>
    </div>
</div>
@endsection
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    function doRefresh() {
        fetch('/get-ready-potrawy')
        .then(response => response.json())
        .then(data => {
            data = JSON.parse(data); //parsowanie do formatu JSON
            gotowe_potrawy.innerHTML = '';

            data.forEach(oczekujace => {

                //tworze zawartosc tabeli
                const tr = document.createElement("tr");

                const th = document.createElement("th");
                th.textContent = oczekujace.id;
                tr.appendChild(th);

                const tdPotrawy = document.createElement("td");
                const potrawyList = document.createElement("ul");

                oczekujace.potrawy.forEach(potrawa => {
                    const li = document.createElement("li");
                    li.textContent = potrawa;
                    potrawyList.appendChild(li);
                });

                tdPotrawy.appendChild(potrawyList);
                tr.appendChild(tdPotrawy);

                const tdStolik = document.createElement("td");
                tdStolik.textContent = oczekujace.id_stoliku;
                tr.appendChild(tdStolik);

                const tdCena = document.createElement("td");
                tdCena.textContent = oczekujace.cena + "zł";
                tr.appendChild(tdCena);

                const tdPrzycisk = document.createElement("td");
                const button = document.createElement("button");
                button.textContent = "Zrealizowane i opłacone";


                //nasłuch przycisku w tabeli
                button.addEventListener('click', function () {
                    var csrfToken = $('meta[name="csrf-token"]').attr('content');

                    // ajax do aktualizacji statusu zamowienia
                    $.ajax({
                        method: 'PUT',
                        url: '/update-order-status',
                        data: JSON.stringify({ orderId: oczekujace.id }),
                        contentType: 'application/json',
                        headers: {
                            'X-CSRF-TOKEN': csrfToken
                        }
                    })
                    .done(function (data) {
                        console.log(data);

                        tr.remove(); // Usunięcie wiersza, ponieważ zamówienie jest zrealizowane
                    })
                    .fail(function (error) {
                        console.error('Błąd aktualizacji statusu zamówienia');
                    });
                });


                tdPrzycisk.appendChild(button);
                tr.appendChild(tdPrzycisk);


                gotowe_potrawy.appendChild(tr);
            });
        })
        .catch(error => console.error('Error loading content:', error))
            .finally(() => {
                setTimeout(doRefresh, 2000);
            });
    }


    document.addEventListener('DOMContentLoaded', function () {
    var gotowe_potrawy = document.getElementById('gotowe_potrawy');


        doRefresh();

});


</script>