<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Mixon</title>
    <style type="text/css">
        * {
            font-family: DejaVu Sans;
        }

        table {
            font-size: x-small;
        }

        tfoot tr td {
            font-weight: bold;
            font-size: x-small;
        }

        .gray {
            background-color: lightgray
        }
    </style>

</head>
<body>
<table width="100%">
    <tr>
        <td align="left">
            <h3>Mixon</h3>
            <pre>
                {{$user->phone}}
                {{$user->fax}}
                {{$user->email}}
            </pre>
        </td>
        <td>
            <pre>
                {{$user->company}}
                {{$user->country}}
                {{$user->city}}
                {{$user->address}}
            </pre>
        </td>
    </tr>
</table>
<br/>
<table width="100%" style="margin-bottom: 30px;">
    <thead style="background-color: lightgray;">
    <tr>
        <th>ID</th>
        <th>Код товара</th>
        <th>Наименование</th>
        <th>Количество</th>
        <th>Цена</th>
        <th>Вес (брутто)</th>
        <th>Объем</th>
    </tr>
    </thead>
    <tbody>
    @foreach($goods as $good)
        <tr>
            <th>{{$good['id']}}</th>
            <th>{{$good['sku']}}</th>
            <th>{{$good['name']}}</th>
            <th>{{$good['qty']}}</th>
            <th>{{$good['salePrice']}}</th>
            <th>{{$good['weight']}}</th>
            <th>{{$good['volume']}}</th>
        </tr>
    @endforeach
    </tbody>

    <tfoot>
    <tr>
        <td>Общее количество, ед.:</td>
        <td>{{$qty}}</td>
    </tr>
    <tr>
        <td>Cумма(РРЦ) UAH:</td>
        <td>{{$rrp}}</td>
    </tr>
    <tr>
        <td>Ваша стоимость (фактическая стоимость):</td>
        <td>{{$total}}</td>
    </tr>
    <tr>
        <td>Общий вес, кг.:</td>
        <td>{{$weight}}</td>
    </tr>
    <tr>
        <td>Общий объем, м².:</td>
        <td>{{$volume}}</td>
    </tr>
    </tfoot>
</table>

</body>
</html>
