@extends('layouts.app')
@extends('layouts.prac_nav')
@section('content')

<style>
    .form-control{
        margin-bottom: 30px;
    }
    .btn{



    }
</style>

<div class="container">
    <div class="row">
        <div class="col">

        </div>
        <div class="col ">
            <form action="{{ route('kategorie.update', $kategorie->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="nazwa" class="form-label">Nazwa</label>
                    <input type="text" name="nazwa" class="form-control" id="imie" value="{{$kategorie->nazwa}}" required>
                </div>
                <select name="kategoria" class="form-control">
                    <option value="kuchnia" {{ $kategorie->miejsceRealizacji->id == 1 ? 'selected' : '' }}>Kuchnia</option>
                    <option value="bar" {{ $kategorie->miejsceRealizacji->id == 2 ? 'selected' : '' }}>Bar</option>
                </select>


                <center><button type="submit" class="btn btn-dark">Submit</button></center>
            </form>
        </div>
        <div class="col">

        </div>
    </div>
</div>

@endsection
