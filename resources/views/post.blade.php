<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Laravel</title>
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">
        <link href="{{ url('vuelaravelcrud/public/css/app.css') }}" type="text/css" rel="stylesheet" />
        <meta name="csrf-token" value="{{ csrf_token() }}" />
        <link href="https://unpkg.com/nprogress@0.2.0/nprogress.css" rel="stylesheet" />
        <script src="https://unpkg.com/nprogress@0.2.0/nprogress.js"></script>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet"/>
    </head>
    <body>
        <div id="app" class="container">
          
        </div>
        <script src="{{ url('vuelaravelcrud/public/js/app.js') }}" type="text/javascript"></script>
    </body>
</html>
<style>
body {
  background-color: linen;
}

h1 {
  color: maroon;
}
.set-width-column {
    width : 30%
}
.set-width-column-action{
    width : 20%
}
</style>
