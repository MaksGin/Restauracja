<nav class="navbar navbar-expand-lg navbar-dark bg-dark" style="margin-top: 50px">
    <div class="container-fluid">
        <a class="navbar-brand" href="/home">Strona Główna</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDarkDropdown" aria-controls="navbarNavDarkDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNavDarkDropdown">
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Pracownicy
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDarkDropdownMenuLink">
                        <li><a class="dropdown-item" href="{{ route('pracownicy.index') }}">Lista Pracowników</a></li>
                        <li><a class="dropdown-item" href="{{ route('stanowiska.index') }}">Lista Stanowisk</a></li>
                        <li><a class="dropdown-item" href="{{ route('raportyKelner') }}">Raporty Kelnerów</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Potrawy
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDarkDropdownMenuLink">
                        <li><a class="dropdown-item" href="{{ route('ListaPotraw') }}">Lista Potraw</a></li>
                        <li><a class="dropdown-item" href="{{ route('ListaKategorii')}}">Lista Kategorii Potraw</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Stoliki
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDarkDropdownMenuLink">
                        <li><a class="dropdown-item" href="{{ route('ListaStolikow')}}">Lista Stolików</a></li>
                        <li><a class="dropdown-item" href="{{ route('ListaRezerwacji')}}">Lista rezerwacji</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Obsługa
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDarkDropdownMenuLink">
                        <li><a class="dropdown-item" href="{{ route('zamowienia')}}">Aktualne zamówienia</a></li>
                        <li><a class="dropdown-item" href="{{ route('Panelzamowienia')}}">Nowe zamówienie</a></li>
                        <li><a class="dropdown-item" href="{{ route('panelKuchnia')}}">Panel dla kuchnii</a></li>
                        <li><a class="dropdown-item" href="{{ route('panelBar')}}">Panel dla baru</a></li>
                        <li><a class="dropdown-item" href="{{ route('panelKelner')}}">Panel dla kelnera</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
