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
                        <div class="edit_button">Edit</div>
                        <div class="delete_button">Delete</div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

@endsection
