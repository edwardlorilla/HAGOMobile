<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>

    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta name="description"
          content="Collection is intended to catalogue biodiversity and facilitate genomic research."/>
    <meta name="keywords" content="Genomics, Plant sciences"/>
    <meta property="og:type" content="article"/>
    <meta property="og:site_name" content="Nature News &amp; Comment"/>
    <meta property="og:title" content="plant repository"/>
    <meta property="og:description"
          content="Collection is intended to catalogue biodiversity and facilitate genomic research."/>
    <meta property="article:tag" content="Plant sciences"/>
    <meta property="article:section" content="News"/>
    <meta name="access" content="Yes"/>

    <meta name="WT.cg_n" content="Nature News"/>
    <meta name="WT.cg_s" content="News"/>
    <meta name="WT.z_cg_type" content="Nature News"/>
    <link rel="manifest" href="/manifest.json">
    <script  src="https://cdn.rawgit.com/GoogleChrome/pwacompat/v1.0.3/pwacompat.min.js"></script>
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-title" content="HAGO">

    <link rel="apple-touch-icon" sizes="180x180" href="/icons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/icons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="36x36" href="/icons/android-chrome-36x36.png">
    <link rel="icon" type="image/png" sizes="48x48" href="/icons/android-chrome-48x48.png">
    <link rel="icon" type="image/png" sizes="72x72" href="/icons/android-chrome-72x72.png">
    <link rel="icon" type="image/png" sizes="96x96" href="/icons/android-chrome-96x96.png">
    <link rel="icon" type="image/png" sizes="144x144" href="/icons/android-chrome-144x144.png">
    <link rel="icon" type="image/png" sizes="192x192" href="/icons/android-chrome-192x192.png">
    <link rel="icon" type="image/png" sizes="256x256" href="/icons/android-chrome-256x256.png">
    <link rel="icon" type="image/png" sizes="384x384" href="/icons/android-chrome-384x384.png">
    <link rel="icon" type="image/png" sizes="512x512" href="/icons/android-chrome-512x512.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/icons/favicon-16x16.png">

    <meta name="msapplication-TileImage" content="/icons/android-chrome-144x144.png">
    <meta name="msapplication-TileColor" content="#fff">
    <link rel="mask-icon" href="/logo/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="apple-mobile-web-app-title" content="HAGO">
    <meta name="application-name" content="HAGO">
    <meta name="theme-color" content="#2196f3">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <script type="application/ld+json">



    </script>

    <script src="https://cdn.polyfill.io/v2/polyfill.min.js?features=IntersectionObserver"></script>
    <script src='https://www.gstatic.com/firebasejs/4.8.0/firebase.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/blueimp-md5/2.10.0/js/md5.js'></script>
    {!!script_ts("/js/promise.js")  !!}
    {!!script_ts("/js/fetch.js")  !!}
    {!!script_ts("/js/idb.js")  !!}
    {!!script_ts("/js/utility.js")  !!}
    <script type="text/javascript">
        window.Laravel = {csrfToken: '{{ csrf_token() }}'}

        /*new Promise(function(resolve, reject) {
         Notification.requestPermission(function(result) {
         if (result !== 'granted') return reject(Error("Denied notification permission"));
         resolve();
         })
         }).then(function() {
         return navigator.serviceWorker.ready;
         }).then(function(reg) {
         return reg.sync.register('syncTest');
         }).then(function() {
         console.log('Sync registered');
         }).catch(function(err) {
         console.log('It broke');
         console.log(err.message);
         });*/
    </script>

    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <link rel="stylesheet" href="{{ mix('/css/bundle.css') }}"/>
    <link rel="stylesheet" href="{{ mix('/css/app.css') }}"/>
    {{--{!! style_ts(mix('/css/bundle.css')) !!}
    {!! style_ts(mix('/css/app.css')) !!}--}}
    {!! style_ts('https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.2.0/leaflet.css') !!}
    <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/leaflet.markercluster/1.1.0/MarkerCluster.css">
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/leaflet.markercluster/1.1.0/MarkerCluster.Default.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.2.0/leaflet.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet.markercluster/1.1.0/leaflet.markercluster.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB3ki29AJHS78LOsuUmYxBGm_IlXSnL1ow"></script>
    <script src="https://adoroszlai.github.io/leaflet-distance-markers/lib/leaflet.geometryutil.js"></script>
    <script src="https://adoroszlai.github.io/leaflet-distance-markers/leaflet-distance-marker.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/color-thief/2.0.1/color-thief.min.js"></script>

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
    <script type="text/javascript">


        window.currentUser = null;
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>;
        window.allRepositories = null;


    </script>
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

</script>
<script nomodule>
    document.getElementById("app").innerHTML = "Your browser doesn't support JavaScript modules :(";
</script>

</html>