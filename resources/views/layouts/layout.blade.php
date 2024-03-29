<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <link rel="stylesheet" href="{{asset("/css/app.css")}}">
    <title>@yield("title", "default")</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>
@include("reusable.navigation")
<div class="content_container">
    @yield("content")
</div>
@include("reusable.footer")
</html>
