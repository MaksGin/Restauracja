@extends('layouts.app')
@extends('layouts.prac_nav')
@section('content')
<style>


</style>

<div class="container">
    <table class="table" style="margin-top: 50px;">
        <thead class="thead-dark">
            <tbody>
                @php
                    $naglowekKategorii = null;
                @endphp

                @foreach($potrawy as $potrawa)
                    @if ($potrawa->kategoria->nazwa !== $naglowekKategorii)
                        @php
                            $naglowekKategorii = $potrawa->kategoria->nazwa;
                        @endphp
                        <tr>
                            <th scope="col" colspan="3">{{ $naglowekKategorii }}</th>
                        </tr>
                    @endif
                        <tr>
                            <td>{{ $potrawa->nazwa }}</td>
                            <td>{{ $potrawa->opis }}</td>
                            <td>{{ $potrawa->cena }} zł</td>
                        </tr>
                @endforeach
            </tbody>
    </table>
</div>


@endsection
