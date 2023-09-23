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
                        <th><b> Kode Nama </b></th>
                        <th><b> Jumlah Donasi </b></th>
                        <th><b> Tanggal Donasi </b></th>
                        <th><b> Tipe Akun </b></th>
                        <th><b> Deskripsi </b></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($donator_donasi as $dd)
                    <tr style="text-align:center;">
                        <td>  {{ $loop->iteration }} </td>
                        <td>  {{ $dd->donor->code_name }} </td>
                        <td>  Rp. {{ number_format($dd['donation_amount'],2,',','.') }} </td>
                        <td>  {{ $dd->donation_date }} </td>
                        <td>  {{ $dd->type_account }} </td>
                        <td>  {!! $dd->description !!} </td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <th colspan="2"> Total </th>
                    <th> Rp. {{ number_format($income,2,',','.') }} </th>
                </tfoot>
            </table>
        </table>
        
    </div>

    <script type="text/javascript">
        window.print();
    </script>
</body>
</html>