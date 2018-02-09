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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.20.1/moment.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment-timezone/0.5.14/moment-timezone.js"></script>
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet.markercluster/1.1.0/MarkerCluster.css">
    <link rel="stylesheet" href="http://turban.github.io/Leaflet.Photo/Leaflet.Photo.css">
    <link rel="stylesheet" href="http://turban.github.io/Leaflet.Photo/examples/css/map.css">
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/leaflet.markercluster/1.1.0/MarkerCluster.Default.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.2.0/leaflet.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet.markercluster/1.1.0/leaflet.markercluster.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB3ki29AJHS78LOsuUmYxBGm_IlXSnL1ow"></script>
    <script src="https://adoroszlai.github.io/leaflet-distance-markers/lib/leaflet.geometryutil.js"></script>
    <script src="https://adoroszlai.github.io/leaflet-distance-markers/leaflet-distance-marker.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/color-thief/2.0.1/color-thief.min.js"></script>
    <script src="http://turban.github.io/Leaflet.Photo/examples/lib/reqwest.min.js"></script>
    <script src="http://turban.github.io/Leaflet.Photo/Leaflet.Photo.js"></script>
    <link rel="stylesheet" href="https://www.domoritz.de/leaflet-locatecontrol/dist/L.Control.Locate.min.css">
    <script src="https://www.domoritz.de/leaflet-locatecontrol/src/L.Control.Locate.js"></script>

    <title>HAGO</title>

    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

    <link href='https://api.tiles.mapbox.com/mapbox.js/plugins/leaflet-fullscreen/v0.0.4/leaflet.fullscreen.css'
          rel='stylesheet'>

    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

    <script type="text/javascript">


        window.currentUser = null;
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>;
        window.allRepositories = null;


    </script>
    <style>

        .logo-area {
            background: #006699;

            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
        }
        .icon-container {
            position: absolute;
            top: 50%;
            left: 50%;
            height: 0;
            width: 0;
        }
        .icon {
            position: absolute;
            top: -128px;
            left: -128px;
            width: 256px;
            height: 256px;
            border-radius: 60px;
            -webkit-box-shadow: inset #1b8bc1 0 1px 1px, rgba(0,0,0,0.2) 1px 1px 2px;
            -moz-box-shadow: inset #1b8bc1 0 1px 1px, rgba(0,0,0,0.2) 1px 1px 2px;
            -ms-box-shadow: inset #1b8bc1 0 1px 1px, rgba(0,0,0,0.2) 1px 1px 2px;
            -o-box-shadow: inset #1b8bc1 0 1px 1px, rgba(0,0,0,0.2) 1px 1px 2px;
            box-shadow: inset #1b8bc1 0 1px 1px, rgba(0,0,0,0.2) 1px 1px 2px;

            background: rgb(62,186,233); /* Old browsers */
            background: -moz-radial-gradient(center, ellipse cover,  rgba(62,186,233,1) 0%, rgba(66,191,236,1) 100%); /* FF3.6+ */
            background: -webkit-gradient(radial, center center, 0px, center center, 100%, color-stop(0%,rgba(62,186,233,1)), color-stop(100%,rgba(66,191,236,1))); /* Chrome,Safari4+ */
            background: -webkit-radial-gradient(center, ellipse cover,  rgba(62,186,233,1) 0%,rgba(66,191,236,1) 100%); /* Chrome10+,Safari5.1+ */
            background: -o-radial-gradient(center, ellipse cover,  rgba(62,186,233,1) 0%,rgba(66,191,236,1) 100%); /* Opera 12+ */
            background: -ms-radial-gradient(center, ellipse cover,  rgba(62,186,233,1) 0%,rgba(66,191,236,1) 100%); /* IE10+ */
            background: radial-gradient(ellipse at center,  rgba(62,186,233,1) 0%,rgba(66,191,236,1) 100%); /* W3C */
            filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#3ebae9', endColorstr='#42bfec',GradientType=1 ); /* IE6-9 fallback on horizontal gradient */

        }
        .inner-circle {
            position: absolute;
            top: 61px;
            left: 61px;
            width: 134px;
            height: 134px;

            -webkit-border-radius: 50% / 50%;
            -moz-border-radius: 50% / 50%;
            -ms-border-radius: 50% / 50%;
            -o-border-radius: 50% / 50%;
            border-radius: 50% / 50%;

            background: rgb(62,186,233); /* Old browsers */
            background: -moz-radial-gradient(center, ellipse cover,  rgba(62,186,233,1) 0%, rgba(66,191,236,1) 100%); /* FF3.6+ */
            background: -webkit-gradient(radial, center center, 0px, center center, 100%, color-stop(0%,rgba(62,186,233,1)), color-stop(100%,rgba(66,191,236,1))); /* Chrome,Safari4+ */
            background: -webkit-radial-gradient(center, ellipse cover,  rgba(62,186,233,1) 0%,rgba(66,191,236,1) 100%); /* Chrome10+,Safari5.1+ */
            background: -o-radial-gradient(center, ellipse cover,  rgba(62,186,233,1) 0%,rgba(66,191,236,1) 100%); /* Opera 12+ */
            background: -ms-radial-gradient(center, ellipse cover,  rgba(62,186,233,1) 0%,rgba(66,191,236,1) 100%); /* IE10+ */
            background: radial-gradient(ellipse at center,  rgba(62,186,233,1) 0%,rgba(66,191,236,1) 100%); /* W3C */
            filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#3ebae9', endColorstr='#42bfec',GradientType=1 ); /* IE6-9 fallback on horizontal gradient */

            -webkit-box-shadow: inset rgba(0,0,0,0.1) 0 1px 1px;
            -moz-box-shadow: inset rgba(0,0,0,0.1) 0 1px 1px;
            -ms-box-shadow: inset rgba(0,0,0,0.1) 0 1px 1px;
            -o-box-shadow: inset rgba(0,0,0,0.1) 0 1px 1px;
            box-shadow: inset rgba(0,0,0,0.1) 0 1px 1px;
        }
        .inner-rim {
            position: absolute;
            top: 55px;
            left: 55px;
            width: 146px;
            height: 146px;

            -webkit-border-radius: 50% / 50%;
            -moz-border-radius: 50% / 50%;
            -ms-border-radius: 50% / 50%;
            -o-border-radius: 50% / 50%;
            border-radius: 50% / 50%;

            background: rgb(233,233,233); /* Old browsers */
            background: -moz-linear-gradient(45deg,  rgba(233,233,233,1) 0%, rgba(241,241,241,1) 50%, rgba(233,233,233,1) 100%); /* FF3.6+ */
            background: -webkit-gradient(linear, left bottom, right top, color-stop(0%,rgba(233,233,233,1)), color-stop(50%,rgba(241,241,241,1)), color-stop(100%,rgba(233,233,233,1))); /* Chrome,Safari4+ */
            background: -webkit-linear-gradient(45deg,  rgba(233,233,233,1) 0%,rgba(241,241,241,1) 50%,rgba(233,233,233,1) 100%); /* Chrome10+,Safari5.1+ */
            background: -o-linear-gradient(45deg,  rgba(233,233,233,1) 0%,rgba(241,241,241,1) 50%,rgba(233,233,233,1) 100%); /* Opera 11.10+ */
            background: -ms-linear-gradient(45deg,  rgba(233,233,233,1) 0%,rgba(241,241,241,1) 50%,rgba(233,233,233,1) 100%); /* IE10+ */
            background: linear-gradient(45deg,  rgba(233,233,233,1) 0%,rgba(241,241,241,1) 50%,rgba(233,233,233,1) 100%); /* W3C */
            filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#e9e9e9', endColorstr='#e9e9e9',GradientType=1 ); /* IE6-9 fallback on horizontal gradient */

        }
        .outer-rim {
            position: absolute;
            top: 48px;
            left: 48px;
            width: 160px;
            height: 160px;

            -webkit-border-radius: 50% / 50%;
            -moz-border-radius: 50% / 50%;
            -ms-border-radius: 50% / 50%;
            -o-border-radius: 50% / 50%;
            border-radius: 50% / 50%;

            background: rgb(233,233,233); /* Old browsers */
            background: -moz-linear-gradient(45deg,  #f9f7f7 0%, #f9fafb 50%, #f9f7f7 100%); /* FF3.6+ */
            background: -webkit-gradient(linear, left bottom, right top, color-stop(0%,#f9f7f7), color-stop(50%,#f9fafb), color-stop(100%,#f9f7f7)); /* Chrome,Safari4+ */
            background: -webkit-linear-gradient(45deg,  #f9f7f7 0%,#f9fafb 50%,#f9f7f7 100%); /* Chrome10+,Safari5.1+ */
            background: -o-linear-gradient(45deg,  #f9f7f7 0%,#f9fafb 50%,#f9f7f7 100%); /* Opera 11.10+ */
            background: -ms-linear-gradient(45deg,  #f9f7f7 0%,#f9fafb 50%,#f9f7f7 100%); /* IE10+ */
            background: linear-gradient(45deg,  #f9f7f7 0%,#f9fafb 50%,#f9f7f7 100%); /* W3C */
            filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#e9e9e9', endColorstr='#e9e9e9',GradientType=1 ); /* IE6-9 fallback on horizontal gradient */

            -webkit-box-shadow: rgba(0,0,0,0.1) 0 0 1px 1px;
            -moz-box-shadow: rgba(0,0,0,0.1) 0 0 1px 1px;
            -ms-box-shadow: rgba(0,0,0,0.1) 0 0 1px 1px;
            -o-box-shadow: rgba(0,0,0,0.1) 0 0 1px 1px;
            box-shadow: rgba(0,0,0,0.1) 0 0 1px 1px;

        }

        .triangle {
            position: absolute;
            width: 0;
            height: 0;
        }

        .big-point.top.one {
            top: 21px;
            left: 106px;
            border-top: transparent 28px solid;
            border-left: transparent 10px solid;
            border-right: #fbfbfb 12px solid;
            border-bottom: transparent 6px solid;
        }
        .big-point.top.two {
            top: 21px;
            left: 128px;
            border-top: transparent 28px solid;
            border-left: #eeeeee 12px solid;
            border-right: transparent 10px solid;
            border-bottom: transparent 6px solid;
        }
        .shadow-point.top.one {
            top: 20px;
            left: 106px;
            border-top: transparent 28px solid;
            border-left: transparent 10px solid;
            border-right: rgba(0,0,0,0.1) 12px solid;
            border-bottom: transparent 6px solid;
        }
        .shadow-point.top.two {
            top: 20px;
            left: 128px;
            border-top: transparent 28px solid;
            border-left: rgba(0,0,0,0.1) 12px solid;
            border-right: transparent 10px solid;
            border-bottom: transparent 6px solid;
        }

        .big-point.bottom.one {
            bottom: 21px;
            left: 106px;
            border-bottom: transparent 28px solid;
            border-left: transparent 10px solid;
            border-right: #fbfbfb 12px solid;
            border-top: transparent 6px solid;
        }
        .big-point.bottom.two {
            bottom: 21px;
            left: 128px;
            border-bottom: transparent 28px solid;
            border-left: #eeeeee 12px solid;
            border-right: transparent 10px solid;
            border-top: transparent 6px solid;
        }
        .shadow-point.bottom.one {
            bottom: 20px;
            left: 106px;
            border-bottom: transparent 28px solid;
            border-left: transparent 10px solid;
            border-right: rgba(0,0,0,0.1) 12px solid;
            border-top: transparent 6px solid;
        }
        .shadow-point.bottom.two {
            bottom: 20px;
            left: 128px;
            border-bottom: transparent 28px solid;
            border-left: rgba(0,0,0,0.1) 12px solid;
            border-right: transparent 10px solid;
            border-top: transparent 6px solid;
        }

        .big-point.left.one {
            left: 21px;
            top: 106px;
            border-left: transparent 28px solid;
            border-top: transparent 10px solid;
            border-bottom: #fbfbfb 12px solid;
            border-right: transparent 6px solid;
        }
        .big-point.left.two {
            left: 21px;
            top: 128px;
            border-left: transparent 28px solid;
            border-top: #eeeeee 12px solid;
            border-bottom: transparent 10px solid;
            border-right: transparent 6px solid;
        }
        .shadow-point.left.one {
            left: 20px;
            top: 106px;
            border-left: transparent 28px solid;
            border-top: transparent 10px solid;
            border-bottom: rgba(0,0,0,0.1) 12px solid;
            border-right: transparent 6px solid;
        }
        .shadow-point.left.two {
            left: 20px;
            top: 128px;
            border-left: transparent 28px solid;
            border-top: rgba(0,0,0,0.1) 12px solid;
            border-bottom: transparent 10px solid;
            border-right: transparent 6px solid;
        }

        .big-point.right.one {
            right: 21px;
            top: 106px;
            border-right: transparent 28px solid;
            border-top: transparent 10px solid;
            border-bottom: #fbfbfb 12px solid;
            border-left: transparent 6px solid;
        }
        .big-point.right.two {
            right: 21px;
            top: 128px;
            border-right: transparent 28px solid;
            border-top: #eeeeee 12px solid;
            border-bottom: transparent 10px solid;
            border-left: transparent 6px solid;
        }
        .shadow-point.right.one {
            right: 20px;
            top: 106px;
            border-right: transparent 28px solid;
            border-top: transparent 10px solid;
            border-bottom: rgba(0,0,0,0.1) 12px solid;
            border-left: transparent 6px solid;
        }
        .shadow-point.right.two {
            right: 20px;
            top: 128px;
            border-right: transparent 28px solid;
            border-top: rgba(0,0,0,0.1) 12px solid;
            border-bottom: transparent 10px solid;
            border-left: transparent 6px solid;
        }

        .small-point.top-left {
            -webkit-transform: rotate(45deg);
            -moz-transform: rotate(45deg);
            -ms-transform: rotate(45deg);
            -o-transform: rotate(45deg);
            transform: rotate(45deg);
        }
        .small-point.top-left.one {
            left: 62px;
            top: 55px;
            border-left: transparent 16px solid;
            border-top: transparent 8px solid;
            border-bottom: #fbfbfb 8px solid;
            border-right: transparent 6px solid;
        }
        .small-point.top-left.two {
            left: 51px;
            top: 66px;
            border-left: transparent 16px solid;
            border-top: #eeeeee 8px solid;
            border-bottom: transparent 8px solid;
            border-right: transparent 6px solid;
        }

        .small-point.top-right {
            -webkit-transform: rotate(-45deg);
            -moz-transform: rotate(-45deg);
            -ms-transform: rotate(-45deg);
            -o-transform: rotate(-45deg);
            transform: rotate(-45deg);
        }
        .small-point.top-right.one {
            right: 62px;
            top: 55px;
            border-right: transparent 16px solid;
            border-top: transparent 8px solid;
            border-bottom: #fbfbfb 8px solid;
            border-left: transparent 6px solid;
        }
        .small-point.top-right.two {
            right: 51px;
            top: 66px;
            border-right: transparent 16px solid;
            border-top: #eeeeee 8px solid;
            border-bottom: transparent 8px solid;
            border-left: transparent 6px solid;
        }

        .small-point.bottom-left {
            -webkit-transform: rotate(135deg);
            -moz-transform: rotate(135deg);
            -ms-transform: rotate(135deg);
            -o-transform: rotate(135deg);
            transform: rotate(135deg);
        }
        .small-point.bottom-left.one {
            left: 62px;
            bottom: 55px;
            border-right: transparent 16px solid;
            border-top: transparent 8px solid;
            border-bottom: #eeeeee 8px solid;
            border-left: transparent 6px solid;
        }
        .small-point.bottom-left.two {
            left: 51px;
            bottom: 66px;
            border-right: transparent 16px solid;
            border-top: #fbfbfb 8px solid;
            border-bottom: transparent 8px solid;
            border-left: transparent 6px solid;
        }

        .small-point.bottom-right {
            -webkit-transform: rotate(-135deg);
            -moz-transform: rotate(-135deg);
            -ms-transform: rotate(-135deg);
            -o-transform: rotate(-135deg);
            transform: rotate(-135deg);
        }
        .small-point.bottom-right.one {
            right: 62px;
            bottom: 55px;
            border-left: transparent 16px solid;
            border-top: transparent 8px solid;
            border-bottom: #fbfbfb 8px solid;
            border-right: transparent 6px solid;
        }
        .small-point.bottom-right.two {
            right: 51px;
            bottom: 66px;
            border-left: transparent 16px solid;
            border-top: #eeeeee 8px solid;
            border-bottom: transparent 8px solid;
            border-right: transparent 6px solid;
        }


        @-webkit-keyframes wheel-spin {
            0% {
                -webkit-transform: rotate(45deg);
            }
            50% {
                -webkit-transform: rotate(-135deg);
            }
            100% {
                -webkit-transform: rotate(-315deg);
            }
        }
        @keyframes wheel-spin {
            0% {
                transform: rotate(45deg);
            }
            50% {
                transform: rotate(-135deg);
            }
            100% {
                transform: rotate(-315deg);
            }
        }

        .spinner {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;

            animation: wheel-spin 1s 2 linear;
            -webkit-animation: wheel-spin 1s 2 linear;

            -webkit-transform: rotate(45deg);
            -moz-transform: rotate(45deg);
            -ms-transform: rotate(45deg);
            -o-transform: rotate(45deg);
            transform: rotate(45deg);
        }

        .arrow.one {
            top: 20px;
            left: 99px;
            border-top: transparent 109px solid;
            border-left: transparent 10px solid;
            border-right: #e46868 19px solid;
            border-bottom: transparent 0px solid;
        }
        .arrow.two {
            top: 20px;
            left: 128px;
            border-top: transparent 109px solid;
            border-left: #ce5d5d 19px solid;
            border-right: transparent 10px solid;
            border-bottom: transparent 0px solid;
        }

        .arrow.three {
            bottom: 20px;
            left: 99px;
            border-top: transparent 0px solid;
            border-left: transparent 10px solid;
            border-right: #f1f1f1 19px solid;
            border-bottom: transparent 109px solid;
        }
        .arrow.four {
            bottom: 20px;
            left: 128px;
            border-top: transparent 0px solid;
            border-left: #d9d9d9 19px solid;
            border-right: transparent 10px solid;
            border-bottom: transparent 109px solid;
        }

        .middle-circle {
            position: absolute;
            top: 118px;
            left: 118px;
            width: 20px;
            height: 20px;

            -webkit-border-radius: 50% / 50%;
            -moz-border-radius: 50% / 50%;
            -ms-border-radius: 50% / 50%;
            -o-border-radius: 50% / 50%;
            border-radius: 50% / 50%;

            background: #FFFFFF;

            -webkit-box-shadow: rgba(0,0,0,0.3) 2px 2px 3px;
            -moz-box-shadow: rgba(0,0,0,0.3) 2px 2px 3px;
            -ms-box-shadow: rgba(0,0,0,0.3) 2px 2px 3px;
            -o-box-shadow: rgba(0,0,0,0.3) 2px 2px 3px;
            box-shadow: rgba(0,0,0,0.3) 2px 2px 3px;
        }


        .first-shadow {
            position: absolute;
            top: 95px;
            left: 130px;
            width: 159px;
            height: 230px;
            background: -moz-linear-gradient(top, rgba(0,0,0,0.1) 0%, rgba(0,0,0,0) 100%);
            background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,rgba(0,0,0,0.1)), color-stop(100%,rgba(0,0,0,0)));
            background: -webkit-linear-gradient(top, rgba(0,0,0,0.1) 0%,rgba(0,0,0,0) 100%);
            background: -o-linear-gradient(top, rgba(0,0,0,0.1) 0%,rgba(0,0,0,0) 100%);
            background: -ms-linear-gradient(top, rgba(0,0,0,0.1) 0%,rgba(0,0,0,0) 100%);
            background: 0.linear-gradient(to bottom, rgba(0,0,0,1) 0%,rgba(0,0,0,0) 100%);
            filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#1a000000', endColorstr='#00000000',GradientType=0 );
            -webkit-transform: rotate(-45deg);
            -moz-transform: rotate(-45deg);
            -ms-transform: rotate(-45deg);
            -o-transform: rotate(-45deg);
            transform: rotate(-45deg);

        }

        @-webkit-keyframes shadow-pulse {
            0% {
                opacity: 0;
            }
            66% {
                opacity: 0;
            }
            100% {
                opacity: 1;
            }
        }
        @keyframes shadow-pulse {
            0% {
                opacity: 0;
            }
            66% {
                opacity: 0;
            }
            100% {
                opacity: 1;
            }
        }

        .second-shadow {
            position: absolute;
            top: 95px;
            left: 104px;
            width: 210px;
            height: 230px;
            background: -moz-linear-gradient(top, rgba(0,0,0,0.1) 0%, rgba(0,0,0,0) 100%);
            background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,rgba(0,0,0,0.1)), color-stop(100%,rgba(0,0,0,0)));
            background: -webkit-linear-gradient(top, rgba(0,0,0,0.1) 0%,rgba(0,0,0,0) 100%);
            background: -o-linear-gradient(top, rgba(0,0,0,0.1) 0%,rgba(0,0,0,0) 100%);
            background: -ms-linear-gradient(top, rgba(0,0,0,0.1) 0%,rgba(0,0,0,0) 100%);
            background: 0.linear-gradient(to bottom, rgba(0,0,0,1) 0%,rgba(0,0,0,0) 100%);
            filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#1a000000', endColorstr='#00000000',GradientType=0 );
            -webkit-transform: rotate(-45deg);
            -moz-transform: rotate(-45deg);
            -ms-transform: rotate(-45deg);
            -o-transform: rotate(-45deg);
            transform: rotate(-45deg);



            animation: shadow-pulse 3s 1 linear;
            -webkit-animation: shadow-pulse 3s 1 linear;

        }


        .inspired {
            position: absolute;
            left: 0;
            right: 0;
            bottom: 0;
            line-height: 30px;
            font-family: sans-serif;
            text-align: center;
            color: #FFF;
        }
        .inspired a {
            color: #FFF;
        }
        .page--full_bg__background {
            background: url('http://adserver.bworldonline.com/webpics/articles/image/20150813fc197.jpg') no-repeat;
            background-size: cover;
            no-repeat center;
            -webkit-filter: blur(5px); /* Safari 6.0 - 9.0 */
            filter: blur(5px);
        }
        .image-icon img {
            height: 36px !important;
            width: 36px !important;
            border-radius: 50%;
            border: solid;
            border-color: green;
        }
    </style>
</head>
<body>

<div id="app">
</div>
</body>
{{--{!! script_ts(mix('/js/bundle.js')) !!}
{!! script_ts(mix('/js/app.js')) !!}--}}
<script type="text/javascript" src="{{mix('/js/bundle.js')}}"></script>
<script type="text/javascript" src="{{mix('/js/app.js')}}"></script>

<script type="text/javascript" src="http://labs.easyblog.it/maps/leaflet-compass/src/leaflet-compass.js"></script>
<script>
    // Thanks: https://github.com/component/textarea-caret-position

</script>
<script nomodule>
    document.getElementById("app").innerHTML = "Your browser doesn't support JavaScript modules :(";
</script>

</html>