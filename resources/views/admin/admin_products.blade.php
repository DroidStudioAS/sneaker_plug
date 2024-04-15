@extends("layouts.admin_layout")
@section("admin_content")
    <div class="add_container">
        <div onclick="pushToAdd()" id="add_product" class="input_submit">
            Add Product
        </div>
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
        function pushToAdd(){
            window.location="{{route('product.form.add')}}"
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
