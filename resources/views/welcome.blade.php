@extends('layouts.app')

@section('content')
<body class="antialiased">
    <img  src="MainPagePhoto.jpg" alt="Opis obrazka" style="width: 90%; height: auto; margin: 0 auto;" class="rounded mx-auto d-block img">
   <p class="carousel-caption text-over-img text-center" style="margin-bottom: 500px; font-size: 50px;">Restaurant App</p>
    <hr>

    <div class="container">
        <div class="row">
            <div class="col" id="menu" style="margin-top: 100px">
                @foreach ($kategorie as $kategoria)
                    <h2>Kategoria: {{ $kategoria->nazwa }}</h2>

                    @foreach ($potrawy->where('id_kategorii', $kategoria->id) as $potrawa)
                        <p>Nazwa potrawy: {{ $potrawa->nazwa }}</p>
                    @endforeach
                @endforeach
            </div>
            <div class="col text-center" >
                <h1>Lista potraw</h1>
            </div>
            <div class="col">

            </div>
        </div>
    </div>


    <!-- Footer -->
    <footer class="text-center text-lg-start bg-light text-muted">
        <!-- Section: Social media -->
        <section class="d-flex justify-content-center justify-content-lg-between p-4 border-bottom">

            <!-- Left -->

            <!-- Right -->
            <div>
                <a href="" class="me-4 text-reset">
                    <i class="fab fa-facebook-f"></i>
                </a>
                <a href="" class="me-4 text-reset">
                    <i class="fab fa-twitter"></i>
                </a>
                <a href="" class="me-4 text-reset">
                    <i class="fab fa-google"></i>
                </a>
                <a href="" class="me-4 text-reset">
                    <i class="fab fa-instagram"></i>
                </a>
                <a href="" class="me-4 text-reset">
                    <i class="fab fa-linkedin"></i>
                </a>
                <a href="" class="me-4 text-reset">
                    <i class="fab fa-github"></i>
                </a>
            </div>
            <!-- Right -->
        </section>
        <!-- Section: Social media -->

        <!-- Section: Links  -->
        <section class="">
            <div class="container text-center text-md-start mt-5">
                <!-- Grid row -->
                <div class="row mt-3">
                    <!-- Grid column -->
                    <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
                        <!-- Content -->
                        <h6 class="text-uppercase fw-bold mb-4">
                            <i class="fas fa-gem me-3"></i>Restaurant App
                        </h6>
                        <p>
                            Best restaurant in your town!
                        </p>
                    </div>
                    <!-- Grid column -->

                    <!-- Grid column -->
                    <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">
                        <!-- Links -->
                        <h6 class="text-uppercase fw-bold mb-4">
                            Products
                        </h6>
                        <p>
                            <a href="#!" class="text-reset">Angular</a>
                        </p>

                    </div>
                    <!-- Grid column -->

                    <!-- Grid column -->
                    <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">
                        <!-- Links -->
                        <h6 class="text-uppercase fw-bold mb-4">
                            Useful links
                        </h6>
                        <p>
                            <a href="#!" class="text-reset">Pricing</a>
                        </p>

                    </div>
                    <!-- Grid column -->

                    <!-- Grid column -->
                    <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
                        <!-- Links -->
                        <h6 class="text-uppercase fw-bold mb-4">Contact</h6>
                        <p><i class="fas fa-home me-3"></i>Jarosław</p>
                        <p>
                            <i class="fas fa-envelope me-3"></i>
                            maksgintner0@gmail.com
                        </p>
                        <p><i class="fas fa-phone me-3"></i>795 668 743</p>

                    </div>
                    <!-- Grid column -->
                </div>
                <!-- Grid row -->
            </div>
        </section>
        <!-- Section: Links  -->

        <!-- Copyright -->
        <div class="text-center p-4" style="background-color: rgba(0, 0, 0, 0.05);">
            © 2023 Copyright:
            Gintner Maksymilian
        </div>
        <!-- Copyright -->
    </footer>
    <!-- Footer -->


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
