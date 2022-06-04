<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Orders</title>
    </head>
    <style type="text/css">
        body{
            font-family: 'Roboto Condensed', sans-serif;
        }
        .m-0{
            margin: 0px;
        }
        .p-0{
            padding: 0px;
        }
        .pt-5{
            padding-top:5px;
        }
        .mt-10{
            margin-top:10px;
        }
        .text-center{
            text-align:center !important;
        }
        .w-100{
            width: 100%;
        }
        .w-50{
            width:50%;   
        }
        .w-85{
            width:85%;   
        }
        .w-15{
            width:15%;   
        }
        .gray-color{
            color:#5D5D5D;
        }
        .text-bold{
            font-weight: bold;
        }
        .border{
            border:1px solid black;
        }
        table tr,th,td{
            border: 1px solid #d2d2d2;
            border-collapse:collapse;
            padding:7px 8px;
        }
        table tr th{
            background: #F4F4F4;
            font-size:15px;
        }
        table tr td{
            font-size:13px;
        }
        table{
            border-collapse:collapse;
        }
        .box-text p{
            line-height:10px;
        }
        .float-left{
            float:left;
        }
        .float-right{
            float:right;
        }
        .total-part{
            font-size:16px;
            line-height:12px;
        }
        .total-right p{
            padding-right:20px;
        }
    </style>
<body>

    <div class="head-title">
        <h3 class="text-center m-0 p-0">Orders report</h3>
    </div>

    <div class="table-section bill-tbl w-100 mt-10">
        <table class="table w-100 mt-10">
            <tr>
                <th class="w-15">Reference</th>
                <th class="w-15">Client</th>
                <th class="w-15">Email</th>
                <th class="w-15">Phone</th>
                <th class="w-15">Total</th>
                <th class="w-15">Payment St.</th>
            </tr>
            @foreach ($data as $order)
                <tr>
                    <td>Reference: <span class="gray-color">{{ $order->reference }}</span></td>
                    <td>Client: <span class="gray-color">{{ $order->customer_name }}</span></td>
                    <td>Email: 
                        <br>
                        <span class="gray-color">{{ $order->customer_email }}</span>
                    </td>
                    <td>Phone: <span class="gray-color">{{ $order->customer_phone }}</span></td>
                    <td>Total: <span class="gray-color">{{ $order->total }}</span></td>
                    <td>Status: <span class="gray-color">{{ $order->status }}</span></td>
                </tr>
            @endforeach
        </table>
    </div>
    <br>
    <h5 class="text-center m-0 p-0">Thanks for use our application.</h5>
<body>
</html>
