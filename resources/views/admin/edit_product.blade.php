@extends("layouts.admin_layout")
@section("admin_content")
    <div class="form_container">
        <form style="display: flex; flex-flow: column nowrap; align-items: center">
            <h2>Edit Product: Enter The Values You Want To Change</h2>
            {{csrf_field()}}
            <select id="new_brand" name="category_id" class="input_text">
                @foreach($categories as $category)
                    <option  value="{{$category->id}}">{{$category->name}}</option>
                @endforeach
            </select>
            <input placeholder="Product Name" name="Name" id="new_name" type="text" class="input_text">
            <input placeholder="Product Price" name="price" id="new_price" type="number" class="input_text">
            <input placeholder="Product Image" name="image_name" id="new_image" type="file" class="input_text">
            <label for="description">Product Description</label>
            <textarea name="description" id="new_desc"  class="input_message">
            </textarea>
            <input id="new_submit" type="submit" class="input_submit">
        </form>
        <div class="size_forms">
            <form style="display: flex; flex-flow: column nowrap; align-items: center">
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
            <form style="display: flex; flex-flow: column nowrap; align-items: center">
                <h2>Add A Size</h2>
                <input type="number" name="size" id="" class="input_text">
                <input type="number" name="available" id="" class="input_text">
                <input type="submit" class="input_submit" value="submit">
            </form>
        </div>

    </div>

    <script>
        function displayAmountContainer(size){
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

    </script>

@endsection
