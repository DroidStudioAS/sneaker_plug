<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <link rel="stylesheet" href="{{asset("/css/main.css")}}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield("title", "default")</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <!--fonts-->
    <!--Days One for Headers,Dancing Script for Thank You Message Urbanist, For Paragraphs-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400..700&family=Days+One&family=Urbanist:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
</head>
@include("reusable.navigation")
<div class="content_container">
    <div onclick="window.location='{{route("cart.view")}}'" class="checkout_container">
        <img src="{{asset("/res/icon_cart.svg")}}" alt="checkout" class="checkout_button">
        <p class="checkout_text">Checkout</p>
    </div>
    @yield("content")
</div>
@include("reusable.footer")
</html>
