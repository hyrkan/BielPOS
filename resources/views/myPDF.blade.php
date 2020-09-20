<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Aloha!</title>
<style type="text/css">
    * {
        font-family: Verdana, Arial, sans-serif;
		margin:0;
    }
    table{
        font-size: x-small;
    }
    tfoot tr td{
        font-weight: bold;
        font-size: x-small;
    }
    .gray {
        background-color: lightgray
    }
	.title{
		margin-top:80px;
		margin-left:85px;
	}
	.order{
		margin-left:20px;
		width:100%;
	}
	.address ,.invoice{
		margin-left:85px;
	}

	.total{
		margin-left:10px;
	}

	p{
		margin-top:15px;
	}

	.order_items{
		padding-left:10px;
	}
	
</style>
</head>
<body>

	<h6 align="right">1/1/2020</h6>
  <table>
    <tr>
        <td align="center">
			<h3 class="title">Samson Store</h3>
			<h3 class="address">Sagay City</h3>
			<h6 class="address">Store no. 00001</h6>
        </td>
    </tr>
  </table>
  <br/>
  <table class="order">
    <thead >
      <tr>
        <th>Product</th>
		<th>Qty</th>
        <th>Price</th>
        <th>Total $</th>
      </tr>
    </thead>
    <tbody>
      @foreach($orders as $order)
		<tr>
			<td class="order_items">{{$order->quantity}}</td>
			<td class="order_items">{{$order->product_name}} {{$order->brand_name}}</td>
			<td class="order_items">{{$order->price}}</td>
			<td class="order_items">{{$order->price}}</td>
		</tr>
	  @endforeach
    </tbody>
  </table>
	<div>
		<p align="center">____________________________</p>
	</div>
</body>
</html>
<tr>
    