<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <script type="text/javascript">
        /* window.Laravel = {csrfToken: '{{ csrf_token() }}'}
         if ('serviceWorker' in navigator){
         window.addEventListener('load', function () {
         navigator.serviceWorker.register('/sw.js').then(function () {
         console.log('ServiceWorker registration successful.')
         }).catch(function (error) {
         console.log('Service Worker registration failed: ', error)
         })
         })
         }*/
    </script>

    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <link rel="stylesheet" href="{{ mix('/css/bundle.css') }}"/>
    <link rel="stylesheet" href="{{ mix('/css/app.css') }}"/>
    {{--{!! style_ts(mix('/css/bundle.css')) !!}
    {!! style_ts(mix('/css/app.css')) !!}--}}
    {!! style_ts('https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.2.0/leaflet.css') !!}
    <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/leaflet.markercluster/1.1.0/MarkerCluster.css">
    <link rel="stylesheet"
          href="http://cdnjs.cloudflare.com/ajax/libs/leaflet.markercluster/1.1.0/MarkerCluster.Default.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.2.0/leaflet.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet.markercluster/1.1.0/leaflet.markercluster.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB3ki29AJHS78LOsuUmYxBGm_IlXSnL1ow"></script>
    <script src="http://adoroszlai.github.io/leaflet-distance-markers/lib/leaflet.geometryutil.js"></script>
    <script src="http://adoroszlai.github.io/leaflet-distance-markers/leaflet-distance-marker.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/color-thief/2.0.1/color-thief.min.js"></script>
    {{--<script src="https://cdnjs.cloudflare.com/ajax/libs/fuse.js/2.6.1/fuse.min.js"></script>--}}
    <title>HAGO</title>
    <style>
        html, body, #map {
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            font-family: 'Open Sans Condensed', sans-serif;
        }

        body {
            padding: 0;
            margin: 0;
        }
    </style>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link href='https://api.tiles.mapbox.com/mapbox.js/plugins/leaflet-fullscreen/v0.0.4/leaflet.fullscreen.css'
          rel='stylesheet'>
</head>
<body>
<div id="app">

</div>
</body>
{{--{!! script_ts(mix('/js/bundle.js')) !!}
{!! script_ts(mix('/js/app.js')) !!}--}}
<script type="text/javascript" src="{{mix('/js/bundle.js')}}"></script>
<script type="text/javascript" src="{{mix('/js/app.js')}}"></script>
<script>
    // Thanks: https://github.com/component/textarea-caret-position
    (function () {
    })();
</script>

</html>