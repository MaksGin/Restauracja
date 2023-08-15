@extends('layouts.app')
@extends('layouts.prac_nav')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col">

            </div>
            <div class="col ">
                <form action="{{ route('pracownik.update', $pracownik->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="imie" class="form-label">Imię</label>
                        <input type="text" name="imie" class="form-control" id="imie" value="{{ $pracownik->name }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="nazwisko" class="form-label">Email</label>
                        <input type="text" name="email" class="form-control" id="nazwisko" value="{{ $pracownik->email }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="telefon" class="form-label">Telefon</label>
                        <input type="text" name="telefon" class="form-control" id="numer_indeksu" value="{{ $pracownik->telefon }}" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
            <div class="col">

            </div>
        </div>
    </div>


@endsection
