@extends("layouts.layout")
@section("content")
    <div class="checkout_card">
        <div class="items_container">
            @if(count($products)===0)
                <p>You Have No Items In Your Cart</p>
            @else
            @foreach($products as $product)
                <div class="item">
                    <p class="item_info">{{$product->category->name}}  {{$product->Name}}</p>
                    <p class="item_info">{{$product->amount}}</p>
                    <p class="item_info">Size: {{$product->size}}</p>
                    <p class="item_info">{{$product->price*$product->amount}}$</p>
                </div>
            @endforeach
            @endif
        <div class="item-total">
            <p class="item_info">Your Total Is</p>
            <p class="item_info">{{$totalPriceOfCart}}$</p>
        </div>
        </div>
        <form METHOD="POST" ACTION="{{route("order.send", ["products"=>$products])}}" class="payment_container">
            {{csrf_field()}}
            <p>Select A Payment Method</p>
            <div id="icon_container" class="icon_container">
                <label onclick="handlePaymentMethodClick()" for="paypal">
                    <input style="opacity: 0" id="paypal" type="radio" name="payment_method" value="paypal" >
                    <img onclick="" src="{{asset("/res/icon_paypal.svg")}}" alt="paypal">
                </label>
                <label onclick="handlePaymentMethodClick()" for="apple_pay">
                    <input style="opacity: 0" id="apple_pay" type="radio" name="payment_method" value="apple_pay">
                    <img onclick="" src="{{asset("/res/icon_apple.svg")}}" alt="apple_pay">
                </label>
            </div>
            <label for="contact_email">Email:</label>
            <input id="contact_email" type="email" name="contact_email" class="input_text"
                   @if(\Illuminate\Support\Facades\Auth::check())
                   value="{{\Illuminate\Support\Facades\Auth::user()->email}}">
                  @endif

            <label for="contact_number">Phone Number:</label>
            <input id="contact_number" type="text" name="contact_number" class="input_text">
            <label for="order_adress">Delivery Location</label>
            <input placeholder="Address" type="text" name="delivery_address" id="" class="input_text">
            <input placeholder="City, Country" type="text" name="delivery_city_country" class="input_text">
            <input placeholder="postal code" type="number" name="delivery_postal_code" class="input_text">
            <button onclick="sendOrder()" class="input_submit">Confirm</button>
        </form>
    </div>
    <script>
        let contactNumber = $("#contact_number");
        let contactEmail = $("#contact_email");

        function handlePaymentMethodClick(){
            console.log($("input[name='payment_method']:checked").val());
            $("#icon_container").find("img").each(function (){
                if($(this).attr("alt")===$("input[name='payment_method']:checked").val()){
                    $(this).css("opacity",1)
                    return
                }
                $(this).css("opacity",0.5);
            })
        }
        function validateOrderParams(){
            if(paymentMethod==="" || contactEmail.val()==="" || contactNumber.val()===""
                || contactEmail.val()===null || contactNumber.val()===null){
               return false;
            }
            return true;
        }

    </script>
@endsection
