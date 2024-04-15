@extends("layouts.admin_layout")
@section("admin_content")
        <h2>Editing: {{$product->category->name}} {{$product->Name}}</h2>
        @if(session("message_product"))
            <p class="success_response">{{session("message_product")}}</p>
        @endif
        @if(session("message_size"))
            <p class="success_response">{{session("message_size")}}</p>
        @endif
        <div id="toggleContainer" class="toggleContainer">
            <div onclick="displayClickedForm('editProductTrigger')" id="editProductTrigger" class="toggleButton">Edit Product Information</div>
            <div onclick="displayClickedForm('editSizeTrigger')" id="editSizeTrigger" class="toggleButton">Edit Product Sizes</div>
            <div onclick="displayClickedForm('addSizeTrigger')" id="addSizeTrigger" class="toggleButton">Add Product Size</div>
        </div>

        <div id="form_container">
            <form id="editProductForm" class="edit_form" action="{{route("product.edit",["product"=>$product])}}" method="post"
                  enctype="multipart/form-data">
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
                <input name="image_name" id="new_image" type="file" class="input_text">
                <label for="description">Product Description</label>
                <textarea name="description" id="new_desc"  class="input_message">
                {{$product->description}}
            </textarea>
                <input id="new_submit" type="submit" class="input_submit">
            </form>
            <form id="editSizeForm" class="edit_form">
                {{csrf_field()}}
                <p class="success_response" id="editSizeSr"></p>
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

            <form id="addSizeForm" class="edit_form" action="{{route("product.add.size",["product"=>$product])}}" method="post">
                {{csrf_field()}}
                <h2>Add A Size</h2>
                <label for="size">Size</label>
                <input type="number" name="size" id="" class="input_text">
                <label for="available">Available</label>
                <input type="number" name="available" id="" class="input_text">
                <input type="submit" class="input_submit" value="submit">
            </form>
        </div>



    <script>
        let sizeId = -1;
        let sizeInFocus =-1;

        //forms

        function displayClickedForm(key){
            $("#toggleContainer").children().each(function (){
                if($(this).attr("id")===key){
                    $(this).css("opacity",1);
                    return
                }
                $(this).css("opacity",0.5);
            })
            //display the form
            $("#form_container").children().each(function (){
                if($(this).attr("id")===key.replace("Trigger","Form")){
                    $(this).css("display","flex");
                    return;
                }
                $(this).css("display","none")
            })
        }

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
                        $("#editSizeSr").text(response.message);
                    }
                },
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
