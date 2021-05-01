var yall = function() {
    "use strict";
    return function(e) {
        var n = (e = e || {}).lazyClass || "lazy",
            o = e.lazyBackgroundClass || "lazy-bg",
            t = "idleLoadTimeout" in e ? e.idleLoadTimeout : 200,
            r = e.observeChanges || !1,
            i = e.events || {},
            a = window,
            s = "requestIdleCallback",
            c = "IntersectionObserver",
            u = ["srcset", "src", "poster"],
            d = [],
            l = function(e, t) {
                return d.slice.call((t || document).querySelectorAll(e || "img." + n + ",video." + n + ",iframe." + n + ",." + o))
            },
            f = function(n) {
                var t, r, i = n.parentNode;
                for (var a in "PICTURE" == i.nodeName && (r = i), "VIDEO" == n.nodeName && (r = n), t = l("source", r)) b(t[a]);
                b(n), n.autoplay && n.load();
                var s = n.classList;
                s.contains(o) && (s.remove(o), s.add(e.lazyBackgroundLoaded || "lazy-bg-loaded"))
            },
            v = function(e) {
                for (var n in i) e.addEventListener(n, i[n].listener || i[n], i[n].options || void 0);
                h.observe(e)
            },
            b = function(e) {
                u.forEach(function(n) {
                    n in e.dataset && a.requestAnimationFrame(function() {
                        e[n] = e.dataset[n]
                    })
                })
            },
            g = l();
        if (/baidu|(?:google|bing|yandex|duckduck)bot/i.test(navigator.userAgent))
            for (var m in g) f(g[m]);
        else if (c in a && c + "Entry" in a) {
            var h = new a[c](function(e, o) {
                e.forEach(function(e) {
                    if (e.intersectionRatio) {
                        var i = e.target;
                        s in a && t ? a[s](function() {
                            f(i)
                        }, {
                            timeout: t
                        }) : f(i), i.classList.remove(n), o.unobserve(i), (g = g.filter(function(e) {
                            return e != i
                        })).length || r || h.disconnect()
                    }
                })
            }, {
                rootMargin: ("threshold" in e ? e.threshold : 200) + "px 0%"
            });
            for (var y in g) v(g[y]);
            r && new MutationObserver(function() {
                l().forEach(function(e) {
                    g.indexOf(e) < 0 && (g.push(e), v(e))
                })
            }).observe(l(e.observeRootSelector || "body")[0], e.mutationObserverOptions || {
                childList: !0,
                subtree: !0
            })
        }
    }
}();