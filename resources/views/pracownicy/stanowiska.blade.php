@extends('layouts.app')
@extends('layouts.prac_nav')
@section('content')
    <div class="container" style="margin-top: 50px">
        <div class="row">
            <div class="col">

            </div>
            <div class="col text-center">
                <h1>Lista stanowisk</h1>
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">id</th>
                        <th scope="col">Stanowisko</th>
                        <th scope="col">Opis</th>

                    </tr>
                    </thead>
                    <tbody>
                    @foreach($stanowiska as $stanowisko)
                        <tr>
                            <th scope="row">{{$stanowisko->id}}</th>
                            <td>{{$stanowisko -> stanowisko }}</td>
                            <td>{{$stanowisko->opis}}</td>

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
