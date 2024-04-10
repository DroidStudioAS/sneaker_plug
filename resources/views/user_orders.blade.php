@extends("layouts.layout")
@section("content")
    @foreach($orders as $order)
        @foreach($order->items as $item)
            <p>{{$item->product}}</p>
        @endforeach
    @endforeach
@endsection
