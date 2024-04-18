<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Invoice</title>
    <style>
        #back-wrap {
            margin: 30px auto 0 30px;
            width: 450px;
            display: flex;
            justify-content: flex-end;
        }

        .btn-back {
            width: fit-content;
            padding: 8px 15px;
            color: #fff;
            background: #666;
            border-radius: 5px;
            text-decoration: none;
        }

        #receipt {
            box-shadow: 5px 10px 15px rgba(0, 0, 0, 0.5);
            padding: 20px;
            margin: 30px auto 0 auto;
            width: 500px;
            background: #fff;
        }

        h2 {
            font-size: .9rem;
        }

        p {
            font-size: .8rem;
            color: #666;
            line-height: 1.2rem;
        }

        #top {
            margin-top: 25px;
        }

        #top .info {
            text-align: center;
            margin: 20px 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        td {
            padding: 5px 0 5px 15px;
            border: 1px dolif #eee;
        }

        .tabletitle {
            font-size: .5rem;
            background: #eee;
        }

        .service {
            border-bottom: 1px solid #eee;
        }

        .itemtext {
            font-size: .7rem;
        }

        #legalcopy {
            margin-top: 15px;
        }

        .btn-print {
            float: right;
            color: #333;
        }
    </style>
</head>

<body>
    <div id="back-wrap">
    </div>
    <div id="receipt">
        <center id="top">
            <h2>Cashier</h2>
        </center>
        <div id="mid">
            <div class="info">
                <br>
                Nama Pelanggan : {{ $data['name'] }}</br>
                Alamat Pelanggan : {{ $data['address'] }}</br>
                No HP Pelanggan : {{ $data['phone'] }}</br>
                </p>
            </div>
        </div>
        <div id="bot">
            <div id="table">
                <table>
                    <tr class="tabletitle">
                        <td class="item">
                            <h2>Product Name</h2>
                        </td>
                        <td class="item">
                            <h2>Quantity</h2>
                        </td>
                        <td class="item">
                            <h2>Price</h2>
                        </td>
                        <td class="item">
                            <h2>Subtotal</h2>
                        </td>
                    </tr>
                    @foreach ($detailSale as $item)
                        <tr>
                            <td>{{ $item['name'] }}</td>
                            <td>{{ $item['quantity'] }}</td>
                            <td>Rp {{ $item['price'] }}</td>
                            </td>
                            <td>Rp {{ $item['subtotal'] }}</td>
                            </td>
                        </tr>
                    @endforeach
                    <tr class="tabletitle">
                        <td></td>
                        <td></td>
                        <td>
                            <h2>Total Price</h2>
                        </td>
                        <td>
                            <h2>Rp {{ $totalPrice }}</h2>
                        </td>
                    </tr>
                </table>
            </div>
            <div id="legalcopy">
                <center>
                    <p class="legal"><strong>Thank You!</strong></p>
                </center>
            </div>
        </div>
    </div>
</body>

</html>
