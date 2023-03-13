/* eversign Polyfill */

if (typeof Object.assign !== "function") {
    // Must be writable: true, enumerable: false, configurable: true
    Object.defineProperty(Object, "assign", {
        value: function assign(target, varArgs) {
            // .length of function is 2
            "use strict";
            if (target === null || target === undefined) {
                throw new TypeError(
                    "Cannot convert undefined or null to object"
                );
            }

            var to = Object(target);

            for (var index = 1; index < arguments.length; index++) {
                var nextSource = arguments[index];

                if (nextSource !== null && nextSource !== undefined) {
                    for (var nextKey in nextSource) {
                        // Avoid bugs when hasOwnProperty is shadowed
                        if (
                            Object.prototype.hasOwnProperty.call(
                                nextSource,
                                nextKey
                            )
                        ) {
                            to[nextKey] = nextSource[nextKey];
                        }
                    }
                }
            }
            return to;
        },
        writable: true,
        configurable: true,
    });
}
/* eversign embedded.js */

var eversign = {

    open: function (params) {

        // parameters
        var iFrameWidth = params.width || 350;
        var iFrameHeight = params.height || 500;

        // callbacks
        params.events = Object.assign({}, params.events);

        // if iOS, add CSS styles to container element that prevent iOS from resizing iFrame
        if (navigator.userAgent.match(/(iPod|iPhone|iPad)/)) {

            var css = document.createElement('style');
            css.type = 'text/css';
            css.innerHTML = '#' + params.containerID + ' { width: ' + iFrameWidth + 'px; height: ' + iFrameHeight + 'px; overflow: hidden;';
            document.body.appendChild(css);

        }

        // add CSS rules vital to mobile scrolling to iFrame container element
        if (iFrameWidth > 800) {
            document.getElementById(params.containerID).style['-webkit-overflow-scrolling'] = 'touch';
            document.getElementById(params.containerID).style['overflow-y'] = 'scroll';
        }

        // create iFrame
        var iFrame = document.createElement('iframe');
        document.getElementById(params.containerID).appendChild(iFrame);

        iFrame.src = params.url;
        iFrame.width = iFrameWidth;
        iFrame.height = iFrameHeight;

        /*
        if (iFrameWidth < 801) {
        iFrame.setAttribute("scrolling", "no");
        }
        */

        // configure postMessage
        var eventMethod = window[(window.addEventListener ? "addEventListener" : "attachEvent")],
            messageEvent = eventMethod === "attachEvent" ? "onmessage" : "message";

        // listen to postMessage from child window
        eventMethod(messageEvent, function (e) {

            var eventType = (e[(e.message ? "message" : "data")]+'').split('_').pop(),
                eventTypes = ['loaded', 'signed', 'declined', 'error'];

            if (eventType && eventTypes.includes(eventType) &&
                params.events.hasOwnProperty(eventType) &&
                typeof params.events[eventType] == 'function') {
                params.events[eventType]();
            }

        }, false);
    },
};