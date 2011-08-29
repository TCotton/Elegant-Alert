<!DOCTYPE html>
<!--[if IE]><![endif]-->
<html>
<head lang="en-GB">
<meta charset="utf-8" />
<!--[if lt IE 9]>
<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<title>Javascrip testing</title>
<script type="text/javascript" src="http://use.typekit.com/mku7ink.js"></script>
<script type="text/javascript">try{Typekit.load();}catch(e){}</script>
<style>
html, body, div, span, applet, object, iframe, h1, h2, h3, h4, h5, h6, p, blockquote, pre, a, abbr, acronym, address, big, cite, code, del, dfn, em, font, img, ins, kbd, q, s, samp, small, strike, strong, sub, sup, tt, var, b, u, i, center, dl, dt, dd, ol, ul, li, fieldset, form, label, legend, table, caption, tbody, tfoot, thead, tr, th, td, article, aside, canvas, details, figcaption, figure, footer, header, hgroup, menu, nav, section, summary, time, mark, audio, video {
	margin:0;
	padding:0;
	border:0;
	vertical-align:baseline;
	font-size: 100.01%;
	background:transparent;
	-webkit-font-smoothing: antialiased;
	text-rendering: optimizeLegibility;
	image-rendering : -moz-crisp-edges;
	-ms-interpolation-mode: bicubic;
	-webkit-text-size-adjust: 100%;
	-ms-text-size-adjust: 100%;
}
h1, h2, h3, h4, h5, h6, th, td, caption {
	font-weight:normal;
}
article, aside, canvas, details, figcaption, figure, footer, header, hgroup, menu, nav, section, summary, time {
	display:block;
}
blockquote:before, blockquote:after, q:before, q:after {
	content: '';
	content: none;
}

ul {
	list-style-position:inside;
}
textarea {
	resize:vertical;
	overflow: auto;
}
input[type=submit]:hover {
	cursor: pointer
}
body {
	font : 62.5% Georgia, serif;
	background : #EFECCA;
	line-height : 1.8em;
}
#wrapper {
	width : 939px;
	margin : 10px auto;
	padding : 10px;
}
h1 {
	font : 10em mahalia, sans-serif;
	text-align : center;
	margin-bottom : 1em;
	margin-top : 30px;
	color : #002F2F
}
#content {
	width : 40%;
	margin : 0 auto;
}
form label {
	display : none;
}
form input {
	text-align : center;
}
form input[type=text] {
	width : 75%;
	vertical-align : center;
	height : 20px;
	padding : 10px;
	border : 5px solid #A7A37E;
	-moz-border-radius : 10px;
	-webkit-border-radius : 10px;
	border-radius : 10px;
	margin : 20px 0;
}
form input[type=submit] {
	width : 50%;
	background : #E6E2AF;
	border : 5px solid #fff;
	height : 40px;
	-moz-border-radius : 10px;
	-webkit-border-radius : 10px;
	border-radius : 10px;
}
form input[type=submit]:hover {
	background : #ffffff;
	border : 5px solid #E6E2AF;
}
p {
	color : #046380;
	font : 1.3em Georgia, serif;
	margin-bottom : 1.38461538em;
}
.elegant-alertxyz {
	position : absolute;
	left: 0;
	top : 0;
	width : 100%;
	z-index : 100;
	padding : 30px 0 30px 0;
	text-align : center;
	font-size : 30px;
	margin-bottom : 30px;
	font-family : sans-serif;
	background : #fff;
	dislay : none;
}
footer {
	margin-top : 30px;
	clear : both;
	font-size : 1.2em;
	text-align : right;
}
</style>
<script>
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

        }// end for loop
		
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
	
	init: function($data) {
	
	// Place data into data attribute
	NewAlert.data = $data;
	
	// Run alertCheck method
	NewAlert.alertCheck();
	
	}

};



var FormValid = {

    formText: null,

    handleSubmit: function (e) {

        //prevent the default submission process
        e.preventDefault();

        FormValid.formText = FormValid.Form.text.value;
		// declare value for form attribute
		
		// Make sure input field is not empty
		if(FormValid.formText !== "") {

        FormValid.validData(FormValid.formText);
		// run validData method
		
		}

    },

    validData: function (text) {

        // strips out html
        FormValid.formText = text.replace(/(<([^>]+)>)/ig, "");

        FormValid.displayResult(FormValid.formText);
		//run displayResult method

    },

    displayResult: function (response) {

        NewAlert.init(response);
		// run NewAlert object

        NewAlert.time = 75;

    },

    init: function () {
	
        FormValid.Form = document.forms.form;
		// first step sets value for form name

        FormValid.Form.onsubmit = FormValid.handleSubmit;
		// on submit run handeSubmit method

    }

};



function init() {

    FormValid.init();

} // end function init

function AddOnload(myfunc) {

    if (window.addEventListener) {

        window.addEventListener('load', myfunc, false);

    } else if (window.attachEvent) {

        window.attachEvent('onload', myfunc);

    }

}


AddOnload(init);

</script>
</head>
<body>
<div id="wrapper" class="yeah">
  <h1>Elegant Alert</h1>
  <div id="content">
    <p>An alternative to the ugly JavaScript alert</p>
    <p>Tested in all major browsers</p>
    <p>Just add your text to the field below to try it out. <br />
      You know you want to, baby</p>
    <form method="post" action="#" name="form">
      <fieldset>
      <label for="text">Add your text here</label>
      <input type="text" id="text" name="text" placeholder="text" />
      <input type="submit" name="submit" value="submit" />
      </fieldset>
    </form>
  </div>
  <footer> <a href="http://www.suburban-glory.com/blog">An Andy Walpole funkster project</a> <br />
    You can find the code on <a href="https://github.com/TCotton/Elegant-Alert">GitHub</a> </footer>
</div>
</body>
</html>
