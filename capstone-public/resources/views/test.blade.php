<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Show Products</title>
</head>
<body>
   @foreach ($product_info as $product) 
   <h2>{{$product["name"]}}</h2>
   <h2>{{$product["stocks"]}}</h2>
   @endforeach

   @foreach ($seller_info as $seller) 
   <h2>{{$seller["name"]}}</h2>
   <h2>{{$seller["age"]}}</h2>
   @endforeach
</body>
</html>