@extends('layouts.app')
@extends('layouts.prac_nav')
@section('content')

<center><h1>@lang('public.Raport z dnia') {{$dzisiejsza_data}}</h1></center>
@if($brak_zamowien)
   <center><p>Brak zrealizowanych zamówień</p></center>
@else

<div class="container" style="margin-top: 50px;">
    <table class="table table-hover">
        <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">@lang('public.Kelner')</th>
              <th scope="col">@lang('public.Zawartość')</th>
              <th scope="col">@lang('public.Stolik')</th>
              <th scope="col">@lang('public.Status')</th>
              <th scope="col">@lang('public.Cena')</th>
            </tr>
          </thead>
          <tbody>
            @foreach($zamowienia as $zamowienie)
            <tr onclick="window.location='{{ route('details', $zamowienie['id']) }}'">
                <td>Nr.{{$zamowienie->id}}</td>
                <td>{{$zamowienie->user->name}}</td>
                <td>
                    @foreach ($zamowienie->potrawy as $potrawa)
                        <li>{{ trans('public.' .$potrawa->nazwa )}} ({{ $potrawa->cena }})</li>
                    @endforeach
                </td>
                <td>{{$zamowienie->id_stoliku}}</td>
                <td>{{ trans('public.' .$zamowienie->status->status)}}</td>
                <td>{{$zamowienie->cena}} zł</td>
            </tr>
            @endforeach
          </tbody>
    </table>
</div>
<div class="container" style="margin-top: 50px;">
    <div class="row">
      <div class="col">

      </div>
      <div class="col">

      </div>
      <div class="col">
        <h4>@lang('public.Podsumowanie'): {{$podsumowanie}} zł</h4><br>
        <!-- przycisk Pobierz PDF -->
        <a href="{{ route('zamowienia.export.pdf') }}"><button class="btn btn-dark btn-sm">
            <i class="fa fa-pencil-square-o" aria-hidden="true"></i> @lang('public.Pobierz PDF')
        </button></a>

      </div>
    </div>
  </div>

@endif
@endsection
