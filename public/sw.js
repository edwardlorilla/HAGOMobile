importScripts('/js/cache-polyfill.js') // find it on the internet
importScripts('/js/fetch.js');
importScripts('/js/idb.js');
importScripts('/js/utility.js');
var STATIC_FILES = [
    '/',
    '/manifest.json',
    '/js/app.js',
    '/js/bundle.js',
    '/js/fetch.js',
    '/js/idb.js',
    '/js/utility.js',
    '/css/app.css',
    '/css/bundle.css',
]
var CACHE_STATIC_NAME = 'static-v65';
var CACHE_DYNAMIC_NAME = 'dynamic-v51';
self.addEventListener('install', function (event) {
    console.log('[Service Worker] Installing Service Worker ...', event);
    event.waitUntil(
        caches.open(CACHE_STATIC_NAME)
            .then(function (cache) {
                console.log('[Service Worker] Precaching App Shell');
                cache.addAll(STATIC_FILES);
            })
    )
});

self.addEventListener('activate', function (event) {
    console.log('[Service Worker] Activating Service Worker ....', event);
    event.waitUntil(
        caches.keys()
            .then(function (keyList) {
                return Promise.all(keyList.map(function (key) {
                    if (key !== CACHE_STATIC_NAME && key !== CACHE_DYNAMIC_NAME) {
                        console.log('[Service Worker] Removing old cache.', key);
                        return caches.delete(key);
                    }
                }));
            })
    );
    return self.clients.claim();
});

function isInArray(string, array) {
    var cachePath;
    if (string.indexOf(self.origin) === 0) { // request targets domain where we serve the page from (i.e. NOT a CDN)
        cachePath = string.substring(self.origin.length); // take the part of the URL AFTER the domain (e.g. after localhost:8080)
    } else {
        cachePath = string; // store the full request (for CDNs)
    }
    return array.indexOf(cachePath) > -1;
}
var requestedUrl = null;
self.addEventListener('fetch', function (event) {

    var url = new RegExp('/api/repository\/(.*)').test(event.request.url)

    if ( url && event.request.url.indexOf(event.request.url) > -1) {
        requestedUrl = event.request.url
        event.respondWith(fetch(event.request)
            .then(function (res) {

                var clonedRes = res.clone();
                clearAllData('posts')
                    .then(function () {
                        return clonedRes.json();
                    })
                    .then(function (data) {
                        for (var key in data) {
                            writeData('posts', data[key])
                        }
                    });
                return res;
            })
        );
    }
    else if (isInArray(event.request.url, STATIC_FILES)) {
        event.respondWith(
            caches.match(event.request)
        );
    } else {
        event.respondWith(
            caches.match(event.request)
                .then(function (response) {
                    if (response) {
                        return response;
                    } else {
                        return fetch(event.request)
                            .then(function (res) {
                                return caches.open(CACHE_DYNAMIC_NAME)
                                    .then(function (cache) {
                                        // trimCache(CACHE_DYNAMIC_NAME, 3);
                                        cache.put(event.request.url, res.clone());
                                        return res;
                                    })
                            })
                            .catch(function (err) {
                                return caches.open(CACHE_STATIC_NAME)
                                    .then(function (cache) {
                                        if (event.request.headers.get('accept').includes('text/html')) {
                                            return cache.match('/offline.html');
                                        }
                                    });
                            });
                    }
                })
        );
    }


});
self.addEventListener('sync', function (event) {
    console.log('[Service Worker] Background syncing', event);
    // var token = $('meta[name="csrf-token"]').attr('content')
    if (event.tag === 'sync-new-posts') {
        console.log('[Service Worker] Syncing new Posts');
        event.waitUntil(
            readAllData('sync-posts')
                .then(function (data) {

                    for (var dt of data) {
                        fetch('/api/repository', {
                            method: 'POST',
                            headers: {
                                'X-Requested-With': 'XMLHttpRequest',
                                'Content-Type': 'application/json',
                                'Accept': 'application/json'
                            },
                            body: JSON.stringify({
                                firebase: dt.firebase,
                                id: dt.id,
                                photos: dt.photos,
                                latitude: dt.latitude,
                                colors: dt.color.toString(),
                                longitude: dt.longitude,
                                altitude: dt.altitude,
                                title: dt.title,
                                repository_id: dt.repository_id,
                                description: dt.description
                            })
                        })
                            .then(function (res) {
                                return res.json()
                            })
                            .then(function(data){
                                console.log(data)
                                return writeData('posts', data)
                            })
                            .then(function(){
                                deleteItemFromData('sync-posts', dt.id);
                            })
                            .catch(function (err) {
                                console.log('Error while sending data', err);
                            });
                    }

                })
        );
    }
});