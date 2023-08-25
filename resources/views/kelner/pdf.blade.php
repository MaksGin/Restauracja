


<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <style>
    @page {
        margin:5px;
    }
    body {
        font-family: DejaVu Sans, sans-serif;
        margin: 5px;
     }

    table, td, th {
        border: 1px solid;
        letter-spacing: -1px;


    }
    td{
        padding: 0;
        line-height: 1;
    }
    table {
    width: 100%;
    border-spacing: 0;

    }

    div.footer {
                position: fixed;
                bottom: 20px;
                left: 0;
                right: 0;
                text-align: center;
            }

    .page-break {
    page-break-after: always;
    }

    </style>
</head>
<body>
    <center><h1>Raport z dnia {{$dzisiejsza_data}}</h1></center>


    <div class="container" style="margin-top: 50px;">
        <table class="table table-hover">
            <thead>
                <tr >
                  <th scope="col">#</th>
                  <th scope="col">Kelner</th>
                  <th scope="col">Stolik</th>
                  <th scope="col">Status</th>
                  <th scope="col">Cena</th>
                </tr>
              </thead>
              <tbody>
                @foreach($zamowienia as $zamowienie)
                <tr onclick="window.location='{{ route('details', $zamowienie['id']) }}'">
                    <td>Nr.{{$zamowienie->id}}</td>
                    <td>{{$zamowienie->user->name}}</td>
                    <td>
                        @foreach ($zamowienie->potrawy as $potrawa)
                            <li>{{ $potrawa->nazwa }} ({{ $potrawa->cena }})</li>
                        @endforeach
                    </td>
                    <td>{{$zamowienie->id_stoliku}}</td>
                    <td>{{$zamowienie->status->status}}</td>
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
            <h4>Podsumowanie: {{$podsumowanie}} zł</h4><br>
           </div>
        </div>
      </div>





</body>

</html>
