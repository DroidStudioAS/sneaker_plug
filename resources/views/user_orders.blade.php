@extends("layouts.layout")
@section("content")
    <div class="user_order_container">
    @foreach($orders as $order)
       <div class="user_order">
                <h2>Order Id: {{$order->id}}</h2>
                <p>Status: {{$order->status}}</p>
                    <div class="user_items_container">
                        <p>Items:</p>
                        @foreach($order->items as $item)
                            {{$item->product->category->name}} {{$item->product->Name}}
                        @endforeach
                    </div>
                    <div class="order_price_container">
                        <p>Total Price: {{$order->total_price}}$</p>
                        <p>Payment Method: {{$order->payment_method}}</p>
                    </div>
           <div class="address_details">
               <p>Delivery Address:</p>
               <p>{{$order->delivery_address}}</p>
               <p>{{$order->delivery_city_country}}</p>
               <p>{{$order->postal_code}}</p>
           </div>

       </div>

    @endforeach
    </div>

@endsection
