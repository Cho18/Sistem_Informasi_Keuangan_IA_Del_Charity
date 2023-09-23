<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> IA Del | Print Report </title>
    <style>
        table.static {
            position: relative;
            border: 1px solid black;
        }
    </style>
</head>
<body>
    <div class="form-group">
        <p align="center"> Laporan Donasi Donator </p>
        <table class="static" align="center" rules="all" border="1px" style="width: 95%;">
                <thead>
                    <tr style="text-align:center;">
                        <th><b> No </b></th>
                        <th><b> Nama Pengeluaran </b></th>
                        <th><b> Total Pengeluaran </b></th>
                        <th><b> Deskripsi Pengeluaran </b></th>
                        <th><b> Tanggal Pengeluaran </b></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pengeluaran as $pl)
                    <tr style="text-align:center;">
                        <td> {{ $loop->iteration }} </td>
                        <td> {{ $pl->jenis_pengeluaran->name_of_type_expenditure }} </td>
                        <td> Rp. {{ $pl->total_expenditure }}</td>
                        <td > {!! $pl->expenditure_description !!} </td>
                        <td> {{ $pl->expenditure_date }} </td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <th colspan="2"> Total </th>
                    <th> Rp. {{ number_format($expense,2,',','.') }} </th>
                </tfoot>
            </table>
        </table>
        
    </div>

    <script type="text/javascript">
        window.print();
    </script>
</body>
</html>