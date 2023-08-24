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
    <center><h1>Panel Bar</h1></center>
    <h1>Do wydania</h1>
<table class="table table-striped table-warning" style="margin-top:20px;">
        <thead>
            <tr>
            <th scope="col">Id</th>
            <th scope="col">Potrawy</th>
            <th scope="col">Stolik</th>

            </tr>
        </thead>
        <tbody id="waiting_potrawy">

        </tbody>
</table>
</div>

@endsection
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>

    function doRefresh() {

        var gotowe_potrawy = document.getElementById('waiting_potrawy');
            fetch('/get-waiting-potrawy-bar')
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

                    tdPotrawy.textContent = "Brak napojów do zamówienia";
                    tr.style.backgroundColor = 'black'; // Zmień kolor wiersza na szary
                    tr.appendChild(tdPotrawy);
                } else {
                    oczekujace.potrawy.forEach(potrawa => {
                        const li = document.createElement("li");
                        li.textContent = potrawa;
                        potrawyList.appendChild(li);
                    });
                }


                tdPotrawy.appendChild(potrawyList);
                tr.appendChild(tdPotrawy);

                const tdStolik = document.createElement("td");
                tdStolik.textContent = 'numer stolika: '+oczekujace.id_stoliku+' '+oczekujace.nazwa+' '+oczekujace.umiejscowienie;
                tr.appendChild(tdStolik);

                /*
                const tdCena = document.createElement("td");
                tdCena.textContent = oczekujace.cena + "zł";
                tr.appendChild(tdCena);
                */




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
