@extends('layouts.app')

@section('content')
<body class="antialiased">
    <img  src="MainPagePhoto.jpg" alt="Opis obrazka" style="width: 90%; height: auto; margin: 0 auto;" class="rounded mx-auto d-block img">
   <p class="carousel-caption text-over-img" style="margin-bottom: 500px">Restaurant App</p>
    <hr>

    <div class="container">
        <div class="row">
            <div class="col">

            </div>
            <div class="col text-center" id="menu">
                <h1>Lista potraw</h1>

                    @foreach ($potrawy as $potrawa)
                        {{ $potrawa->nazwa }}
                    @endforeach

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
