@extends("layouts.admin_layout")
@section("admin_content")
    <div class="form_container">
        <form action="{{route("product.edit",["product"=>$product])}}" method="post"
            style="display: flex; flex-flow: column nowrap; align-items: center">
            <h2>Edit Product: Enter The Values You Want To Change</h2>
            {{csrf_field()}}
            <select id="new_brand" name="category_id" class="input_text">
                @foreach($categories as $category)
                    <option @if($category->id===$product->category_id)
                                selected
                            @endif
                            value="{{$category->id}}">{{$category->name}}</option>
                @endforeach
            </select>
            <input value="{{$product->Name}}" placeholder="Product Name" name="Name" id="new_name" type="text" class="input_text">
            <input value="{{$product->price}}" placeholder="Product Price" name="price" id="new_price" type="number" class="input_text">
            <input placeholder="Product Image" name="image_name" id="new_image" type="file" class="input_text">
            <label for="description">Product Description</label>
            <textarea name="description" id="new_desc"  class="input_message">
                {{$product->description}}
            </textarea>
            <input id="new_submit" type="submit" class="input_submit">
        </form>
        <div class="size_forms">
            <form id="editSizeForm"
                style="display: flex; flex-flow: column nowrap; align-items: center">
                {{csrf_field()}}
                <h2>Edit Product Sizes And Stock</h2>
                <h4>Which Sizes Availability Do You Want To Edit</h4>
                <div class="size_container">
                    @foreach($product->availableSizes as $size)
                        <div onclick="displayAmountContainer({{json_encode($size)}})" class="shoe_size">{{$size->size}}</div>
                    @endforeach
                </div>
                <div id="amount_container" class="amount_container">
                    <label for="amount">Amount Available</label>
                    <input type="number" name="amount" id="amount_input" class="input_text">
                    <input type="submit" value="submit" class="input_submit">
                </div>
            </form>

            <form action="{{route("product.add.size",["product"=>$product])}}" method="post"
                style="display: flex; flex-flow: column nowrap; align-items: center">
                {{csrf_field()}}
                <h2>Add A Size</h2>
                <label for="size">Size</label>
                <input type="number" name="size" id="" class="input_text">
                <label for="available">Available</label>
                <input type="number" name="available" id="" class="input_text">
                <input type="submit" class="input_submit" value="submit">
            </form>
        </div>

    </div>

    <script>
        let sizeId = -1;
        let sizeInFocus =-1;

        function displayAmountContainer(size){
            sizeId=size.id;
            sizeInFocus=size.size;
            $(".size_container").children().each(function() {
                console.log($(this).text() + " " + size.size);
                if ($(this).text() == size.size) {
                    $(this).css("opacity", 1);
                    return;
                }
                $(this).css("opacity", 0.5);
            });
            $("#amount_container").css("display","flex");
            $("#amount_input").val(size.available)
        }
        //todo: validate availability
        function editSize(){
            if(sizeId===-1){
                return;
            }
            $.ajax({
                url:"/admin/shop/edit/size/"+sizeId,
                type:"post",
                data:{
                    "_token": $('meta[name="csrf-token"]').attr('content'),
                    "size":sizeInFocus,
                    "available":$("#amount_input").val()
                },
                success:function (response){
                    if(response.success===true){
                        location.reload();
                    }
                }
            })
        }
        $(document).ready(function() {
            $("#editSizeForm").on("submit", function (e){
                e.preventDefault();
                editSize();
            })
        });
    </script>

@endsection
