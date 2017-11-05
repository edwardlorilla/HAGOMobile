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
    {{--<script src="https://cdnjs.cloudflare.com/ajax/libs/fuse.js/2.6.1/fuse.min.js"></script>--}}
    <title>HAGO</title>
    <style>
        html, body, #map {
            position: absolute;
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
        function e(b, e, f) {
            if (!h)throw Error("textarea-caret-position#getCaretCoordinates should only be called in a browser");
            if (f = f && f.debug || !1) {
                var a = document.querySelector("#input-textarea-caret-position-mirror-div");
                a && a.parentNode.removeChild(a)
            }
            a = document.createElement("div");
            a.id = "input-textarea-caret-position-mirror-div";
            document.body.appendChild(a);
            var c = a.style, d = window.getComputedStyle ? window.getComputedStyle(b) : b.currentStyle, k = "INPUT" === b.nodeName;
            c.whiteSpace = "pre-wrap";
            k || (c.wordWrap =
                    "break-word");
            c.position = "absolute";
            f || (c.visibility = "hidden");
            l.forEach(function (a) {
                k && "lineHeight" === a ? c.lineHeight = d.height : c[a] = d[a]
            });
            m ? b.scrollHeight > parseInt(d.height) && (c.overflowY = "scroll") : c.overflow = "hidden";
            a.textContent = b.value.substring(0, e);
            k && (a.textContent = a.textContent.replace(/\s/g, "\u00a0"));
            var g = document.createElement("span");
            g.textContent = b.value.substring(e) || ".";
            a.appendChild(g);
            b = {
                top: g.offsetTop + parseInt(d.borderTopWidth),
                left: g.offsetLeft + parseInt(d.borderLeftWidth),
                height: parseInt(d.lineHeight)
            };
            f ? g.style.backgroundColor = "#aaa" : document.body.removeChild(a);
            return b
        }

        var l = "direction boxSizing width height overflowX overflowY borderTopWidth borderRightWidth borderBottomWidth borderLeftWidth borderStyle paddingTop paddingRight paddingBottom paddingLeft fontStyle fontVariant fontWeight fontStretch fontSize fontSizeAdjust lineHeight fontFamily textAlign textTransform textIndent textDecoration letterSpacing wordSpacing tabSize MozTabSize".split(" "), h = "undefined" !== typeof window, m = h && null != window.mozInnerScreenX;
        "undefined" != typeof module && "undefined" != typeof module.exports ? module.exports = e : h && (window.getCaretCoordinates = e)
    })();
</script>

</html>