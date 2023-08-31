@extends('layouts.app')

@section('content')
<style>
    .container{
        position: relative;
    }
    .centered{
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%,-50%);
        color: white;
        font-size: 40px;
    }
    img{
        border-radius: 30px;
    }
    @media (max-width: 700px) {
    .centered {
        display: none;
    }
}

</style>
<body class="antialiased">



        <img  src="MainPagePhoto.jpg" alt="Opis obrazka" style="width: 100%; height: auto; margin: 0 auto;" class=" mx-auto d-block img-fluid">
        <div class="centered">Restaurant APP</div>




    <hr>

    <div class="container">
        <div class="row">
            <div class="col">

            </div>
            <div class="col text-center" id="menu">
                <h1>@lang('public.Lista Potraw')</h1>
            </div>
            <div class="col">

            </div>
        </div>
    </div>
    <div class="container">

        <div class="col" style="margin-top: 100px">
        @foreach ($kategorie as $kategoria)
            <h2>{{ trans('public.' .$kategoria->nazwa )}}</h2>

            @foreach ($potrawy->where('id_kategorii', $kategoria->id) as $potrawa)
                <p>{{ trans('public.'.$potrawa->nazwa) }} {{ $potrawa->cena}}zł</p>
            @endforeach
        @endforeach
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

