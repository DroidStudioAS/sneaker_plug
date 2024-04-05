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
        <div class="payment_container">
            <p>Select A Payment Method</p>
            <div id="icon_container" class="icon_container">
                <img onclick="handlePaymentMethodClick('paypal')" src="{{asset("/res/icon_paypal.svg")}}" alt="paypal">
                <img onclick="handlePaymentMethodClick('apple_pay')" src="{{asset("/res/icon_apple.svg")}}" alt="apple_pay">
            </div>
            <label for="contact_email">Email:</label>
            <input id="contact_email" type="email" name="contact_email" class="input_text"
                   @if(\Illuminate\Support\Facades\Auth::check())
                   value="{{\Illuminate\Support\Facades\Auth::user()->email}}">
                  @endif

            <label for="contact_number">Phone Number:</label>
            <input id="contact_number" type="text" name="contact_number" class="input_text">
            <button onclick="sendOrder()" class="input_submit">Confirm</button>
        </div>
    </div>
    <script>
        let paymentMethod = "";
        let contactNumber = $("#contact_number");
        let contactEmail = $("#contact_email");

        function handlePaymentMethodClick(selectedPaymentMethod){
            paymentMethod=selectedPaymentMethod;
            $("#icon_container").children().each(function (){
                if($(this).attr("alt")===paymentMethod){
                    $(this).css("opacity","1")
                    return;
                }
                $(this).css("opacity","0.5")
            })

            console.log(paymentMethod);
        }
        function validateOrderParams(){
            if(paymentMethod==="" || contactEmail.val()==="" || contactNumber.val()===""
                || contactEmail.val()===null || contactNumber.val()===null){
               return false;
            }
            return true;
        }
        function sendOrder(){
            if(!validateOrderParams()){
                alert("Please Fill Out All The Required Fields")
                return;
            }
           $.ajax({
               url:"",
               type:"POST",
               data:{
                   "token": $('meta[name="csrf-token"]').attr('content'),
                   "payment_method":paymentMethod,
                   "contact_email":contactEmail.val(),
                   "contact_number":contactNumber.val()
               },
               success:function (response){
                   console.log(response);
               }
           })

        }
    </script>
@endsection
