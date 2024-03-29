<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Navigation App</title>
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('/css/home.css') }}">
    </head>
    <body>
        <div>
            <h1 >navigation app</h1>
            <div class="containar">
                <form class="form" action="">
                    @csrf
                    <input type="text" class="box-design" placeholder="current location" id="source">
                    <input type="text" class="box-design box-right" placeholder="destination" id="des">             
                </form> 
                <button class="btn btn-shadow" onclick="showRoute()">Get Direction</button>
            </div>
        </div>
        <div id="map"></div>
        <script src="{{ asset('/js/result.js') }}"></script>
        <script src="{{ asset('/js/route.js') }}"></script>
        <script async defer 
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDebRyC5KKR__t48vDf1D9n6ZdToztsES4&libraries=places&region=en&language=en&callback=initMap"></script>
    </body>
</html>
