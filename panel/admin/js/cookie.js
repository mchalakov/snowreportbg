/*! cookie-notice v1.1.18 by Alessandro Benoit, Bernhard Behrendt 2019-01-03 */

! function() {
    "use strict";
    var y, x, C = {
        messageLocales: {
            it: "Utilizziamo i cookie per essere sicuri che tu possa avere la migliore esperienza sul nostro sito. Se continui ad utilizzare questo sito assumiamo che tu ne sia felice.",
            en: "We use cookies to ensure that you have the best experience on our website. If you continue to use this site we assume that you accept this.",
            de: "Wir verwenden Cookies um sicherzustellen, dass Sie das beste Erlebnis auf unserer Website haben.",
            fr: "Nous utilisons des cookies afin d'être sûr que vous pouvez avoir la meilleure expérience sur notre site. Si vous continuez à utiliser ce site, nous supposons que vous acceptez."
        },
        cookieNoticePosition: "bottom",
        learnMoreLinkEnabled: !1,
        learnMoreLinkHref: "/cookie-banner-information.html",
        learnMoreLinkText: {
            it: "Saperne di più",
            en: "Learn more",
            de: "Mehr erfahren",
            fr: "En savoir plus"
        },
        buttonLocales: {
            en: "OK"
        },
        expiresIn: 30,
        buttonBgColor: "#ca5000",
        buttonTextColor: "#fff",
        noticeBgColor: "#000",
        noticeTextColor: "#fff",
        linkColor: "#009fdd",
        linkBgColor: "#000",
        linkTarget: "_blank",
        debug: !1
    };

    function L(e) {
        var t = (navigator.userLanguage || navigator.language).substr(0, 2);
        return e[t] ? e[t] : e.en
    }
    document.addEventListener("DOMContentLoaded", function() {
        y || new cookieNoticeJS
    }), window.cookieNoticeJS = function() {
        if (void 0 === y && (y = this, -1 == document.cookie.indexOf("cookie_notice"))) {
            var t, o = document.querySelector("script[ data-cookie-notice ]");
            try {
                t = o ? JSON.parse(o.getAttribute("data-cookie-notice")) : {}
            } catch (e) {
                console.error("data-cookie-notice JSON error:", o, e), t = {}
            }
            var r = function e(t, o) {
                var i;
                for (i in o) o.hasOwnProperty(i) && ("object" == typeof t[i] ? t[i] = e(t[i], o[i]) : t[i] = o[i]);
                return t
            }(C, arguments[0] || t || {});
            r.debug && console.warn("cookie-notice:", r);
            var e, i, n, a, s, c, l, u = function(e, t, o, i) {
                var n = document.createElement("div"),
                    r = n.style;
                if (n.innerHTML = e + "&nbsp;", n.setAttribute("id", "cookieNotice"), n.setAttribute("data-test-section", "cookie-notice"), n.setAttribute("data-test-transitioning", "false"), r.position = "fixed", "top" === i) {
                    var a = document.querySelector("body");
                    x = a.style.paddingTop, r.top = "0", a.style.paddingTop = "48px"
                } else r.bottom = "0";
                return r.left = "0", r.right = "0", r.background = t, r.color = o, r["z-index"] = "999", r.padding = "10px 5px", r["text-align"] = "center", r["font-size"] = "12px", r["line-height"] = "28px", r.fontFamily = "Helvetica neue, Helvetica, sans-serif", n
            }(L(r.messageLocales), r.noticeBgColor, r.noticeTextColor, r.cookieNoticePosition);
            if (r.learnMoreLinkEnabled) {
                var d = L(r.learnMoreLinkText);
                i = d, n = r.learnMoreLinkHref, a = r.linkTarget, s = r.linkColor, r.linkBgColor, c = document.createElement("a"), l = c.style, c.href = n, c.textContent = i, c.title = i, c.target = a, c.className = "learn-more", c.setAttribute("data-test-action", "learn-more-link"), l.color = s, l.backgroundColor = "transparent", l["text-decoration"] = "underline", l.display = "inline", e = c
            }
            var p, f, b, m, k, g = L(r.buttonLocales),
                v = (p = g, f = r.buttonBgColor, b = r.buttonTextColor, m = document.createElement("span"), k = m.style, m.href = "#", m.innerHTML = p, m.setAttribute("role", "button"), m.className = "confirm", m.setAttribute("data-test-action", "dismiss-cookie-notice"), k.background = f, k.color = b, k["text-decoration"] = "none", k.cursor = "pointer", k.display = "inline-block", k.padding = "0 15px", k.margin = "0 0 0 10px", m);
            v.addEventListener("click", function(e) {
                var t, o, i, n;
                e.preventDefault(), t = 60 * parseInt(r.expiresIn + "", 10) * 1e3 * 60 * 24, o = new Date, (i = new Date).setTime(o.getTime() + t), document.cookie = "cookie_notice=1; expires=" + i.toUTCString() + "; path=/;", (n = u).style.opacity = 1, n.setAttribute("data-test-transitioning", "true"),
                    function e() {
                        if ((n.style.opacity -= .1) < .01) {
                            if (void 0 !== x) {
                                var t = document.querySelector("body");
                                t.style.paddingTop = x
                            }
                            document.body.removeChild(n)
                        } else setTimeout(e, 40)
                    }()
            });
            var h = document.body.appendChild(u);
            e && h.appendChild(e), h.appendChild(v)
        }
    }
}();