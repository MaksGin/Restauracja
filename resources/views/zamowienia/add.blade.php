@extends('layouts.app')
@extends('layouts.prac_nav')
@section('content')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

<meta name="csrf-token" content="{{ csrf_token() }}"/>

<style>
    .potrawa-none {
        background: #ff8585!important;
    }
    #price {
        font-size: 22px;
    }
    .podsuwanie-col {
        background: #fff2d3;
        padding:20px;
        border-radius: 8px;
    }
    .btn-box {
        display: flex;
    }
    .kategoria {
        cursor: pointer;
        text-align: center;
        background: #fff2d3;
        font-weight: 600;
        padding:10px 0px;
        margin-top:10px;
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
        box-sizing: border-box;
    }
    .title-col {
        font-size:24px;
        padding-left:20px;
    }

    .kategoria:hover {
        background: #ccc;
    }
    #lista-potraw {
        margin-top:10px;
    }

    .potrawa {
        cursor: pointer;
        font-size: 16px;
        padding:6px;
        margin:2px;
        background: #fff2d3;
    }

    .potrawa:hover {
        background: #ccc;
    }

    #podsumowanie {
        display: grid;
        grid-template-columns: 1fr;
    }

    .col-potrawa {
        display: grid;
        grid-template-columns: 3fr 2fr 1fr;
        align-items: center;
        margin:4px;
        background: #dbc694;
        padding:10px;
    }

    .potrawa-podsumowanie {
        float: left;
        width: 50%;
    }

    .cena-podsumowanie {
        float: left;
        width: 30%;
    }

    .btn-delete {
        background: #111;
        border-radius: 8px;
        padding:6px 10px;
        text-align: center;
        color: #fff;
        cursor: pointer;
        margin: 0 auto;
    }
    .col-box {
        display: grid;
        margin-top:10px;
        grid-template-columns: 1fr 1fr;
    }
    #alert-box {
        display: grid;
        text-align: center;
        padding:10px;
    }
    .success {
        background: #5efc52;
    }
    .error {
        background: #ee4343;
    }
    .selected-stolik {
        background: #ffbc3d;
    }
    #lista-stolikow {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(150px, 1fr)); /* Dynamicznie tworzy kolumny w siatce */
        gap: 10px; /* Odstępy między elementami */
    }


    .stolik {
        cursor: pointer;
        font-size: 16px;
        padding:6px;
        margin:2px;
        background: #fff2d3;
    }
    #podsumowanie_panel{
        background-color: #dbc694;
        border-radius: 25px;

    }
    .stolik.zaznaczony {
        background-color: skyblue; /* Przykładowy kolor tła */
        color: black; /* Przykładowy kolor tekstu */
        border: 2px solid black; /* Przykładowe obramowanie */
    }

    .potrawa.zaznaczony {
        background-color: skyblue; /* Przykładowy kolor tła */
        color: black; /* Przykładowy kolor tekstu */
        border: 2px solid black; /* Przykładowe obramowanie */
    }
    .stolik{
        text-align: center;
        vertical-align: text-top;
    }

</style>


<div class="container">
    <h1> @lang('public.Wybierz stolik') </h1>
        <div id="lista-stolikow">

        </div>

</div>


<div class="container">
    <div class="row">
      <div class="col">
        <center><button class="category-button m-3 btn btn-dark m-3 text-white" data-category-id="1">@lang('public.Fast Food')</button>
        <button class="category-button m-3 btn btn-dark m-3 text-white" data-category-id="2">@lang('public.Inne Dania')</button></center>
      </div>
      <div class="col align-items-center">
        <center><a class="m-3 btn btn-dark m-3 text-white" id="pobierz-potrawy">@lang('public.pobierz wszystkie potrawy')</a><br>
        <button class="category-button m-3 btn btn-dark m-3 text-white" data-category-id="4">@lang('public.Napoje')</button></center>
      </div>
      <div class="col">
        <center><button class="category-button m-3 btn btn-dark m-3 text-white" data-category-id="6">@lang('public.Desery')</button>
        <button class="category-button m-3 btn btn-dark m-3 text-white" data-category-id="7">@lang('public.Dodatki')</button></center>
      </div>
    </div>
  </div>






<div class="container">

    <div id="lista-potraw">

    </div>
</div>

<!-- formularz -->
<div class="container" id="podsumowanie_panel" style="margin-top: 30px">
    <form action="{{ route('SaveZamowienie') }}" method="POST">
        @csrf
        <input type="hidden" name="id_kelnera" value="1">

        <div id="lista-stolikow">

        </div>
        <div id="lista-potraw">

        </div>

        <div id="podsumowanie">

        </div>
        <input type="hidden" name="cena_potrawy" id="cena_potrawy_input">
        <input type="hidden" name="id_stolika" id="id_stolika_input">
        <input type="hidden" name="id_statusu_kuchnia" id="id_statusu_kuchnia">
        <input type="hidden" name="id_statusu_bar" id="id_statusu_bar">
        <input type="hidden" name="zaznaczone_potrawy" id="zaznaczone_potrawy_input">
        <div class="col-box">
            <div>
                @lang('public.Suma'):
                <span id="price">0.00</span>
                <button class=" m-3 btn btn-dark m-3 text-white" id="zatwierdzBtn">@lang('public.Zatwierdź')</button>
            </div>

        </div>

    </form>

</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    const currentLocale = '{{ App::getLocale() }}';
    const selectedPotrawa = {
        id: null,
        cena: null
    };
    const selectedStolik = {
        id: null,
    }
    var stolikId;
    let sumaCenPotraw = 0.0;
    const translatedTableNames = @json($translatedStoliki);
    const translatedPotrawy = @json($translatedPotrawy);
    const selectedPotrawy = [];
    document.addEventListener('DOMContentLoaded', function () {

        var stoliki = document.getElementById('lista-stolikow');

        fetch('{{ route("getStoliki") }}')
            .then(response => response.json())
            .then(data => {
                data = JSON.parse(data);
                data.forEach(stolik => {
                    const div = document.createElement("div");
                    div.setAttribute("stolik_id", stolik.id);
                    div.classList.add("stolik");


                    let textContent = stolik.nazwa + '<br><hr>' + stolik.umiejscowienie;

                    //jesli locale ustawione na angielski to pobierz przetłumaczone nazwy stolików z translatedTableNames
                    if (currentLocale === 'en') {
                        textContent = translatedTableNames[stolik.nazwa]+'<hr>'+translatedTableNames[stolik.umiejscowienie]|| stolik.nazwa;

                    }

                    //innerHTML aby uwzglednic elementy html w textContent
                    div.innerHTML = textContent;

                    stoliki.appendChild(div);

                    //nasluch na klikniecie
                    div.addEventListener('click', function () {

                        stolikId = div.getAttribute("stolik_id");


                        const zaznaczoneStoliki = stoliki.querySelectorAll(".stolik.zaznaczony");
                        zaznaczoneStoliki.forEach(zaznaczonyStolik => {
                            zaznaczonyStolik.classList.remove("zaznaczony");
                        });


                        div.classList.add("zaznaczony");
                        document.getElementById('id_stolika_input').value = stolikId;

                        selectedStolik.idStolik = stolikId;
                        console.log("Wybrano stolik o id:", stolikId);

                    });

                }).catch(error => console.error(error));
            });





        //Lista wszystkich potraw
        var potrawy = document.getElementById('lista-potraw')
        document.getElementById('pobierz-potrawy').addEventListener('click', function () {

            // Wywołanie żądania AJAX do pobrania potraw
            fetch('{{ route("getPotrawy") }}')
                .then(response => response.json())
                .then(data => {
                    document.getElementById('lista-potraw').innerHTML = '';


                    //jeszcze raz parsowanie do formatu json
                    data = JSON.parse(data);

                    //pętla przchodzi po wszystkich potrawach i wyswietla je w osobnych divach
                    data.forEach(potrawa => {
                        const div = document.createElement("div");
                        div.setAttribute("potrawa_id", potrawa.id);
                        div.setAttribute("potrawa_cena", potrawa.cena);
                        div.classList.add("potrawa");

                        const text = document.createTextNode(potrawa.nazwa+' '+potrawa.cena+'zł');

                        let textContent = potrawa.nazwa

                        //jesli locale ustawione na angielski to pobierz przetłumaczone nazwy potraw z translatedPotrawy
                        if (currentLocale === 'en') {
                            textContent = translatedPotrawy[potrawa.nazwa]+' '+potrawa.cena+'zł' || potrawa.nazwa;

                        }
                        div.innerHTML = textContent;
                        potrawy.appendChild(div);

                        div.addEventListener('click', function () {

                            const clickedDiv = event.target.closest('.potrawa');

                            if (clickedDiv) {
                                const potrawaId = clickedDiv.getAttribute("potrawa_id");
                                const potrawaCena = clickedDiv.getAttribute("potrawa_cena");

                                // Jeśli potrawa jest już zaznaczona, odznacz ją
                                if (selectedPotrawy.includes(potrawaId)) {

                                    selectedPotrawy.splice(selectedPotrawy.indexOf(potrawaId), 1); //usuniecie id potraw z tablicy, wartosci oddzielone przecinkiem

                                    sumaCenPotraw -= parseFloat(potrawaCena);
                                    clickedDiv.classList.remove("zaznaczony");

                                } else {
                                    // W przeciwnym razie zaznacz potrawę i dodaj do listy zaznaczonych
                                    selectedPotrawy.push(potrawaId);

                                    sumaCenPotraw += parseFloat(potrawaCena);
                                    clickedDiv.classList.add("zaznaczony");
                                }
                                console.log("Aktualna zawartość selectedPotrawy:", selectedPotrawy);
                                var IdKelner = 10;


                                console.log("Wybrano potrawę o id:", potrawaId);
                                console.log("Cena potrawy:", potrawaCena);

                                //przypisuje wartosci do formularza
                                document.getElementById('cena_potrawy_input').value = sumaCenPotraw;
                                document.getElementById('zaznaczone_potrawy_input').value = selectedPotrawy;
                                var status = 5;
                                var statusBar = 5;
                                document.getElementById('id_statusu_kuchnia').value = status;
                                document.getElementById('id_statusu_bar').value=statusBar;
                                zapiszDoBazy(IdKelner, stolikId, potrawaCena,status,statusBar);


                                document.getElementById('price').textContent = sumaCenPotraw.toFixed(2) + ' pln';
                            }

                        });
                        console.log(data);
                    })
                        .catch(error => console.error(error));
                });
        });


        //Lista potraw po kategorii
        const categoryButtons = document.querySelectorAll('.category-button');

        categoryButtons.forEach(button => {

            button.addEventListener('click', () => {
                const selectedCategoryID = button.getAttribute('data-category-id');
                console.log(selectedCategoryID);

                fetch('/getPotrawyByCategory/'+ selectedCategoryID)
                    .then(response => response.json())
                    .then(data => {

                        document.getElementById('lista-potraw').innerHTML = '';

                        data = JSON.parse(data);

                        data.forEach(potrawa => {
                            const div = document.createElement("div");
                            div.setAttribute("potrawa_id", potrawa.id);
                            div.setAttribute("potrawa_cena", potrawa.cena);
                            div.classList.add("potrawa");

                            const text = document.createTextNode(potrawa.nazwa+' '+potrawa.cena+'zł');

                            let textContent = potrawa.nazwa

                            //jesli locale ustawione na angielski to pobierz przetłumaczone nazwy potraw z translatedPotrawy
                            if (currentLocale === 'en') {
                                textContent = translatedPotrawy[potrawa.nazwa]+' '+potrawa.cena+'zł' || potrawa.nazwa;

                            }
                            div.innerHTML = textContent;
                            potrawy.appendChild(div);

                            div.addEventListener('click', function () {

                                const clickedDiv = event.target.closest('.potrawa');

                                if (clickedDiv) {
                                    const potrawaId = clickedDiv.getAttribute("potrawa_id");
                                    const potrawaCena = clickedDiv.getAttribute("potrawa_cena");

                                    // Jeśli potrawa jest już zaznaczona, odznacz ją
                                    if (selectedPotrawy.includes(potrawaId)) {

                                        selectedPotrawy.splice(selectedPotrawy.indexOf(potrawaId), 1);
                                        sumaCenPotraw -= parseFloat(potrawaCena);
                                        clickedDiv.classList.remove("zaznaczony");
                                    } else {

                                        // W przeciwnym razie zaznacz potrawę i dodaj do listy zaznaczonych
                                        selectedPotrawy.push(potrawaId);
                                        sumaCenPotraw += parseFloat(potrawaCena);
                                        clickedDiv.classList.add("zaznaczony");
                                    }
                                    console.log("Aktualna zawartość selectedPotrawy:", selectedPotrawy);
                                    var IdKelner = 10;


                                    console.log("Wybrano potrawę o id:", potrawaId);
                                    console.log("Cena potrawy:", potrawaCena);

                                    document.getElementById('cena_potrawy_input').value = sumaCenPotraw;
                                    document.getElementById('zaznaczone_potrawy_input').value = selectedPotrawy;
                                    var status = 5;
                                    var statusBar = 5;
                                    document.getElementById('id_statusu_kuchnia').value = status;
                                    document.getElementById('id_statusu_bar').value=statusBar;
                                    zapiszDoBazy(IdKelner, stolikId, potrawaCena,status,statusBar);
                                    // Tutaj możesz aktualizować wyświetlaną sumę itp.
                                    document.getElementById('price').textContent = sumaCenPotraw.toFixed(2) + ' pln';
                                }
                            })

                        });
            console.log(data);
        })
            .catch(error => console.error(error));

            });
        });

        function zapiszDoBazy(id_kelnera, id_stolika, cena_potrawy,status,statusBar) {

            const zatwierdzBtn = document.getElementById('zatwierdzBtn');

            console.log("Aktualna zawartość selectedPotrawy:", selectedPotrawy);

            zatwierdzBtn.addEventListener('click', () => {
                if (selectedStolik.id !== null && selectedPotrawy.length > 0) { //do przesłania formularza musi być zaznaczony stolik i co najmniej jedna potrawa

                        const requestData = {
                            id_kelnera: id_kelnera,
                            cena_potrawy: cena_potrawy,
                            id_stolika: id_stolika,
                            id_statusu_kuchnia: status,
                            id_statusu_bar: statusBar,
                            zaznaczone_potrawy: selectedPotrawy
                    };

                    const xhr = new XMLHttpRequest();

                    xhr.open("POST", "/zamowienie/save", true);
                    xhr.setRequestHeader("Content-Type", "application/json");
                    xhr.setRequestHeader("X-CSRF-Token", "{{ csrf_token() }}");

                    xhr.onreadystatechange = function () {
                        if (xhr.readyState === XMLHttpRequest.DONE) {
                            if (xhr.status === 200) {
                                const response = JSON.parse(xhr.responseText);
                                console.log("Zapisano pomyślnie!", response);
                            } else {
                                console.error("Błąd podczas zapisywania:", xhr.statusText);
                            }
                        }
                    };

                    xhr.send(JSON.stringify(requestData));
                }
            });
        }

    });












</script>

@endsection
