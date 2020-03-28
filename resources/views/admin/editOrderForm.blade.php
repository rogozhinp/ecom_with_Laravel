
@extends('layouts.admin')

@section('body')

<h1>Edit Order id: {{$order->id}}</h1>

<div class="table-responsive">


    <form action="{{route('adminUpdateOrder',['id' => $order->id ])}} " method="post">

        {{csrf_field()}}

        <div class="form-group">
            <label for="date">Date</label>
            <input type="date" class="form-control" name="data" id="date" placeholder="Date" value="{{$order->data}}" required>
        </div>


        <div class="form-group">
            <label for="price">Price</label>
            <input type=number step="0.01" class="form-control" name="price" id="price" placeholder="price" value="{{$order->price}}" required>
        </div>

        <div class="form-group">
            <label for="status">Status</label>
            <input type="text" class="form-control" name="status" id="status" placeholder="status" value="{{$order->status}}" required>
        </div>
        <button type="submit" name="submit" class="btn btn-default">Submit</button>
    </form>

</div>



@endsection
