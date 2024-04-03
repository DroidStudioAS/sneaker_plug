@extends("layouts/layout")
@section("title") HomePage @endsection

@section("content")
    <h1>Featured Models</h1>
    <div class="product_container">


    @foreach($featuredProducts as $product)
        <div class="product_card">
            <div class="product_content">
                <div class="product_image_container">
                    <img src="{{asset("/res/mock.jpg")}}" alt="product_image">
                </div>
                <div class="product_data_short">
                    <p class="product_desc">{{$product->description}}</p>
                    <p>{{$product->price}}$</p>
                </div>
            </div>
            <div class="action_buttons">
                <img onclick="displayAmountToAddModule({{json_encode($product)}})"
                    id="add_to_cart_button" src="{{asset("/res/icon_cart.svg")}}" alt="add to cart" class="action_button">
                <img onclick="window.location='{{route('product.permalink',['product'=>$product->id])}}'"
                    id="more_info_button" src="{{asset("/res/icon_info.svg")}}" alt="more info" class="action_button">
            </div>
        </div>
    @endforeach
    </div>

    <form class="amount_module">
        <img onclick="hideAmountToAddModule()" class="close_button" src="{{asset("/res/close.png")}}"/>
        <p>Select Amount To Order</p>
        <p id="available_display"></p>
        <input class="input_text" type="number" name="amount" id="amount_input" min="1">
        <input type="submit" value="Add To Cart" class="add_to_cart">
    </form>
    <script>
        function hideAmountToAddModule(){
            $(".amount_module").css("display","none")
        }
        function displayAmountToAddModule(product){
            $(".amount_module").css("display","flex")
            $("#available_display").text("Available: " + product.available_amount);
            $("#amount_input").attr("max", product.available_amount)

            $(".add_to_cart").off("click").on("click",function (e){
                e.preventDefault();
                let amount = $("#amount_input").val()
                console.log(amount);
                if(amount>0 && amount<=product.available_amount && amount!==null) {
                    addToCart(product, amount);
                }
            })
        }
        function addToCart(product, amount){
            console.log("trigger");
            $.ajax({
                url:"/cart/add/"+product.id,
                type:"POST",
                data:{
                    "_token": $('meta[name="csrf-token"]').attr('content'),
                    "amount": amount
                },
                success:function(response){
                    console.log(response);
                }
            })
        }
    </script>
@endsection
