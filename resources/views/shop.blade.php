@extends("layouts/layout")
@section("title") HomePage @endsection

@section("content")
    <div class="search_container">
        <div onclick="toggleSearch()" id="searchToggle" class="search_display">
            Show<br>Filters
        </div>
        <form action="{{route("shop.search")}}" method="GET" class="search_form">
            <label for="category_id">Category</label>
            <select name="category_id" id="category_id" class="input_text">
                @foreach($categories as $category)
                    <option @if(isset($searchParams) && $searchParams["category_id"]==$category->id) selected @endif value="{{$category->id}}">
                        {{$category->name}}
                    </option>
                @endforeach
            </select>
            <label class="Name">Name</label>
            <input type="text" name="Name" id="name_input" class="input_text"
               @if(isset($searchParams))
                    value="{{$searchParams["Name"]}}"
                @endif>
            <label for="amount">Amount</label>
            <input
                type="number"
                name="amount"
                id=""
                class="input_text"
                @if(isset($searchParams))
                    value="{{$searchParams["amount"]}}"
                @endif>
            <label for="price">Price</label>
            <input type="range" name="price" id="slider" class="input_text" min="0" max="1000"
                   @if(isset($searchParams))
                       value="{{$searchParams['price']}}"
                     @endif>
            <span id="quantityDisplay">@if(isset($searchParams) && $searchParams["price"]!==null)
                    {{$searchParams["price"]}}$
                @else 500$
                @endif
            </span>
            <label for="size">Size</label>
            <input type="number" name="size" id="" class="input_text"
                   @if(isset($searchParams))
                       value="{{$searchParams["size"]}}"
                   @endif>
            <input type="submit" class="input_submit">
        </form>
    </div>
    <div class="product_container">
    @foreach($products as $product)
        <div class="product_card">
            <div class="product_content">
                <div class="product_image_container">
                    <img src="{{\App\Helpers\ProductHelper::buildImagePath($product)}}" alt="product_image">
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
    <div class="amount_module">
        <img onclick="hideAmountToAddModule()" class="close_button" src="{{asset("/res/close.png")}}"/>
        <form class="amount_form">
            <p>Available Sizes:</p>
            <div id="size_container" class="size_container">
            </div>
            <p>Select Amount To Order</p>
            <p id="available_display"></p>
            <input class="input_text" type="number" name="amount" id="amount_input" min="1">
            <input id="add_to_cart" type="submit" value="Add To Cart" class="add_to_cart">
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
        let searchClickCount = 0;
        let sizeInFocus = -1;
        let availableAmount = -1;
        let totalAvailable = 0;

        function hideAmountToAddModule(){
            $(".amount_module").css("display","none")
        }

        function handleShoeSizeClick(value){
            //set size in focus to clicked value
            sizeInFocus=value;
            //Loop through all the shoe sizes and set there opacity to 0.5 if not selected
            $("#size_container").children().each(function(index, element) {
                $(element).css("opacity", element.textContent===sizeInFocus ? 1:0.5);
            });
        }
        function displayAmountToAddModule(product, sizes){
            resetAmountModule();
            //reset variables to control value
            sizeInFocus=-1;
            availableAmount=-1
            totalAvailable=0;
            //empty the previous shoe sizes and display the module
            $("#size_container").empty();
            $(".amount_module").css("display","flex")

            console.log(product.available_amount)
            //populate the size_container with the possible sizes
            sizes.forEach(function (item, index){
                let newDiv = $("<div>");
                newDiv.addClass("shoe_size");
                newDiv.text(item.size);
                //add on click listener to display the available amount of each shoe size when in focus
                newDiv.click(function (){
                    $("#available_display").text("Available: " + item.available);
                    availableAmount=item.available;
                    handleShoeSizeClick(newDiv.text());
                });
                totalAvailable+= item.available;
                newDiv.appendTo($("#size_container"));
            })
            $("#amount_input").attr("max", product.available_amount)

            $("#available_display").text("Available: " + totalAvailable);

            $("#add_to_cart").off("click").on("click",function (e){
                e.preventDefault();
                let amount = $("#amount_input").val()
                console.log(sizeInFocus);
                if(sizeInFocus<0){
                    alert("please select a size");
                    return;
                }
                if(amount>0 && amount<=availableAmount && amount!==null) {
                    addToCart(product, amount);
                    return;
                }
                //todo add frontend mechanism to let the user know his request was not sent
                alert("please select an amount that we have available")
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
        let searchForm = $(".search_form");
        function toggleSearch() {
            console.log("hey");
            let right = '-40vw'; // Initially, hide the search container by moving it to the left
            let top= "250px";
            if (searchClickCount % 2 === 0) {
                right = '-20px'; // If it's even click, show the search container by moving it back to the original position
                top="50px";
            }
           searchForm.animate({
                right: right // Animate the right CSS property
            }, 500);

            $("#searchToggle").animate({
                top:top
            },500)
            searchClickCount++;
        }
        $("#slider").on("input", function() {
            // Update the text content of the display span with the current value
            $("#quantityDisplay").text($("#slider").val() + "$");
        });
    </script>
    </script>
@endsection
