@extends("layouts.layout")
@section("content")
    <div class="single_product_card">
        <div class="first_product_row">
            <p>{{$singleProduct->category->name}}</p>
            <p>{{$singleProduct->price}}$</p>
        </div>
        <div class="second_product_row">
            <img class="product_image" src="{{asset("/res/mock.jpg")}}" alt="">
            <div class="product_information_permalink">
                <p>{{$singleProduct->Name}}</p>
                <p class="permalink_description">{{$singleProduct->description}}</p>
                <div class="review_container">
                    <img src="{{asset("/res/icon_rating.svg")}}" alt="" class="rating_star">
                    <img src="{{asset("/res/icon_rating.svg")}}" alt="" class="rating_star">
                    <img src="{{asset("/res/icon_rating.svg")}}" alt="" class="rating_star">
                    <img src="{{asset("/res/icon_rating.svg")}}" alt="" class="rating_star">

                </div>
                <p id="available_display">Only {{$totalAvailable}} Left. Available Sizes:</p>
                <div id="size_container" class="size_container">
                   @foreach($singleProduct->availableSizes as $size)
                       <div onclick="handleSizeButtonClick({{json_encode($size)}})" class="shoe_size">
                           {{$size->size}}
                       </div>
                   @endforeach
                </div>
            </div>
        </div>
        <div class="third_product_row">
            <div class="image_nav_container">
                <img  src="{{asset("/res/icon_left.svg")}}" alt="">
                <img  src="{{asset("/res/icon_right.svg")}}" alt="">
            </div>
            <div id="add_to_cart" onclick="displayAmountToAddModule({{json_encode($singleProduct)}})" class="add_to_cart">
                Add To Cart
            </div>
        </div>
    </div>
    <div class="amount_module">
        <img onclick="hideAmountToAddModule()" class="close_button" src="{{asset("/res/close.png")}}"/>
        <form class="amount_form">
            <p>Select Amount To Order</p>
            <p id="available_display_module"></p>
            <input class="input_text" type="number" name="amount" id="amount_input" min="1">
            <input id="submit_amount" type="submit" value="Add To Cart" class="add_to_cart">
        </form>
        <div class="success_message">
            <p>Successfully Added
                <span id="amount_slot"></span>
                <span id="model_slot"></span>, in size:
                <span id="size_slot"></span>
                To Your Cart</p>
            <div class="button_container">
                <button onclick="resetAmountModule()" id="reset_button" class="add_to_cart">Order Another</button>
                <button onclick="window.location='{{route("cart.view")}}'" id="cart_redirect" class="add_to_cart">Go To Checkout</button>
            </div>
        </div>
    </div>
    <script>
        let sizeInFocus = -1;
        let sizeObject = null;
        function setSizeObject(size){
            sizeObject=size;
        }

        function hideAmountToAddModule(){
            $(".amount_module").css("display","none")
        }

        function handleSizeButtonClick(availableSize){
            setSizeObject(availableSize);
            console.log(sizeObject);
            sizeInFocus=availableSize.size;
            $("#available_display").text("Only " + availableSize.available + " Left in size "  +availableSize.size);
            $("#size_container").children().each(function(index, element) {
                $(element).css("opacity", element.textContent==sizeInFocus ? 1:0.5);
            });
        }
        function displayAmountToAddModule(product){
            if(sizeObject===null){
                alert("Please Select A Size")
                return;
            }
            resetAmountModule();
            $(".amount_module").css("display","flex")
            $("#amount_input").attr("max", sizeObject.available)
            $("#available_display_module").text("Available in size " + sizeInFocus+": " + sizeObject.available);

            $("#submit_amount").off("click").on("click",function (e){
                e.preventDefault();
                let amount = $("#amount_input").val()
                console.log(amount);
                if(amount>0 && amount<=sizeObject.available && amount!==null) {
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
                    "amount": amount,
                    "size":sizeInFocus
                },
                success:function(response){
                    console.log(response);
                    if(response.success===true){
                        displaySuccessfullyAddedMessage(product, amount);
                    }
                    if(response.failed===true){
                        alert("You sent a number way to large")
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    // Log the error message
                    console.error("Error:", textStatus, errorThrown);
                    // Log the response text (if available)
                    console.error("Response Text:", jqXHR.responseText);
                }
            })
        }
        function displaySuccessfullyAddedMessage(product, amount){
            $(".amount_form").css("display","none")
            $(".success_message").css("display","flex")

            $("#size_slot").text(sizeInFocus);
            $("#model_slot").text(product.category.name + " " + product.Name);
            $("#amount_slot").text(amount);

        }
        function resetAmountModule(){
            $(".amount_form").css("display","flex")
            $(".success_message").css("display","none")
        }
    </script>
@endsection
