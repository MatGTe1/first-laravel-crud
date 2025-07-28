<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Id:{{$order->id}}-{{$date}}</title>

    <style>
        body {
            font-family: DejaVu Sans;
        }
        h1, h2 {
            margin-bottom: 10px;
        }

        .section {
            margin-bottom: 30px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        th,
        td {
            border: 1px solid #ccc;
            padding: 8px 10px;
            text-align: left;
        }

        thead {
            background-color: #f0f0f0;
        }
    </style>
</head>


<body>
    @php
    $total=0.0;
    @endphp
    <h1>Invoice</h1>
    <h2>Date: {{ $date }}</h2>

    <div>
        <div>
            <h2>Bill to</h2>
            <p>{{$order->user->name}}</p>
            <p>{{$order->user->address}}</p>
            <p>{{$order->user->email}}</p>
        </div>

        <div>
            <h2>From </h2>
            <p>ExampleCompany</p>
            <p>Warsaw ul. Złota</p>
            <p>example@mail.com</p>
        </div>
    </div>

    <div class="section">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Description</th>
                    <th>QrCode</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($order->products as $product)

                @php
                $qrCode = base64_encode(QrCode::format('svg')->size(100)->errorCorrection('H')->generate("Id zamówienia: {$order->id} | Id produktu: {$product->id}"));
                $total=$total+$product->price;
                @endphp
                <tr>
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->price }}</td>
                    <td>{{ $product->pivot->quantity }}</td>
                    <td>{{ $product->description }}</td>
                    <td><img src="data:image/png;base64, {{ $qrCode }}" alt="QR code"></td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <h2>Total: {{number_format ($total, 2, ',', ' ') }} zł</h2>
    </div>
</body>

</html>