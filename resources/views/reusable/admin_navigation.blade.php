<div class="header_container">
    <div class="header_logo">
        <h1>Sneaker Plug Admin</h1>
        <img src="{{asset("res/icon_logo.png")}}"/>
    </div>
    <img
        class="nav_button" src="{{asset("/res/nav/icon_nav.png")}}"/>
    <div class="app_navigation">
        <div class="nav_item">
            <a href="{{route("admin.panel")}}">Messages</a>
        </div>
        <div class="nav_item">
            <a href="{{route("admin.shop")}}">Edit Shop</a>
        </div>
        <div class="nav_item">
            <a href="/">Home</a>
        </div>
    </div>
    <div>
        <h1>The Worlds Best Marketplace For Sneakers</h1>
    </div>
</div>
<script>
    let navContainer = $(".app_navigation");
    let menuClickCount = 0;

    $(".nav_button").on("click", function (){
        let right = 0;
        if(menuClickCount%2 !==0){
            right=-300;
        }
        navContainer.animate({
            position:"fixed",
            right:right
        },500)
        menuClickCount++;
    });




</script>
