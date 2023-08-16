@extends('layouts.app')
@extends('layouts.prac_nav')
@section('content')

<style>


</style>
<div class="container">
    <table class="table table-striped">
        <thead style="background-color: ">
            <tr>
            <th scope="col">#</th>
            <th scope="col">nazwa</th>
            <th scope="col">pojemnosc</th>
            <th scope="col">miejsce</th>
            </tr>
        </thead>
        <tbody>
            @foreach($stoliki as $stolik)
                <tr>
                <th scope="row">{{$stolik->id}}</th>
                <td>{{$stolik->nazwa}}</td>
                <td>{{$stolik->pojemnosc}}</td>
                <td>{{$stolik->umiejscowienie}}</td>
                </tr>
            @endforeach

        </tbody>
    </table>
</div>
@endsection
