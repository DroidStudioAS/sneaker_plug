@extends("layouts.admin_layout")
@section("admin_content")
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
                        <div class="delete_button">Delete</div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="edit_product_popup">
        <img class="close_button" src="{{asset("/res/close.png")}}" alt="close_button" onclick="closeEditPopup()">
        <form action="" class="form">
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
            <input  id="edit_submit" type="submit" class="input_submit">
        </form>
    </div>
    <script>
        function displayEditForm(product){
            console.log(product);
            $(".edit_product_popup").css("display","flex");
            $("#edit_brand").val(product.category.id);
            $("#edit_name").val(product.Name);
            $("#edit_available").val(product.available_amount);
            $("#edit_price").val(product.price);
            $("#edit_desc").val(product.description);
        }
        function closeEditPopup(){
            $(".edit_product_popup").css("display","none");
        }
    </script>

@endsection
