/*global clearInterval: false, clearTimeout: false, document: false, event: false, frames: false, history: false, Image: false, location: false, name: false, navigator: false, Option: false, parent: false, screen: false, setInterval: false, setTimeout: false, window: false, XMLHttpRequest: false, alert: false*/
// top page object class
// branching for window.pageYOffset / document.documentElement.scrollTop
var TopMeasure = (function () {

    var $ie = {
        test: function () {
            return document.documentElement.scrollTop;
        }
    };

    var $nonIE = {
        test: function () {
            return window.pageYOffset;
        }
    };


    if ($nonIE.test() != undefined) {
        return $nonIE;
    } else {
        return $ie;
    }

})();


// function for setting opacity for both IE and non IE

function setOpacity(obj, value) {
    obj.style.opacity = value / 10;
    obj.style.filter = 'alpha(opacity=' + value * 10 + ')';
}

var NewAlert = {
    // this class is to replace the standard javascript alert box
    // declare attributes at the top
    nodeAlert: null,
    stepCount: 0,
    time: 100,
    fade: null,
    data: null,
    run: null,

    alertCheck: function () {

        var $bodyChildren, $len, $x, $first;

        $bodyChildren = document.body.childNodes;

        $x = 0;

        for ($len = $bodyChildren.length; $x < $len; $x += 1) {

            // Checks to make sure that the alert is not run twice until after
            // it has finished 
            if ($bodyChildren[$x].nodeType === 1 && $bodyChildren[$x].className === "elegant-alertxyz") {

                // loops through entire body nodes to make sure class 'elegant-alertxyz' is not already present
                NewAlert.run = 1;
                break;

            }

        } // end for loop
        // if animation is not already running then run method alertWrap
        if (NewAlert.run !== 1) {

            NewAlert.alertWrap();

        }

    },

    // Create error HTML with alertWrap
    alertWrap: function ($value) {

        // create element with class name alert
        // add value of attribute and append to the body
        NewAlert.nodeAlert = document.createElement("div");
        NewAlert.nodeAlert.className = "elegant-alertxyz";
        NewAlert.nodeAlert.innerHTML = NewAlert.data;
        document.body.appendChild(NewAlert.nodeAlert);
        NewAlert.nodeAlert.style.top = TopMeasure.test() + "px";

        NewAlert.alertFade();


    },

    // use alertFade to create the fade out opacity effect
    alertFade: function (value2) {

        // alertWrap method;
        setOpacity(NewAlert.nodeAlert, 10);

        NewAlert.fade = setInterval(function () {

            // Set opacity for non-IE browsers
            NewAlert.nodeAlert.style.opacity = parseFloat(NewAlert.nodeAlert.style.opacity) - parseFloat(0.01);

            //Set opacity for IE browsers
            NewAlert.nodeAlert.style.filter = "alpha(opacity=" + (NewAlert.time - NewAlert.stepCount) + ")";

            NewAlert.stepCount += 1;

            if (NewAlert.stepCount >= NewAlert.time) {

                clearInterval(NewAlert.fade);
                // destroy node after it has finished fading into nothing
                document.body.removeChild(NewAlert.nodeAlert);

                // stepCount attribute needs to be reset back to 0
                NewAlert.stepCount = 0;

                // reset back to null
                NewAlert.run = null;
            }

        }, NewAlert.time);

    },

    init: function ($data) {

        // Place data into data attribute
        NewAlert.data = $data;

        // Run alertCheck method
        NewAlert.alertCheck();

    }

};