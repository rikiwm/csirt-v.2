{{-- <table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Description</th>
            <th>Status</th>
            <th>Created At</th>
            <th>Updated At</th>
        </tr>
    </thead>
    <tbody>
        @foreach($tickets as $ticket)
            <tr>
                <td>{{ $ticket->id }}</td>
                <td>{{ $ticket->title }}</td>
                <td>{{ $ticket->description }}</td>
                <td>{{ $ticket->status }}</td>
                <td>{{ $ticket->created_at }}</td>
                <td>{{ $ticket->updated_at }}</td>
            </tr>
        @endforeach
    </tbody>
</table> --}}

<!DOCTYPE html>
<html lang="en">

<head>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

</head>
<style>
    html {
        margin-top: -5px;
        font-family: Tahoma, Verdana, Segoe, sans-serif;
    }

    body {
        font-family: Tahoma, Verdana, Segoe, sans-serif;
    }

    .kop {
        letter-spacing: normal;
        line-height: 0.3em;
        font-family: Verdana, Geneva, sans-serif;
        width: 100%;
        font-size: 14px;
        margin-top: 20px;
    }

    img {
        height: 42pt;
        width: auto;
        margin-right: 10px;
    }

    .no-seri {
        font-size: 12pt;
    }

    .kepala {
        font-size: 14px;
        font-family: Tahoma, Verdana, Segoe, sans-serif;
        font-style: normal;
        width: 100%;
    }

    .kepala td {
        vertical-align: top;
    }

    th {
        font-family: Tahoma, Verdana, Segoe, sans-serif;
        text-align: center;
        font-size: 14px;
    }

    .tabel-2 {
        padding-right: 30px;
        font-weight: 100;

    }

    .table-yth {
        margin-top: 20px;
        float: right;
        border: 1px solid black;
    }

    .tabelisi {
        margin-top: 10px;
        border: 1;
        border: 1px solid black;
        border-collapse: collapse;
        width: 100%;
        padding: 5px;
        font-family: Tahoma, Verdana, Segoe, sans-serif;
    }

    .tabelisi thead tr th b {
        font-family: Tahoma, Verdana, Segoe, sans-serif;
    }


    .table-isi tr th {
        margin-top: 20px;
        font-family: Tahoma, Verdana, Segoe, sans-serif;

    }


    span {
        font-family: Tahoma, Verdana, Segoe, sans-serif;
        font-size: 11px;
    }

    .pre-header {
        text-align: right;
        margin-top: 10px;
    }

    .nomor-doc {
        text-align: center;
        font-family: Tahoma, Verdana, Segoe, sans-serif;
    }

    .isi {
        text-align: justify;
        font-family: Tahoma, Verdana, Segoe, sans-serif;

    }

    .isi .catatan {
        margin-top: 0;
        margin-bottom: 0;
        font-size: 14px;
        font-family: Tahoma, Verdana, Segoe, sans-serif;

    }

    .ttd {
        float: right;
        margin-top: 20px;
        font-family: Tahoma, Verdana, Segoe, sans-serif;
        font-size: 14px;
    }

    .ttd,
    ul {
        position: relative;
        list-style: none;
        margin-left: 10;
        padding-left: 1.2em;
    }

    ul li:before {
        content: "-";
        position: absolute;
        left: 0;
    }

    .grid-container {
        display: grid;
        grid-template-columns: auto;
        text-align: start;
    }

    .grid-titik {
        display: grid;
        text-align: start;
        grid-template-columns: 15% 80%;
    }

    .grid-item {
        background-color: rgba(255, 255, 255, 0.8);
        font-style: italic;
        font-size: 14px;
    }

    .t-body td {
        padding-left: 10px;
        font-size: 14px;
    }

    .subtitel {
        text-align: center;
        text-transform: uppercase;
        font-family: Tahoma, Verdana, Segoe, sans-serif;
        font-size: 14px;
        top: 0;
        bottom: 0;
        margin-bottom: -10px;
    }

    @font-face {
        font-family: Tahoma, Verdana, Segoe, sans-serif;
    }

    @page {
        font-family: Tahoma, Verdana, Segoe, sans-serif;
        size: A4 landscape;
        margin-left: 0.67in;
        margin-right: 0.67in;
        margin-bottom: 0.39in;
    }
</style>

<body>
    <div class="pre-header">
        <span class="nomor-doc">No. Document</span>
    </div>
    <header>
        <table class="kop">
            <tr>
                <td style="width: 6%">
                    <img src="https://seeklogo.com/images/K/kota-padang-logo-24E687949A-seeklogo.com.png" alt="asdasd"
                        width="auto" height="65pt">
                </td>
                <td style="width: 80%">
                    <p><b>Test</b></p>
                    <p><b>KOTA PADANG</b></p>
                    <p>Jl. By Pass Km 15 Air Pacah Padang
                    </p>
                </td>


            </tr>
        </table>
    </header>
    <main>
        <h3 class="subtitel">Summary Report</h3>
        <table class="tabelisi" border="1">
            <thead>
                <tr >
                    <th style="width: 4%"><b>No.</b></th>
                    <th  style="width: 20%"><b>subject.</b></th>
                    <th><b>name.</b></th>
                    <th><b>name.</b></th>

                </tr>
            </thead>
            <tbody>
                @foreach ($tickets as $item)
                    <tr class="t-body">
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->subject }}</td>
                        <td>{{ $item->users->name }}</td>
                        <td>{{ $item->types[0]['name'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </main>


<script>
    window.print();
</script>
</body>

</html>
