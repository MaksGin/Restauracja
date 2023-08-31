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
    <center><h1>@lang('public.Panel Bar')</h1></center>
    <h1>@lang('public.Do wydania')</h1>
<table class="table table-striped" style="margin-top:20px;">
        <thead>
            <tr>
            <th scope="col">Id</th>
            <th scope="col">@lang('public.Potrawy')</th>
            <th scope="col">@lang('public.Stolik')</th>
            <th scope="col">@lang('public.Działania')</th>

            </tr>
        </thead>
        <tbody id="waiting_napoje">

        </tbody>
</table>
</div>

@endsection

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>

    function doRefresh() {

        const translatedTableNames = @json($translatedStoliki);
        const translatedPotrawy = @json($translatedPotrawy);

        var gotowe_potrawy = document.getElementById('waiting_napoje');
            fetch('/get-waiting-napoje-bar')
        .then(response => response.json())
        .then(data => {
            data = JSON.parse(data); //parsowanie do formatu JSON
            gotowe_potrawy.innerHTML = ''; //czyszczenie po kazdym refreshu

            data.forEach(oczekujace => {

                //tworze zawartosc tabeli
                const tr = document.createElement("tr");

                const th = document.createElement("th");
                th.textContent = oczekujace.id;
                tr.appendChild(th);

                const tdPotrawy = document.createElement("td");
                const potrawyList = document.createElement("ul");
                const zawieraPotrawy = oczekujace.potrawy.length > 0;

                if (!zawieraPotrawy) {

                    //jesli nie ma napojow w zamowieniu po prostu tego zamowienia nie pokazuj w panelu baru
                    tr.style.display = "none";
                } else {

                    //jesli w zamowieniu istnieja potrawy to je wyswietl
                    oczekujace.potrawy.forEach(potrawa => {
                        const li = document.createElement("li");
                        li.textContent = translatedPotrawy[potrawa];
                        potrawyList.appendChild(li);
                    });
                }


                tdPotrawy.appendChild(potrawyList);
                tr.appendChild(tdPotrawy);

                const tdStolik = document.createElement("td");
                tdStolik.textContent = translatedTableNames[oczekujace.nazwa]+' '+translatedTableNames[oczekujace.umiejscowienie];
                tr.appendChild(tdStolik);

                const tdPrzycisk = document.createElement("td");
                const button = document.createElement("button");
                button.textContent = "@lang('public.Gotowe')";
                //style bootstrapa
                button.classList.add('Btn');
                button.classList.add('btn-dark');
                button.addEventListener("click", function(){

                    //jesli jest tylko zamowienie na bar dodac przycisk ktory czysci to zamowienie
                    var csrfToken = $('meta[name="csrf-token"]').attr('content');

                    // ajax do aktualizacji statusu zamowienia
                    $.ajax({
                        method: 'PUT',
                        url: '/update-order-bar',
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
        }).catch(error => console.error('Error loading content:', error))
                .finally(() => {
                setTimeout(doRefresh, 3000); //odświeżanie panelu do wydania co 3 sek
            });


    }

    document.addEventListener('DOMContentLoaded', function () {

    doRefresh();




});






</script>
