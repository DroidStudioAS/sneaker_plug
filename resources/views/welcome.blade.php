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
                    <div class="product_name_desc_container">
                        <p class="product_name">{{$product->category->name}} {{$product->Name}}</p>
                        <p class="product_desc">{{$product->description}}</p>
                    </div>

                    <p>{{$product->price}}$</p>
                </div>
            </div>
            <div class="action_buttons">
                <img onclick="displayAmountToAddModule({{json_encode($product)}}, {{json_encode($product->availableSizes)}})"
                    id="add_to_cart_button" src="{{asset("/res/icon_cart.svg")}}" alt="add to cart" class="action_button">
                <img onclick="window.location='{{route('product.permalink',['product'=>$product->id])}}'"
                    id="more_info_button" src="{{asset("/res/icon_info.svg")}}" alt="more info" class="action_button">
            </div>
        </div>
    @endforeach
    </div>

    <form class="amount_module">
        <img onclick="hideAmountToAddModule()" class="close_button" src="{{asset("/res/close.png")}}"/>
        <p>Available Sizes:</p>
        <div id="size_container" class="size_container">
        </div>
        <p>Select Amount To Order</p>
        <p id="available_display"></p>
        <input class="input_text" type="number" name="amount" id="amount_input" min="1">
        <input type="submit" value="Add To Cart" class="add_to_cart">
    </form>
    <script>
        let sizeInFocus = -1;

        function hideAmountToAddModule(){
            $(".amount_module").css("display","none")
        }

        function handleShoeSizeClick(value){
            sizeInFocus=value;
            console.log(sizeInFocus);

            // Loop through the children of a div with id "size_container"
            $("#size_container").children().each(function(index, element) {
               if(element.textContent===sizeInFocus){
                   $(element).css("opacity",1);
                   return;
               }
                   $(element).css("opacity",0.5);

            });
        }
        function displayAmountToAddModule(product, sizes){
            console.log(sizes);
            let totalAvailable=0;
            $("#size_container").empty();
            $(".amount_module").css("display","flex")
            $("#amount_input").attr("max", product.available_amount)
            //populate the size_container with the possible sizes
            sizes.forEach(function (item, index){
                let newDiv = $("<div>");
                newDiv.addClass("shoe_size");
                newDiv.text(item.size);
                newDiv.click(function (){
                    $("#available_display").text("Available: " + item.available);
                    handleShoeSizeClick(newDiv.text());
                });
                totalAvailable+= item.available;
                newDiv.appendTo($("#size_container"));
            })

            $("#available_display").text("Available: " + totalAvailable);

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
