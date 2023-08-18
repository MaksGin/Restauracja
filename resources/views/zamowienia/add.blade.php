@extends('layouts.app')
@extends('layouts.prac_nav')
@section('content')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
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

</style>


<div class="container">
    <h1> Wybierz stolik </h1>
        <div id="lista-stolikow">

        </div>

</div>


<div class="container">
    <div class="row">
      <div class="col">
        <center><button class="category-button m-3 btn btn-dark m-3 text-white" data-category-id="1">Fast Food</button>
        <button class="category-button m-3 btn btn-dark m-3 text-white" data-category-id="2">Inne Dania</button></center>
      </div>
      <div class="col align-items-center">
        <center><a class="m-3 btn btn-dark m-3 text-white" id="pobierz-potrawy">pobierz wszystkie potrawy</a><br>
        <button class="category-button m-3 btn btn-dark m-3 text-white" data-category-id="4">Napoje</button></center>
      </div>
      <div class="col">
        <center><button class="category-button m-3 btn btn-dark m-3 text-white" data-category-id="6">Desery</button>
        <button class="category-button m-3 btn btn-dark m-3 text-white" data-category-id="7">Dodatki</button></center>
      </div>
    </div>
  </div>






<div class="container">

    <div id="lista-potraw">

    </div>
</div>
<div class="container" id="podsumowanie_panel" style="margin-top: 30px">
    <form action="create" method="POST">
        @csrf
        <div id="podsumowanie">

        </div>
        <input id="finnaly-price" value="0.00" type="hidden">
        <div class="col-box">
            <div>
                Suma:
                <span id="price">0.00</span> pln
            </div>

        </div>

    </form>
</div>
<script>


    document.addEventListener('DOMContentLoaded', function () {
    var stoliki = document.getElementById('lista-stolikow');
        // Wywołanie żądania AJAX do pobrania rezerwacji
        fetch('{{ route("getStoliki") }}')
            .then(response => response.json())
            .then(data => {
                data = JSON.parse(data);
                data.forEach(stolik => {
                    const div = document.createElement("div");
                    div.setAttribute("stolik_id", stolik.id);
                    div.classList.add("stolik");

                    const text = document.createTextNode(stolik.nazwa);
                    div.appendChild(text);

                    stoliki.appendChild(div);
                });
                console.log(data);
            })
            .catch(error => console.error(error));
    });


     var potrawy = document.getElementById('lista-potraw')
        document.getElementById('pobierz-potrawy').addEventListener('click', function () {
            // Wywołanie żądania AJAX do pobrania rezerwacji
            fetch('{{ route("getPotrawy") }}')
                .then(response => response.json())
                .then(data => {
                    document.getElementById('lista-potraw').innerHTML = '';

                    data = JSON.parse(data);
                    data.forEach(potrawa => {
                        const div = document.createElement("div");
                        div.setAttribute("potrawa_id", potrawa.id);
                        div.classList.add("potrawa");

                        const text = document.createTextNode(potrawa.nazwa);
                        div.appendChild(text);


                        potrawy.appendChild(div);
                    });
                    console.log(data);
                })
                .catch(error => console.error(error));
        });

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
                            div.classList.add("potrawa");

                            const text = document.createTextNode(potrawa.nazwa);
                            div.appendChild(text);


                            potrawy.appendChild(div);
                        });
                        console.log(data);
                    })
                    .catch(error => console.error(error));
            });
        });



</script>
<script>

    var price = 0.00;
    var numberId = 1;
    var btnBlocked = false;

    var SendInfo = {};

    var stolik = null;

    let kategorie = document.getElementById("kategorie").querySelectorAll('.kategoria');

    var lastDivStolik;

    showAll();

    $("#all_kategorie").click(function (event) {
        showAll();
    });

    for (var i = 0; i < kategorie.length; i++) {
        let id = kategorie[i].getAttribute("kategoria_id");
        kategorie[i].addEventListener('click', () => {
            if (btnBlocked)
                return;

            show(id)
            btnBlocked = true;
        })
    }

    function addPrice(price) {
        this.price += price;
        showPrice();
    }

    function setPrice(price)
    {
        this.price = price;
        showPrice();
        SendInfo = {};
    }

    function takePrice(price) {
        this.price -= price;
        showPrice();

    }

    $(".stolik-div").click(function (event) {
        selectStolik(this, this.getAttribute("stolik_id"));
    })


    function selectStolik(div, id)
    {
        resetStolikBg();
        stolik = id;
        lastDivStolik = div;
        lastDivStolik.classList.add('selected-stolik');
    }

    function resetStolikBg()
    {
        if(lastDivStolik==null)
            return;

        lastDivStolik.classList.remove('selected-stolik')
    }

    function showPrice() {
        let priceInput = document.getElementById("price");
        priceInput.setAttribute("finnaly-price", this.price);
        document.getElementById("price").innerText = parseFloat(this.price).toFixed(2);
    }

    function show(id) {
    var potrawy = $("#lista-potraw");
    potrawy.empty();

    $.ajax({
            url: "/potrawy" + id,
            method: "GET",
            dataType: "json",
            success: function(data) {
                data.forEach(p => {
                    const div = $("<div>")
                        .attr("potrawa_id", p.id)
                        .addClass("potrawa")


                    const text = $("<span>").text(p.nazwa);
                    div.append(text);

                    div.on("click", () => {
                        if (!p.dostep) {
                            var alert = $("#alert-box");
                            alert.empty();
                            const info = $("<div>")
                                .addClass("error")
                                .text("Potrawa jest niedostępna");
                            alert.append(info);
                            return;
                        }

                        var alert = $("#alert-box");
                        alert.empty();
                        podsumowanie(p.id, p.cena, p.nazwa);
                        addPrice(p.cena);
                    });

                    potrawy.append(div);
                });
            },
            error: function(xhr, status, error) {
                console.error("Błąd pobierania danych: " + error);
            }
        });
    }


    function showAll() {
        var potrawy = document.getElementById('lista-potraw')
        potrawy.textContent = ''
        fetch("{{route('PotrawyAll')}}")
            .then(response => response.json())
            .then(data => {
                data = JSON.parse(data);
                btnBlocked = false;

                data.forEach(p => {

                    const div = document.createElement("div");
                    div.setAttribute("potrawa_id", p[0].id);
                    div.classList.add("potrawa");


                    const text = document.createTextNode(p[0].nazwa);
                    div.appendChild(text);
                    div.addEventListener('click', () => {

                        var alert = document.getElementById('alert-box')
                        alert.textContent = '';
                        podsumowanie(p[0].id, p[0].cena, p[0].nazwa);
                        addPrice(p[0].cena);
                    })
                    potrawy.appendChild(div);
                });

            })
    }

    function podsumowanie(id, cena, nazwa) {
        var podsumowanie = document.getElementById('podsumowanie')


        // main div
        const main = document.createElement("div");
        main.classList.add("col-potrawa")

        // input
        const input = document.createElement("input");
        input.setAttribute("type", "hidden");
        input.setAttribute("name", "id_potrawy");
        input.setAttribute("value", id);
        main.appendChild(input);

        // left div - name
        const nameDiv = document.createElement("div");
        nameDiv.classList.add("potrawa-podsumowanie");
        nameDiv.innerText = nazwa;
        main.appendChild(nameDiv);

        // right div - price
        const priceDiv = document.createElement("div");
        priceDiv.classList.add("cena-podsumowanie");
        priceDiv.innerText = cena;
        main.appendChild(priceDiv);

        // right div - price
        const divBtn = document.createElement("div");
        divBtn.classList.add("btn-box");

        // button delete
        const buttonDiv = document.createElement("div");
        buttonDiv.innerText = "X";
        buttonDiv.classList.add("btn-delete")
        divBtn.appendChild(buttonDiv);
        var key = this.numberId;
        buttonDiv.addEventListener('click', () => {
            takePrice(cena);
            delete this.SendInfo[key]
            main.remove();
        })
        this.SendInfo[this.numberId] = {
            "id_potrawy": id
        }
        this.numberId++;
        main.appendChild(divBtn);
        podsumowanie.appendChild(main);
        console.log("" + JSON.stringify(this.SendInfo))

    }

    $("#btn-sendRequest").click(function (event) {
        event.preventDefault();
        let _token = $('meta[name="csrf-token"]').attr('content');
        if(stolik==null)
        {
            var alert = document.getElementById('alert-box')
            alert.textContent = '';
            const info = document.createElement("div");
            info.classList.add("error");
            info.innerText = 'Wybierz id stolika';
            alert.appendChild(info);
            return;
        }
        if(Object.keys(SendInfo).length===0)
        {
            var alert = document.getElementById('alert-box')
            alert.textContent = '';
            const info = document.createElement("div");
            info.classList.add("error");
            info.innerText = 'Wybierz potrawe';
            alert.appendChild(info);
            return;
        }
        $.ajax({
            url: "{{url("/api/zamowienie/create")}}",
            type: "POST",
            data: {
                "cena": price,
                "potrawy": JSON.stringify(SendInfo),
                "id_stoliku": stolik,
                "id_kelnera": 1,
                _token: _token
            },

            success: function (response) {

                // right div - price
                var alert = document.getElementById('alert-box')
                alert.textContent = '';
                const info = document.createElement("div");
                info.classList.add("success");
                info.innerText = response;
                alert.appendChild(info);
                document.getElementById('podsumowanie').textContent = '';
                setPrice(0.00);
                stolik = null;
                resetStolikBg();
                console.log(response)

            },
            error: function (error) {
                var alert = document.getElementById('alert-box')
                alert.textContent = '';
                const info = document.createElement("div");
                info.classList.add("error");
                info.innerText = error;
                alert.appendChild(info);
            }

        });
    });


    //let kategorie = document.querySelectorAll('.kategorie');
    /*for(let i = 0; i < kategorie.length;i++)
    {
        console.log("#");
        kategorie[i].addEventListener('click', () => {
            kategorie[i].hidden();
        })
    }*/


</script>
@endsection
