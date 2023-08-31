@extends('layouts.app')
@extends('layouts.prac_nav')
@section('content')
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>

        .anuluj{
            margin-left: 20px;
        }

    </style>
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
    <center><h1>@lang('public.Panel Kuchnia')</h1></center>
    <h1>@lang('public.Oczekujace')</h1>
<table class="table table-striped table-warning" style="margin-top:20px;">
        <thead>
            <tr>
                <th scope="col">Id</th>
                <th scope="col">@lang('public.Potrawy')</th>
                <th scope="col">@lang('public.Stolik')</th>
                <th scope="col">@lang('public.Cena')</th>
                <th scope="col" colspan="2">@lang('public.Działania')</th>
            </tr>
        </thead>
        <tbody id="waiting_potrawy">

        </tbody>
</table>
</div>
<div class="container">
    <h1>@lang('public.W Trakcie')</h1>
<table class="table table-striped table-warning" style="margin-top:20px;">
        <thead>
            <tr>
            <th scope="col">Id</th>
            <th scope="col">@lang('public.Potrawy')</th>
            <th scope="col">@lang('public.Stolik')</th>
            <th scope="col">@lang('public.Cena')</th>
            <th scope="col">@lang('public.Działania')</th>
            </tr>
        </thead>
        <tbody id="potrawy-wtrakcie">

        </tbody>
</table>
</div>
@endsection
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>

    function doRefresh() {

        const translatedTableNames = @json($translatedStoliki);
        const translatedPotrawy = @json($translatedPotrawy);
        var potrawy_wTrakcie = document.getElementById('potrawy-wtrakcie');
        fetch('/get-potrawy-wtrakcie')
        .then(response => response.json())
        .then(data => {
            data = JSON.parse(data); //parsowanie do formatu JSON
            potrawy_wTrakcie.innerHTML = '';

            data.forEach(w_trakcie => {

                //tworze zawartosc tabeli
                const tr = document.createElement("tr");

                const th = document.createElement("th");
                th.textContent = w_trakcie.id;
                tr.appendChild(th);

                const tdPotrawy = document.createElement("td");
                const potrawyList = document.createElement("ul");

                w_trakcie.potrawy.forEach(potrawa => {
                    const li = document.createElement("li");
                    //przetłumaczone potrawy
                    li.textContent = translatedPotrawy[potrawa];
                    potrawyList.appendChild(li);
                });

                tdPotrawy.appendChild(potrawyList);
                tr.appendChild(tdPotrawy);

                const tdStolik = document.createElement("td");
                //sektor w trakcie stoliki
                tdStolik.textContent = '@lang('public.Stolik'): '+' '+translatedTableNames[w_trakcie.nazwa]+' '+translatedTableNames[w_trakcie.umiejscowienie];
                tr.appendChild(tdStolik);

                const tdCena = document.createElement("td");
                tdCena.textContent = w_trakcie.cena + "zł";
                tr.appendChild(tdCena);

                const tdPrzycisk = document.createElement("td");
                const button = document.createElement("button");
                button.textContent = "@lang('public.Gotowe')";

                //style bootstrapa
                button.classList.add('Btn');
                button.classList.add('btn-dark');

                button.addEventListener("click", function(){
                    var csrfToken = $('meta[name="csrf-token"]').attr('content');


                    $.ajax({
                        method: 'PUT',
                        url: '/set-status-gotowe',
                        data: JSON.stringify({ orderId: w_trakcie.id }),
                        contentType: 'application/json',
                        headers: {
                            'X-CSRF-TOKEN': csrfToken
                        }
                    })
                    .done(function (data) {
                        console.log(data);

                        tr.remove();
                    })
                    .fail(function (error) {
                        console.error('Błąd aktualizacji statusu zamówienia');
                    });
                });


                tdPrzycisk.appendChild(button);
                tr.appendChild(tdPrzycisk);



                potrawy_wTrakcie.appendChild(tr);
            });
        })

        var gotowe_potrawy = document.getElementById('waiting_potrawy');
            fetch('/get-waiting-potrawy')
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

                    tdPotrawy.textContent = "Brak potraw do zamówienia";
                    tr.style.backgroundColor = 'black'; // Zmień kolor wiersza na szary
                    tr.appendChild(tdPotrawy);
                    tr.style.display = 'none';
                } else {
                oczekujace.potrawy.forEach(potrawa => {
                    const li = document.createElement("li");
                    li.textContent = translatedPotrawy[potrawa];
                    potrawyList.appendChild(li);
                })
                }


                tdPotrawy.appendChild(potrawyList);
                tr.appendChild(tdPotrawy);

                const tdStolik = document.createElement("td");
                //sektor oczekujace stoliki
                tdStolik.textContent = '@lang('public.Stolik'): '+translatedTableNames[oczekujace.nazwa]+' '+translatedTableNames[oczekujace.umiejscowienie];
                tr.appendChild(tdStolik);

                const tdCena = document.createElement("td");
                tdCena.textContent = oczekujace.cena + "zł";
                tr.appendChild(tdCena);

                const tdPrzycisk = document.createElement("td");
                const button = document.createElement("button");
                button.textContent = "@lang('public.Przyjmij')";

                //style bootstrapa
                button.classList.add('Btn');
                button.classList.add('btn-dark');

                button.addEventListener("click", function(){
                    var csrfToken = $('meta[name="csrf-token"]').attr('content');


                    $.ajax({
                        method: 'PUT',
                        url: '/set-status-wTrakcie',
                        data: JSON.stringify({ orderId: oczekujace.id }),
                        contentType: 'application/json',
                        headers: {
                            'X-CSRF-TOKEN': csrfToken
                        }
                    })
                    .done(function (data) {
                        console.log(data);

                        tr.remove();
                    })
                    .fail(function (error) {
                        console.error('Błąd aktualizacji statusu zamówienia');
                    });
                });


                tdPrzycisk.appendChild(button);
                tr.appendChild(tdPrzycisk);

                const tdPrzyciskAnuluj = document.createElement("td");

                const anuluj = document.createElement("button");
                anuluj.classList.add("anuluj");
                anuluj.textContent = "@lang('public.Anuluj')";

                //style bootstrapa
                anuluj.classList.add('Btn');
                anuluj.classList.add('btn-dark');

                anuluj.addEventListener("click", function(){
                    var csrfToken = $('meta[name="csrf-token"]').attr('content');


                    $.ajax({
                        method: 'put',
                        url: '/kuchnia/zamowienia/cancel',
                        data: JSON.stringify({ orderId: oczekujace.id }),
                        contentType: 'application/json',
                        headers: {
                            'X-CSRF-TOKEN': csrfToken
                        }
                    })
                        .done(function (data) {
                            console.log(data);

                            tr.remove();
                        })
                        .fail(function (error) {
                            console.error('Błąd aktualizacji statusu zamówienia');
                        });
                });

                tdPrzyciskAnuluj.appendChild(anuluj);
                tr.appendChild(tdPrzyciskAnuluj);

                gotowe_potrawy.appendChild(tr);
            });
        }).catch(error => console.error('Error loading content:', error))
            .finally(() => {
                setTimeout(doRefresh, 3000);
            });
    }

    document.addEventListener('DOMContentLoaded', function () {



        doRefresh();


    });





</script>

