@extends('layouts.app')
@extends('layouts.prac_nav')
@section('content')
    <div class="container" style="margin-top: 50px">
        <div class="row">
            <div class="col">

            </div>
            <div class="col text-center">
                <h1>Lista pracowników</h1>
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">id</th>
                        <th scope="col">Imie</th>
                        <th scope="col">Stanowisko</th>
                        <th scope="col">Działania</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($pracownicy as $pracownik)
                    <tr>
                        <th scope="row">{{$pracownik->id}}</th>
                        <td>{{$pracownik -> name }}</td>
                        <td>{{$pracownik->stanowisko->stanowisko}}</td>
                        <td>
                            <a href="{{ route('pracownik.edit',[$pracownik->id])}}" class="btn btn-secondary">
                                Edytuj
                            </a>
                        </td>
                        <td>
                            <form action="{{ route('pracownik.destroy',[$pracownik->id]) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Usuń</button>
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
