@php use App\Models\Order @endphp
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
    @foreach($order->goods as $good)
        <tr>
            <th>{{$good->id}}</th>
            <th>{{$good->sku}}</th>
            <th>{{$good->name}}</th>
            <th>{{$good->pivot->qty}}</th>
            <th>{{$good->pivot->price}}</th>
            <th>{{$good->pivot->weight}}</th>
            <th>{{$good->pivot->volume}}</th>
        </tr>
    @endforeach
    </tbody>

    <tfoot>
    <tr>
        <td>Общее количество, ед.:</td>
        <td>{{$order->qty}}</td>
    </tr>
    <tr>
        <td>Стоимость:</td>
        <td>{{$order->total}}</td>
    </tr>
    <tr>
        <td>Общий вес, кг.:</td>
        <td>{{$order->weight}}</td>
    </tr>
    <tr>
        <td>Общий объем, м².:</td>
        <td>{{$order->volume}}</td>
    </tr>
    <tr>
        <td>Форма расчета:</td>
        <td>{{Order::$billing[$order->billing]}}</td>
    </tr>
    <tr>
        <td>Тип заказа:</td>
        <td>{{Order::$types[$order->type]}}</td>
    </tr>
    </tfoot>
</table>
<p><b>Примечание: </b>{{ $order->comment }}</p>
</body>
</html>
