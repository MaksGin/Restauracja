@extends('layouts.app')
@extends('layouts.prac_nav')
@section('content')
    <div class="container" style="margin-top: 50px">
        <div class="row">
            <div class="col">

            </div>
            <div class="col text-center">
                <h1>@lang('public.Lista Stanowisk')</h1>
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">id</th>
                        <th scope="col">@lang('public.Stanowisko')</th>
                        <th scope="col">@lang('public.Opis')</th>

                    </tr>
                    </thead>
                    <tbody>
                    @foreach($stanowiska as $stanowisko)
                        <tr>
                            <th scope="row">{{$stanowisko->id}}</th>
                            <td>{{ trans('public.' .$stanowisko -> stanowisko)}}</td>
                            <td>{{ trans('public.'.$stanowisko->opis)}}</td>

                        </tr>
                    @endforeach
                    </tbody>
                </table>

            </div>
            <div class="col">

            </div>
        </div>
    </div>



@endsection
