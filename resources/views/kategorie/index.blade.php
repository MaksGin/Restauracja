@extends('layouts.app')
@extends('layouts.prac_nav')
@section('content')
@if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

<style>
    hr{
        border: 10px solid rgb(0, 0, 0);
        border-radius: 5px;
    }

</style>
<div class="container" style="margin-top: 50px">
    <div class="row">
        <div class="col">

        </div>
        <div class="col text-center">
            <h1>@lang('public.Lista kategorii')</h1>
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">id</th>
                    <th scope="col">@lang('public.nazwa')</th>
                    <th scope="col">@lang('public.miejsce realizacji</th>')'
                    <th scope="col">@lang('public.Działania')</th>
                    <th scope="col"></th>
                </tr>
                </thead>
                <tbody>
                    @foreach($lista_kategorii as $kategorie)
                    <tr>
                        <td scope="row">{{ $kategorie->id }}</td>
                        <td scope="row">{{ trans('public.' .$kategorie->nazwa )}}</td>
                        <td scope="row">{{ trans('public.' .$kategorie->miejsceRealizacji->nazwa)}}</td>
                        <td>
                            <a href="{{ route('kategorie.edit',[$kategorie->id])}}" class="btn btn-secondary">
                                @lang('public.Edytuj')
                            </a>
                        </td>
                        <td>
                            <form action="{{ route('kategorie.destroy',[$kategorie->id]) }}" method="POST">
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
    <hr>
    <div class="container">
        <h2>Dodaj kategorie potrawy:</h2>
        <form action="{{ route('kategorie.store') }} " method="POST">
            @csrf
            <label>Nazwa kategorii:</label>
            <input type="text" name="nazwa" class="form-control" required/><br>

            <label>Miejsce realizacji:</label>
            <select name="miejsce" class="form-control">
                <option value="kuchnia" {{ $kategorie->miejsceRealizacji->id == 1 ? 'selected' : '' }}>Kuchnia</option>
                <option value="bar" {{ $kategorie->miejsceRealizacji->id == 2 ? 'selected' : '' }}>Bar</option>
            </select>
            <button type="submit" class="btn btn-dark" style="margin-top: 20px;">Dodaj</button>
        </form>
    </div>
</div>


@endsection
