<div class="header_container">
    <div class="header_logo">
        <h1>Sneaker Plug</h1>
        <img src="{{asset("res/icon_logo.png")}}"/>
    </div>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
        @csrf
    </form>
    <img
        class="nav_button" src="{{asset("/res/nav/icon_nav.png")}}"/>
    <div class="app_navigation">
        @if(\Illuminate\Support\Facades\Auth::check())
            <div class="nav_item">
                <a class="dropdown-item" href="{{ route('logout') }}"
                   onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                </a>
            </div>
        @else
            <div class="nav_item">
                <a href="/login">Login/Register</a>
            </div>
        @endif
        <div class="nav_item">
            <a href="/">Home</a>
        </div>
        <div class="nav_item">
            <a href="/contact">Contact</a>
        </div>
        <div class="nav_item">
            <a href="/shop">Shop</a>
        </div>
        <div class="nav_item">
            <a href="/about">About</a>
        </div>
        @if(\App\Models\User::isAdmin())
            <div class="nav_item">
                <a href="/admin">Admin Panel</a>
            </div>
        @endif
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
