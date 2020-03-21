<link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet" type="text/css">

@foreach($products as $product)

    <p class="text-center">{{$product->name}}</p>
    <p>{{"$ "}}{{$product->price}}</p>
    <p>{{$product->description}}</p>


@endforeach
