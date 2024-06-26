@extends("layouts.admin_layout")
@section("admin_content")
    <div class="add_container">
        <div onclick="toggleAddProductsForm()" id="add_product" class="input_submit">
            Add Product
        </div>
        <h1>@if(session("message")) {{session("message")}} @endif</h1>
        <form action="{{route("product.add")}}" method="post" class="add_form">
            {{csrf_field()}}
            <select id="new_brand" name="category_id" class="input_text">
                @foreach($categories as $category)
                    <option  value="{{$category->id}}">{{$category->name}}</option>
                @endforeach
            </select>
            <input placeholder="Product Name" name="Name" id="new_name" type="text" class="input_text">
            <input placeholder="Product Amount Available" name="available_amount" id="new_available" type="number" class="input_text">
            <input placeholder="Product Price" name="price" id="new_price" type="number" class="input_text">
            <input placeholder="Product Image" name="image_name" id="new_image" type="text" class="input_text">
            <label for="description">Product Description</label>
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
                        <img src="{{\App\Helpers\ProductHelper::buildImagePath($product)}}" alt="">
                    </div>
                    <div class="product_description">
                        <p>{{$product->description}}</p>
                    </div>
                </div>
                <div class="admin_product_row_sec">
                    <div class="product_info_field">Brand: {{$product->category->name}}</div>
                    <div class="product_info_field">Model: {{$product->Name}}</div>
                    <div class="product_info_field">Sizes: @foreach($product->availableSizes as $size) {{$size->size}}  @endforeach</div>
                    <div class="product_info_field">Available: @foreach($product->availableSizes as $size) {{$size->available}}({{$size->size}})@endforeach</div>
                    <div class="product_info_field">Price: {{$product->price}} $</div>
                    <div class="button_container">
                        <div onclick="pushToEdit({{json_encode($product)}})" class="edit_button">Edit</div>
                        <div onclick="deleteProduct({{json_encode($product)}})" class="delete_button">Delete</div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>


    <script>
        let addProductClickCount = 0;

        function pushToEdit(product){
            if (product!==null){
                window.location="/admin/shop/edit/more/"+product.id
            }
        }

        function displayEditForm(product){
            console.log(product);
            $(".edit_product_popup").css("display","flex");
            $("#edit_brand").val(product.category.id);
            $("#edit_name").val(product.Name);
            $("#edit_available").val(product.available_amount);
            $("#edit_price").val(product.price);
            $("#edit_image").val(product.image_name);
            $("#edit_desc").val(product.description);

            $("#pushToAdvancedEdit").off("click").on("click", function (e){
                e.preventDefault();
                pushToAdvancedEdit(product);
            })

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
                url:"/admin/shop/edit/"+product.id,
                type:"POST",
                data:{
                    "_token": $('meta[name="csrf-token"]').attr('content'),
                    "category_id":$("#edit_brand").val(),
                    "Name":$("#edit_name").val(),
                    "available_amount":$("#edit_available").val(),
                    "price":$("#edit_price").val(),
                    "image_name":$("#edit_image").val(),
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
                url:"/admin/shop/delete/"+product.id,
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
