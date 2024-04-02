@extends("layouts.admin_layout")
@section("admin_content")
    <div class="add_container">
        <div onclick="toggleAddProductsForm()" id="add_product" class="input_submit">
            Add Product
        </div>
        <h1>@if(session("message")) {{session("message")}} @endif</h1>
        <form action="{{route("add_product")}}" method="post" class="add_form">
            {{csrf_field()}}
            <select id="new_brand" name="category_id" class="input_text">
                @foreach($categories as $category)
                    <option  value="{{$category->id}}">{{$category->name}}</option>
                @endforeach
            </select>
            <input name="Name" id="new_name" type="text" class="input_text">
            <input name="available_amount" id="new_available" type="number" class="input_text">
            <input name="price" id="new_price" type="number" class="input_text">
            <input name="image_name" id="new_image" type="text" class="input_text">
            <textarea name="description" id="new_desc"  class="input_message">
            </textarea>
            <input id="new_submit" type="submit" class="input_submit">
        </form>
    </div>








    <div class="table_container">
        @foreach($products as $product)
            <div class="admin_product_card">
                <div class="admin_product_row_prim">
                    <div class="admin_image_container">
                        <img src="{{asset("/res/mock.jpg")}}" alt="">
                    </div>
                    <div class="product_description">
                        <p>{{$product->description}}</p>
                    </div>
                </div>
                <div class="admin_product_row_sec">
                    <div class="product_info_field">Brand: {{$product->category->name}}</div>
                    <div class="product_info_field">Model: {{$product->Name}}</div>
                    <div class="product_info_field">Available: {{$product->available_amount}}</div>
                    <div class="product_info_field">Price: {{$product->price}} $</div>
                    <div class="button_container">
                        <div onclick="displayEditForm({{json_encode($product)}})" class="edit_button">Edit</div>
                        <div onclick="deleteProduct({{json_encode($product)}})" class="delete_button">Delete</div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="edit_product_popup">
        <img class="close_button" src="{{asset("/res/close.png")}}" alt="close_button" onclick="closeEditPopup()">
        <form class="form">
            {{csrf_field()}}
            <select id="edit_brand" name="brand" class="input_text">
                @foreach($categories as $category)
                    <option  value="{{$category->id}}">{{$category->name}}</option>
                @endforeach
            </select>
            <input id="edit_name" type="text" class="input_text">
            <input id="edit_available" type="number" class="input_text">
            <input id="edit_price" type="number" class="input_text">
            <textarea id="edit_desc"  class="input_message">
        </textarea>
            <input id="edit_submit" type="submit" class="input_submit">
        </form>
    </div>
    <script>
        let addProductClickCount = 0;

        function displayEditForm(product){
            console.log(product);
            $(".edit_product_popup").css("display","flex");
            $("#edit_brand").val(product.category.id);
            $("#edit_name").val(product.Name);
            $("#edit_available").val(product.available_amount);
            $("#edit_price").val(product.price);
            $("#edit_desc").val(product.description);

            $("#edit_submit").off("click").on("click",function (e){
                e.preventDefault();
                editProduct(product);
            })

        }
        function closeEditPopup(){
            $(".edit_product_popup").css("display","none");
        }
        function toggleAddProductsForm(){
            if(addProductClickCount%2===0){
                $(".add_form").slideDown();
                $(".add_form").css("display","flex");
            }else{
                $(".add_form").slideUp();
            }

            addProductClickCount++;
        }

        /*****Async Functions*****/

        function editProduct(product){
            $.ajax({
                url:"admin/edit-product/"+product.id,
                type:"POST",
                data:{
                    "_token": $('meta[name="csrf-token"]').attr('content'),
                    "category_id":$("#edit_brand").val(),
                    "Name":$("#edit_name").val(),
                    "available_amount":$("#edit_available").val(),
                    "price":$("#edit_price").val(),
                    "description":$("#edit_desc").val(),
                },
                success:function(response){
                   if(response.success===true){
                       location.reload();
                   }
                }
            })
        }
        function deleteProduct(product){
            $.ajax({
                url:"admin/delete-product/"+product.id,
                type:"POST",
                data:{
                    "_token": $('meta[name="csrf-token"]').attr('content'),
                },
                success:function (response){
                   if(response.success===true){
                       location.reload();
                   }
                }
            })
        }
    </script>

@endsection
