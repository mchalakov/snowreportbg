//This is the service worker with the Advanced caching

const CACHE = "version6013";
const offlineFallbackPage = "offline.html";
const precacheFiles = [
    'panel/admin/css/framework.css',
    'panel/admin/css/slider.css',
    'panel/admin/js/jquery.js',
    'offline.html',
    'panel/admin/js/framework.js',
    'panel/admin/js/cookie.js',
    'panel/admin/img/error.svg'
];
const networkFirstPaths = [
    'panel/*',
    'api/*'
];
const avoidCachingPaths = [
    '/bg/*',
    '/en/*',
    'api/*',
    'panel/*',
    'panel/admin/css/core.css',
    'panel/admin/js/init-core.js',
    'fonts.gstatic.com/*',
    'cdn.onesignal.com/*',
    'googletagmanager.com/*',
    'images-webcams.windy.com/*'
];

function pathComparer(requestUrl, pathRegEx) {
    return requestUrl.match(new RegExp(pathRegEx));
}

function comparePaths(requestUrl, pathsArray) {
    if (requestUrl) {
        for (let index = 0; index < pathsArray.length; index++) {
            const pathRegEx = pathsArray[index];
            if (pathComparer(requestUrl, pathRegEx)) {
                return true;
            }
        }
    }

    return false;
}

self.addEventListener("install", function(event) {
    console.log(" Install Event processing");

    console.log("Skip waiting on install");
    self.skipWaiting();

    event.waitUntil(
        caches.open(CACHE).then(function(cache) {
            console.log("Caching pages during install");

            return cache.addAll(precacheFiles).then(function() {
                return cache.add(offlineFallbackPage);
            });
        })
    );
});

// Allow sw to control of current page
self.addEventListener("activate", function(event) {
    console.log("Claiming clients for current page");
    event.waitUntil(self.clients.claim());
});

// If any fetch fails, it will look for the request in the cache and serve it from there first
self.addEventListener("fetch", function(event) {
    if (event.request.method !== "GET") return;

    if (comparePaths(event.request.url, networkFirstPaths)) {
        networkFirstFetch(event);
    } else {
        cacheFirstFetch(event);
    }
});

function cacheFirstFetch(event) {
    event.respondWith(
        fromCache(event.request).then(
            function(response) {
                // The response was found in the cache so we responde with it and update the entry

                // This is where we call the server to get the newest version of the
                // file to use the next time we show view
                event.waitUntil(
                    fetch(event.request).then(function(response) {
                        return updateCache(event.request, response);
                    })
                );

                return response;
            },
            function() {
                // The response was not found in the cache so we look for it on the server
                return fetch(event.request)
                    .then(function(response) {
                        // If request was success, add or update it in the cache
                        event.waitUntil(updateCache(event.request, response.clone()));

                        return response;
                    })
                    .catch(function(error) {
                        // The following validates that the request was for a navigation to a new document
                        if (event.request.destination !== "document" || event.request.mode !== "navigate") {
                            return;
                        }

                        console.log("Network request failed and no cache." + error);
                        // Use the precached offline page as fallback

                        const cache = caches.open(CACHE);
                        const cachedResponse = cache.match(offlineFallbackPage);
                        return cachedResponse;


                    });
            }
        )
    );
}

function networkFirstFetch(event) {
    event.respondWith(
        fetch(event.request)
        .then(function(response) {
            // If request was success, add or update it in the cache
            event.waitUntil(updateCache(event.request, response.clone()));
            return response;
        })
        .catch(function(error) {
            console.log("Network request Failed. Serving content from cache: " + error);
            return fromCache(event.request);
        })
    );
}

function fromCache(request) {
    // Check to see if you have it in the cache
    // Return response
    // If not in the cache, then return error page
    return caches.open(CACHE).then(function(cache) {
        return cache.match(request).then(function(matching) {
            if (!matching || matching.status === 404) {
                return Promise.reject("no-match");
            }

            return matching;
        });
    });
}

function updateCache(request, response) {
    if (!comparePaths(request.url, avoidCachingPaths)) {
        return caches.open(CACHE).then(function(cache) {
            return cache.put(request, response);
        });
    }

    return Promise.resolve();
}