@extends('layouts.app')

@section('content')
<body class="antialiased">
    <img  src="MainPagePhoto.jpg" alt="Opis obrazka" style="width: 90%; height: auto; margin: 0 auto;" class="rounded mx-auto d-block img-fluid">
    <div class="container">
        <div class="row align-items-start">
          <div class="col-sm">

          </div>
          <div class="col-sm">
            <!--<p class="carousel-caption text-over-img text-center" style="font-size: 50px;">Restaurant App</p>-->
          </div>
          <div class="col-sm">

          </div>
        </div>
    </div>

    <hr>

    <div class="container">
        <div class="row">
            <div class="col" id="menu" style="margin-top: 100px">
                @foreach ($kategorie as $kategoria)
                    <h2>{{ $kategoria->nazwa }}</h2>

                    @foreach ($potrawy->where('id_kategorii', $kategoria->id) as $potrawa)
                        <p>{{ $potrawa->nazwa }} {{ $potrawa->cena}}zł</p>
                    @endforeach
                @endforeach
            </div>
            <div class="col text-center" >
                <h1>@lang('public.Lista Potraw')</h1>
            </div>
            <div class="col">

            </div>
        </div>
    </div>





</body>
<style>
    hr{
        margin: 30px 50px;
        border: 5px solid black;
    }
    .img {

        z-index: 0; }

    .text-over-img {
        z-index:1;
        font-size: 1.2em;
        margin-top: -100px;
    }
</style>


@endsection

