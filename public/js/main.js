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
    sizeInFocus=0;
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
        sizeInFocus+= item.available;
        newDiv.appendTo($("#size_container"));
    })

    $("#available_display").text("Available: " + sizeInFocus);

    $(".add_to_cart").off("click").on("click",function (e){
        e.preventDefault();
        let amount = $("#amount_input").val()
        console.log(amount);
        if(amount>0 && amount<=sizeInFocus && amount!==null) {
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
            "amount": amount,
            "size":sizeInFocus
        },
        success:function(response){
            if(response.success===true){
                console.log("parepare")
            }
        }
    })
}
function displaySuccessfullyAddedMessage(){

}
