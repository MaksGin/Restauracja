@extends('layouts.app')
@extends('layouts.prac_nav')
@section('content')

<h1><center>@lang('public.Zamówienia w dniu') {{$Data}}</center></h1>

<center>
    <a href="{{ route('Panelzamowienia')}}">
        <button type="submit" class="btn btn-dark" style="margin-top: 20px;">@lang('public.Dodaj zamówienie')</button>
    </a>
</center>
<div class="container" style="margin-top: 50px;">
    <table class="table table-hover">
        <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">@lang('public.Kelner')</th>
              <th scope="col">@lang('public.Stolik')</th>
              <th scope="col">@lang('public.Status')</th>
              <th scope="col">@lang('public.Cena')</th>
            </tr>
          </thead>
          <tbody>
            @foreach($zamowienia as $zamowienie)
            <tr onclick="window.location='{{ route('details', $zamowienie['id']) }}'">
                <td>{{$zamowienie->id}}</td>
                <td>{{$zamowienie->id_kelnera}}</td> <!-- wyswietlic imie kelnera , nazwe stolika z relacji -->
                <td>{{$zamowienie->id_stoliku}}</td>
                <td>{{ trans('public.' .$zamowienie->status->status)}}</td>
                <td>{{$zamowienie->cena}} zł</td>
            </tr>
            @endforeach
          </tbody>
    </table>
</div>

@endsection
