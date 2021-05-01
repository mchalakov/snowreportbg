function openNav() {
    document.querySelector(".mobilenewnav").style.height = "100vh";
    document.querySelector('.mobilenewnav').classList.toggle('active');
    document.querySelector('.loadingmobile').classList.toggle('active');
    document.querySelector('#mobileclose').classList.toggle('mobileclose');
    document.querySelector('body').classList.toggle('overflowhidden');
}

function openReport() {
    document.querySelector(".reportnav").style.height = "100vh";
    document.querySelector('.reportnav').classList.toggle('active');
    document.querySelector('.loadingreport').classList.toggle('active');
    document.querySelector('#reportclose').classList.toggle('reportclose');
    document.querySelector('body').classList.toggle('overflowhidden');
}


$(function() {
    $('.loading').hide();

    $(window).on('beforeunload', function() {
        $('.loading').show();
    });
});
var webview = localStorage.getItem('webview');
if (webview == 'enabled');


function mainmenu() {
    document.getElementById('mainmenu').click()
}

function mainmenu2() {
    document.getElementById('mainmenu2').click();
    document.getElementById('menuarr').classList.toggle("active");
}

// FORM 
function enable() {
    var el1 = document.getElementById("submit_form");
    el1.style.display = 'inline-block';
    var el2 = document.getElementById("submit_error");
    el2.style.display = 'none';
    var el3 = document.getElementById("validates");
    el3.style.display = 'none';
    var el4 = document.getElementById("submit_terms");
    el4.style.display = 'inline-block';
}


document.addEventListener('DOMContentLoaded', function() {
    var parallax = document.querySelectorAll('.parallax');
    var instances = M.Parallax.init(parallax);

    var dropdown = document.querySelectorAll('.dropdown-trigger');
    var dropdownIN = M.Dropdown.init(dropdown, {
        hover: false,
        coverTrigger: false,
        constrainWidth: false,
        alignment: 'right'
    });

    var collapsible = document.querySelectorAll('.collapsible');
    var collapsibleIN = M.Collapsible.init(collapsible, {
        accordion: false
    });

    var collapsible2 = document.querySelector('.collapsible.expandable');
    var collapsible2IN = M.Collapsible.init(collapsible2, {
        accordion: true
    });

    var modal = document.querySelectorAll('.modal');
    var modalIN = M.Modal.init(modal, {
        endingTop: '0%',
        opacity: '0.9',
        inDuration: '500',
        outDuration: '500'
    });


    var tabs = document.querySelectorAll('.tabs');
    var tabsIN = M.Tabs.init(tabs);

    var tabsS = document.querySelectorAll('.tabs.swipeable');
    var tabsSIN = M.Tabs.init(tabsS, {
        swipeable: true
    });

    var scrollspy = document.querySelectorAll('.scrollspy');
    var scrollspyIN = M.ScrollSpy.init(scrollspy, {
        scrollOffset: 100
    });

    var actbtn = document.querySelectorAll('.fixed-action-btn');
    var actbtnIN = M.FloatingActionButton.init(actbtn);

    var matrb = document.querySelectorAll('.materialboxed');
    var matrbIN = M.Materialbox.init(matrb);

});


$(document).on('keyup', function(evt) {
    if (evt.keyCode == 27) {
        $('.modal').modal('close');
        location.hash = "";
    }
    if (evt.keyCode == 8) {
        $('.modal').modal('close');
        location.hash = "";
    }
});


function onManageWebPushSubscriptionButtonClicked(event) {
    getSubscriptionState().then(function(state) {
        if (state.isPushEnabled) {
            /* Subscribed, opt them out */
            OneSignal.setSubscription(false);
        } else {
            if (state.isOptedOut) {
                /* Opted out, opt them back in */
                OneSignal.setSubscription(true);
            } else {
                /* Unsubscribed, subscribe them */
                OneSignal.registerForPushNotifications();
            }
        }
    });
    event.preventDefault();
}

function updateMangeWebPushSubscriptionButton(buttonSelector) {
    var hideWhenSubscribed = false;
    var subscribeText = "";
    var unsubscribeText = "";

    getSubscriptionState().then(function(state) {
        var buttonText = !state.isPushEnabled || state.isOptedOut ? subscribeText : unsubscribeText;

        var element = document.querySelector(buttonSelector);
        var element2 = document.getElementById("myCheck");
        if (element === null) {
            return;
        }

        element.removeEventListener('click', onManageWebPushSubscriptionButtonClicked);
        element.addEventListener('click', onManageWebPushSubscriptionButtonClicked);
        element2.innerText = buttonText;

        if (!state.isPushEnabled || state.isOptedOut) {
            document.getElementById("notifyicon1").style.display = "none";
            document.getElementById("notifyicon2").style.display = "block";

        } else {
            document.getElementById("notifyicon1").style.display = "block";
            document.getElementById("notifyicon2").style.display = "none";
        };


        if (state.hideWhenSubscribed && state.isPushEnabled) {
            element.style.display = "none";
        } else {
            element.style.display = "";
        }
    });
}

function getSubscriptionState() {
    return Promise.all([
        OneSignal.isPushNotificationsEnabled(),
        OneSignal.isOptedOut()
    ]).then(function(result) {
        var isPushEnabled = result[0];
        var isOptedOut = result[1];

        return {
            isPushEnabled: isPushEnabled,
            isOptedOut: isOptedOut
        };
    });
}

var OneSignal = OneSignal || [];
var buttonSelector = "#my-notification-button";

/* This example assumes you've already initialized OneSignal */
OneSignal.push(function() {
    // If we're on an unsupported browser, do nothing
    if (!OneSignal.isPushNotificationsSupported()) {
        return;
    }
    updateMangeWebPushSubscriptionButton(buttonSelector);
    OneSignal.on("subscriptionChange", function(isSubscribed) {
        /* If the user's subscription state changes during the page's session, update the button text */
        updateMangeWebPushSubscriptionButton(buttonSelector);
    });
});