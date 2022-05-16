<!DOCTYPE html>
<html>
<head>
    <title>Invoice</title>
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
    .logo img{
        width:45px;
        height:45px;
        padding-top:30px;
    }
    .logo span{
        margin-left:8px;
        top:19px;
        position: absolute;
        font-weight: bold;
        font-size:25px;
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
    <div class="w-15 logo mt-10">
        <img src="https://icones.pro/wp-content/uploads/2021/06/icone-de-la-boutique-orange.png" alt="">
    </div>
    <h3 class="text-center m-0 p-0">Check your invoice details</h3>
</div>
<div class="add-detail mt-10">
    <div class="w-50 float-left mt-10">
        <p class="m-0 pt-5 text-bold w-100">Invoice reference: <span class="gray-color">{{ $data['order']['reference'] }}</span></p>
        <p class="m-0 pt-5 text-bold w-100">Order Date: <span class="gray-color">{{ $data['order']['created_at'] }}</span></p>
        <p class="m-0 pt-5 text-bold w-100">Total: <span class="gray-color">$ {{ $data['order']['total'] }}</span></p>
    </div>
    <div style="clear: both;"></div>
</div>
<div class="table-section bill-tbl w-100 mt-10">
    <table class="table w-100 mt-10">
        <tr>
            <th class="w-50">Payment information</th>
        </tr>
        <tr>
            <td>
                <div class="box-text">
                    <p>Client: <span class="gray-color">{{ $data['order']['customer_name'] }}</span></p>
                    <p>Email: <span class="gray-color">{{ $data['order']['customer_email'] }}</span></p>
                    <p>Phone: <span class="gray-color">{{ $data['order']['customer_phone'] }}</span></p>
                    <p>Address: <span class="gray-color">{{ $data['order']['customer_address'] }}</span></p>
                </div>
            </td>
        </tr>
    </table>
</div>
<div class="table-section bill-tbl w-100 mt-10">
    <table class="table w-100 mt-10">
        <tr>
            <th class="w-50">Status</th>
            <th class="w-50">Shipping Method</th>
        </tr>
        <tr>
            <td>{{ $data['order']['status'] }}</td>
            <td>Free Shipping</td>
        </tr>
    </table>
</div>
<div class="table-section bill-tbl w-100 mt-10">
    <table class="table w-100 mt-10">
        <tr>
            <th class="w-50">Qty</th>
            <th class="w-50">Product Name</th>
            <th class="w-50">SKU</th>
            <th class="w-50">Price</th>
            <th class="w-50">Subtotal</th>
            <th class="w-50">Total</th>
        </tr>
        @forelse ($data['products'] as $product)
           <tr>
               <td class="w-50">{{ $product['pivot']['quantity'] }}</td>
               <td class="w-50">{{ $product['name'] }}</td>
               <td class="w-50">{{ $product['code'] }}</td>
               <td class="w-50">{{ $product['price'] }}</td>
               <td class="w-50">{{ $product['pivot']['subtotal'] }}</td>
               <td class="w-50">{{ $product['pivot']['subtotal'] }}</td>
           </tr>
        @empty
            <span>ups, dont have products</span>
        @endforelse    
        <tr>
            <td colspan="7">
                <div class="total-part">
                    <div class="total-left w-85 float-left" align="right">
                        <p>Sub Total</p>
                        <p>Total Payable</p>
                    </div>
                    <div class="total-right w-15 float-left text-bold" align="right">
                        <p>{{ $data['order']['total'] }}</p>
                        <p>{{ $data['order']['total'] }}</p>
                    </div>
                    <div style="clear: both;"></div>
                </div> 
            </td>
        </tr>
    </table>
    <h3 class="text-center m-0 p-0">Thanks for shopping with us!</h3>
</div>
</html>