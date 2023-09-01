@extends('layouts.app')
@extends('layouts.prac_nav')
@section('content')
    <div class="container" style="margin-top: 50px">
        <div class="row">
            <div class="col">

            </div>
            <div class="col text-center">
                <h1>@lang('public.Lista Pracowników')</h1>
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">id</th>
                        <th scope="col">@lang('public.Imie')</th>
                        <th scope="col">@lang('public.Stanowisko')</th>
                        <th scope="col">@lang('public.Działania')</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($pracownicy as $pracownik)
                    <tr>
                        <th scope="row">{{$pracownik->id}}</th>
                        <td>{{$pracownik -> name }}</td>
                        <td>{{ trans('public.' .$pracownik->stanowisko->stanowisko)}}</td>
                        <td>
                            <a href="{{ route('pracownik.edit', ['id' => $pracownik->id]) }}" class="btn btn-secondary">
                                @lang('public.Edytuj')
                            </a>
                        </td>
                        <td>
                            <form action="{{ route('pracownik.destroy',[$pracownik->id]) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">@lang('public.Usuń')</button>
                            </form>
                        </td>
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
