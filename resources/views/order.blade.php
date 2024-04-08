@extends("layouts.layout")
@section("content")
    @if(isset($message))
        {{$message}}
    @endif
    <p>Order id: {{$newOrder->id}}</p>
    <p>Total Price: {{$newOrder->total_price}}</p>
    <p>Status: {{$newOrder->status}}</p>
@endsection
