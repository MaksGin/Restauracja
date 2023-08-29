
@php
    $user = auth()->user();
    $stanowisko = $user->id_stanowiska;
@endphp

<nav class="navbar navbar-expand-lg navbar-dark bg-dark" style="margin-top: 50px">
    <div class="container-fluid">
        <a class="navbar-brand" href="/home">@lang('public.Strona Główna')</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDarkDropdown" aria-controls="navbarNavDarkDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNavDarkDropdown">
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    @if($stanowisko === 1)
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        @lang('public.Pracownicy')
                    </a>

                    <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDarkDropdownMenuLink">

                        <li><a class="dropdown-item" href="{{ route('pracownicy.index') }}">@lang('public.Lista Pracowników')</a></li>
                        <li><a class="dropdown-item" href="{{ route('stanowiska.index') }}">@lang('public.Lista Stanowisk')</a></li>

                        @if($stanowisko === 2 || $stanowisko === 1)
                        <li><a class="dropdown-item" href="{{ route('raportyKelner') }}">@lang('public.Raporty Kelnerów')</a></li>
                        @endif
                    </ul>
                    @endif
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        @lang('public.Potrawy')
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDarkDropdownMenuLink">
                        <li><a class="dropdown-item" href="{{ route('ListaPotraw') }}">@lang('public.Lista Potraw')</a></li>
                        <li><a class="dropdown-item" href="{{ route('ListaKategorii')}}">@lang('public.Lista Kategorii Potraw')</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        @lang('public.Stoliki')
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDarkDropdownMenuLink">
                        <li><a class="dropdown-item" href="{{ route('ListaStolikow')}}">@lang('public.Lista Stolików')</a></li>
                        <li><a class="dropdown-item" href="{{ route('ListaRezerwacji')}}">@lang('public.Lista rezerwacji')</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">

                    <a class="nav-link dropdown-toggle" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        @lang('public.Obsługa')
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDarkDropdownMenuLink">
                        @if($stanowisko === 2 || $stanowisko === 1)
                        <li><a class="dropdown-item" href="{{ route('zamowienia')}}">@lang('public.Aktualne zamówienia')</a></li>
                        <li><a class="dropdown-item" href="{{ route('Panelzamowienia')}}">@lang('public.Nowe zamówienie')</a></li>
                        @endif
                        @if($stanowisko === 3 || $stanowisko === 1)
                        <li><a class="dropdown-item" href="{{ route('panelKuchnia')}}">@lang('public.Panel dla kuchnii')</a></li>
                        @endif
                        @if($stanowisko === 4 || $stanowisko === 1)
                            <li><a class="dropdown-item" href="{{ route('panelBar')}}">@lang('public.Panel dla baru')</a></li>
                        @endif
                        @if($stanowisko === 2 || $stanowisko === 1)
                            <li><a class="dropdown-item" href="{{ route('panelKelner')}}">@lang('public.Panel dla kelnera')</a></li>
                        @endif
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>

