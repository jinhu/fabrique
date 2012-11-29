<?php
include 'Mobile_Detect.php';
$detect = new Mobile_Detect();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" 
"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd"> 

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en"> 
<head>
<title>Fabrique</title> 
<meta http-equiv="Content-Type" content="application/xhtml+xml; charset=UTF-8" /> 
<meta name="description" content="Fabrique Fabrique combines canvas elements, jQuery, and live code editing for a fun, touch-based iterative programming experience." /> 
<meta name="keywords" content="web design, cURL, wordpress, AJAX, designer, domain name, pagerank" /> 
<meta name="author" content="Rio Akasaka" /> 
<meta name="robots" content="all" /> 
<meta name="verify-v1" content="tH+FVPvf706EPYtTv/TB9K64zwha4PL5doYLCitApuY=" /> 
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<meta name="viewport" content="width=device-width, initial-scale=1,user-scalable=no">

<link rel="apple-touch-icon" href="appicon.png" />
<link rel="apple-touch-startup-image" href="startscreen.png">

<!-- jQuery -->
<link rel="stylesheet" href="http://code.jquery.com/ui/1.9.1/themes/base/jquery-ui.css" type="text/css" media="all" />
<link rel="stylesheet" href="http://static.jquery.com/ui/css/demo-docs-theme/ui.theme.css" type="text/css" media="all" />
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script src="http://code.jquery.com/ui/1.9.1/jquery-ui.js" type="text/javascript"></script>
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>

<script type="text/javascript" src="js/jquery.ui.touch-punch.js"></script>

<link rel="stylesheet" type="text/css" href="style.css" />  

<!-- CodeMirror -->
<link rel="stylesheet" href="js/lib/codemirror.css" />
<?php
	    if ($detect->isMobile()) {
	    	?>

<script type="text/javascript" src="js/lib/codemirrorm.js"></script>
<?php
	    } else {
	    ?>
	 <script type="text/javascript" src="js/lib/codemirror.js"></script>
   
	    <?php	
	    	
	    }
	    ?>
<script src="js/mode/javascript/javascript.js"></script>
<script type="text/javascript" src="js/lib/util/searchcursor.js"></script>
<script type="text/javascript" src="js/lib/util/search.js"></script>

<!-- jCanvas -->
<script type="text/javascript" src="js/jcanvas.js"></script>

<!-- Farbtastic -->
<link rel="stylesheet" href="js/farbtastic.css" />
<script type="text/javascript" src="js/farbtastic.js"></script>
<script type="text/javascript" src="js/excanvas.compiled.js"></script>
<script type="text/javascript" src="js/audioContext.js"></script>
</head> 

<body> 
 <div id="header">
	<div class="leftwrapper">
		<a href="index.php"><h1>fabrique<span>alpha</span></h1></a>
	</div>
	<div class="rightwrapper">


	<div class="dataManipulation">
		<input type="button" class="debug hidden" value="debug OFF" />
		<a class="large button gray about">About</a> 
		<a class="large button gray gallery">Gallery</a> 
		
		<input type="button" class="databuttons hidden hideViewData" value="hide data" />
		<input type="button" class="databuttons hidden reloadViewData" value="reload data" />
		<input type="button" class="databuttons hidden exportViewData" value="export data" />

	</div>
	</div>
</div>

<div class="errorsdisplay hidden"></div>
<div class="errorsdisplaytextarea hidden">
<textarea id="errorcode"></textarea>
</div>

<div id="dataViewer"></div>

<div id="aboutViewer" class="hidden sliderviews">
<div>
	<?php include("about.txt"); ?>
</div>
</div>

<div id="galleryViewer" class="hidden sliderviews">
<?php include("gallery.php"); ?>
</div>

<div id="debugViewer" class="hidden"></div>

<div id="saveViewer" class="hidden sliderviews">
<p><strong>Your session id is <form id="session" onSubmit="return false;"><input type="text" class="text" id="sessionid" value="<?php echo $_SESSION['sessionid']; ?>" /></form></strong>Save your workspace by holding on to your session id. Because the application is JavaScript-intensive, the application does not save your work for you.</p><input type="button" class="savedata" value="Save now &raquo;"> <input type="button" class="restoredata" value="Restore &raquo;"> <input type="button" class="sharedata" value="Share &raquo;"><em><span class="sessionstatus"></span></em></p>

</div>


 
  <div id="middle">
  <div class="renderarea">
   <canvas></canvas>
   <div id="elements"></div>
	 <div id="center">
	 	<div id="fig"></div>
	 </div>
   </div>
 </div>
 
  <div id="rightside">
	
	<div id="buttons">
		<div class="icons" id="line"></div>
		<div class="icons" id="text"></div>
		<div class="icons" id="curve"></div>
		<div class="icons" id="circle"></div>
		<div class="icons" id="rectangle"></div>
		<div class="icons" id="polygon"></div>
		<div class="icons" id="box"></div>
		<div id="status">All changes saved</div>
	</div>
	

    
    <form action="" style="width: 400px;">
	  <div class="hidden form-item"><label for="color">Color:</label><input type="text" id="color" name="color" value="#123456" /></div><div id="picker"></div>
	</form>

	<div class="tip hidden">
		
	</div>
	<div class="addDelete hidden">
		<div class="subicons add"></div>
		<div class="subicons delete"></div>
	</div>
	
	<div class="trueFalse hidden">
		<div class="subclasses" id="true">true</div>
		<div class="subclasses" id="false">false</div>
	</div>
	
	<section id="slider2" class="hidden">	
		<span class="tooltip"></span> <!-- Tooltip -->
		<div id="slider"></div> <!-- the Slider -->
		<span class="volume"></span> <!-- Volume -->
	</section>
	
    <textarea id="code" name='code' class="code"><?php if (isset($_GET["f"])) {
		include("scripts/".$_GET["f"].".js");
	} else {
		include("scripts/canvas.js");
	} ?></textarea></p>


	<div id="syntax" class="hidden"></div>

 
 </div>
 <?php if (isset($_GET["f"])) {
    	?>
    	<script type="text/javascript">
    	localStorage.removeItem('code');
    	</script>
    	<?php
 } ?>
 
 <script type="text/javascript" src="js/globalfunctions.js"></script>
<script>
var pianoAdded = false;
var numElements = 0;
$(function() {
	$(".subclasses2").click(function() {
     		hideAll();
     		var line = editor.getLine(currLine.line);
     		var type = $(this).attr("type");
     		var method = $(this).attr("method");
     		if (method == "css") {
	     		if (type == "number") {
	     			typeResult =  10 + " + \"px\"";	
	     		}
	     		if (type == "color") {
	     			typeResult = "\"#000\""; 	
	     		}
	     		if (type == "decimal") {
	     			typeResult = "0.5"; 	
	     		}
	     		if (type == "angle") {
	     			typeResult =  "\"rotate(\" + " + 90 + " + \"deg)\""; 	
	     		}
	     		if (type == "background-image") {
	     			typeResult = "\"-webkit-linear-gradient(top, \"" + " + \"#2F2727\" + " + "\", \"" + " + \"#1a82f7\" + " + "\")\"";	
	     		}
	     		if (type == "choice") {
	     			typeResult = "\"" + $(this).attr("id") + "\"";
	     		}
     		editor.replaceRange("  .css(\"" + $(this).html() + "\", " + typeResult + ")\n", {line:currLine.line+1, ch:0});
     		runCode();
     		} else if (method == "click") {
     			
     			editor.replaceRange("  .click(function() { doSomething })\n", {line:currLine.line+1, ch:0});
     			runCode();
     		} else if (method == "method") {
     			
     			//editor.replaceRange("  .draggable()\n", {line:currLine.line+1, ch:0});
     			//runCode();
     		} else if (method == "action") {
     			
     			editor.setLine(currLine.line, "  .click(function() { playSound(2.00) })\n");
     			//alert(editor.getLine(currLine.line));
     			if (!pianoAdded) {
	     			$.ajax({
				        type: "POST",
				        url: 'getSnippet.php',
				        data: "type=audio",
				        success: function (data) {
				        	pianoAdded = true;
							editor.replaceRange(data, {line:currLine.line+1, ch:0});
							runCode();
				        }
	     			});
     			}
     		}
     		
     		//alert($(this).attr("type"));
     		//alert($(this).attr("id"));
     		
     		
     	});

});

function hideOne() {
	if (opened) {
		$(".toolbar").animate({"top": "+=160px"}, "slow");
		opened = false;
	}
}
function hideTwo() {
	if (opened2) {
		$(".toolbar2").animate({"top": "+=160px"}, "slow");
		opened2 = false;
	}
}
function showOne() {
	 hideTwo();
	 $(".toolbar").css("top", ($( window ).height()) + "px");
     $(".toolbar").show();
     $(".toolbar").animate({"top": "-=160px"}, "slow");
     opened = true;
}
function showTwo() {
	hideOne();
	$(".toolbar2").css("top", ($( window ).height()) + "px");
    $(".toolbar2").show();
   	$(".toolbar2").animate({"top": "-=160px"}, "slow");
   	opened2 = true;
}
var opened = false;
var opened2 = false;
function hideAll() {
	$("#slider2").hide();
	$(".farbtastic").hide();
	$(".tip").hide();
	hideOne();
	hideTwo();

}
 
 if (localStorage.getItem('code')) {
 	$("#code").html(localStorage.getItem('code'));
 }
 
 // Set autoUpdate to be true
 var autoUpdate = 1;
 var dock = 0;
 var hiddenvars = 0;
 var debugOn = 0;
 var textarea = document.getElementById('code');
 var dataTableOpen = 0;
 var aboutOpen = 0;
 var variablesToUse = new Array();
 var variableTypes = new Array();
 var pseudovars = new Array();
 var allslices = new Array();
 // Lookup behavior
 $("#lookup").click(function () {
   var type = editor.selection();
   lookupSyntax(type);
   $("#syntax").slideDown();
   $("#syntax").html("<img src='ajax-loader.gif'>");
 });

 var dragManagement = function (e) {


 };
 String.prototype.startsWith = function (needle) {
   return (this.indexOf(needle) == 0);
 };
 $(".renderarea").click(function () {

 });
 var editor;
 var obj;
 var ignore = false;

 var currLine;
 var prev;
 var blurcalled = false;
 var x = 0;
 var blurManagement = function (e) {
 	console.log("Calling blur");
 	blurcalled = true;
 	ignore = false;
 }
 
 var focusManagement = function (e) {
 	console.log("Calling focus");
 	ignore = true;
 	//$('div.CodeMirror').find('textarea').blur();
 }
var y; 
 // use dec_sep for internationalization
function decimals(x, dec_sep)
{
    var tmp=new String();
    tmp=x;
    if (tmp.indexOf(dec_sep)>-1)
        return tmp.length-tmp.indexOf(dec_sep)-1;
    else
        return 0;
} 
function makeDraggable() {
  for (var i = 0; i < numElements; i++) {
    eval("element" + (i)).attr("id", i);
    eval("element" + (i)).draggable({
      drag: function (event, ui) {
        var id = $(this).attr("id");
        topLine = findLine("element" + id, ".css(\"top\"");
        leftLine = findLine("element" + id, ".css(\"left\"");
        editor.setLine(topLine, "  .css(\"top\", " + $(this).css("top").replace("px", "") + " + \"px\")");
        editor.setLine(leftLine, "  .css(\"left\", " + $(this).css("left").replace("px", "") + " + \"px\")");


        console.log($(this).attr("id"));
        console.log($(this).css("top"));
        console.log($(this).css("left"));

      }
    });
  }
}

 var autocompleteManagement = function (e) {
   console.log("Calling autocomplete");
   if (!ignore) {

   	console.log("Inside logic");
   var si = editor.getScrollInfo();
   //console.log(si.y);
   currLine = editor.getCursor(true);

   var toffset = ((currLine.line + 2)* editor.defaultTextHeight()) - si.y;
   //console.log(toffset);
   
   //console.log(currLine);
   obj = editor.getTokenAt(currLine);
 
   indented = editor.getLineHandle(currLine.line)['stateAfter']['indented'];
   console.log(editor.getLineHandle(currLine.line));
   //indententation());
   console.log(indented);
   console.log(obj.start);
   console.log(obj.end);
   var loffset = (((obj.start + obj.end) / 2)) * 7.5 - si.x;
   //console.log(obj);
   
   if (obj.className == null) {
     hideAll();
   }
   
   // Is it a do Something?
   if (obj.className == "trigger") {
   		showTwo();
   }
   // Is it a boolean?
   if (obj.className == "binary") {
   	$(".tip").css("margin-top", toffset + 30 + "px");
     $(".tip").css("margin-left", loffset + "px");
     $(".tip").html($(".trueFalse").html());
     $("#slider2").hide();
     $(".tip").show();
     $(".farbtastic").hide();
      var newstring = "true";
   	 var line = editor.getLine(currLine.line);
     if (obj.string == "true") {
		var newstring = "false";
     } 
     $("#true").click(function() {
     	editor.replaceRange(newstring, {
         line: currLine.line,
         ch: obj.start
       }, {
         line: currLine.line,
         ch: obj.end
       });
    
     });
     $("#false").click(function() {
     	editor.replaceRange(newstring, {
         line: currLine.line,
         ch: obj.start
       }, {
         line: currLine.line,
         ch: obj.end
       });
    
     });
     runCode();
	
     
   	
   } 

    // Is it a font color?
   if (obj.className == "string" && obj.string.startsWith("\"#")) {
     $("#picker").unbind();
     $('#picker').farbtastic(function (e) {
    
       //console.log(e);
       //console.log(currLine);
       //console.log(obj);
       editor.replaceRange("\"" + e + "\"", {
         line: currLine.line,
         ch: obj.start
       }, {
         line: currLine.line,
         ch: obj.end
       });
       runCode();
     });
     //console.log(obj.string);
     $.farbtastic("#picker").setColor(obj.string.replace(/\"/g, ""));
     $(".farbtastic").css("margin-top", toffset + 30 + "px");
     $(".farbtastic").css("margin-left", loffset + "px");
     $("#slider2").hide();
     $(".tip").hide();
     $(".farbtastic").show();

   }
   
   // Is it a generic property?
   if (obj.className == "property") {
     $(".tip").css("margin-top", toffset + 30 + "px");
     $(".tip").css("margin-left", loffset + "px");
     $(".tip").html($(".addDelete").html());
     $("#slider2").hide();
     $(".tip").show();
     console.log("Result");
     //var x = editor.getSearchCursor("});", currLine).findNext();
     y = editor.getSearchCursor("});", currLine);
     y.findNext();
     console.log(y.pos.from.line);
     $(".farbtastic").hide();
     $(".delete").click(function() {
     	editor.removeLine(currLine.line);
     });
     $(".add").unbind();
     
     $(".add").click(function() {
     	showOne();
     });
     runCode();
   }
   
   // Is it a number?
   if (obj.className == "number") {
   	if ($("#slider").is(':visible') && obj.start == prev) {
		
	} else {
		min = 0;
		prev = obj.start;
		val = parseInt(obj.string);
		max = val * 2;
		step = 1

		numDecimals = decimals(obj.string, ".");
		if (obj.string.indexOf(".") !== -1) {
			val = parseFloat(obj.string);
			if (numDecimals == 1) {
				step = 0.1;
			} else if (numDecimals == 2) {
				step = 0.01;	
			}
			max = val * 2;
		} else if (obj.string == "0") {
			min = -10;
			max = 10;
		}

     $("#slider").slider({
       min: min,
       max: max,
       value: val,
       step: step,
       //slide: function (event, ui) {
       //},
       slide: function (event, ui) {

         editor.replaceRange(ui.value.toString(), {
           line: currLine.line,
           ch: obj.start
         }, {
           line: currLine.line,
           ch: obj.end
         });
         runCode();
       }
     });
     $("#slider").slider("value", val);
	}

     $("#slider2").css("margin-top", toffset + 25 + "px");
     $("#slider2").css("margin-left", loffset - 10 + "px");
     $("#slider2").show();
     $(".tip").hide();
     $(".farbtastic").hide();
  
   }
   runCode();
   } 

 };

      editor = CodeMirror.fromTextArea(document.getElementById("code"), {
      	lineNumbers: true,
      	onCursorActivity: autocompleteManagement,
	    onChange: function() {
	    	changed = true;	
	    },
	    <?php
	    if ($detect->isMobile()) {
	    	?>
	    readOnly: "nocursor", 
	    <?php } ?>
        onBlur: blurManagement,
        onFocus: function() {
        	console.log("Focused");
        	ignore = false;
        }
      });
      editor.setSize(500, 550);

      runCode();
      
      // Some extra stuff to do after the vis has been rendered
 function runPostCode() {
	makeDraggable();
 }
 // When you change a curated set
 $('#selector').change(function () {
   $("#url").val($('#selector').val());
   $("#datatype").html($("#selector option:selected").text());
 });

 
 // Clear the data 
 $("#clear").click(function () {
   $(".short").replaceWith("<input type='file' class='short' name='fileToUpload' id='fileToUpload' />");
 });
 
 $(".restoredata").click(function () {
   var sid = $("#sessionid").val();
   $.ajax({
     type: "POST",
     url: 'doSession.php',
     data: "type=restore&id=" + sid,
     success: function (data) {
       $(".sessionstatus").html(data).show();
       $(".sessionstatus").effect('highlight', null, 500, function () {
         $(this).fadeOut();
         $("#saveViewer").slideUp();
       });
     }
   });

   url = "restoreSession.php";
   $.getScript(url, function () {

   });
   $.ajax({
     type: "POST",
     url: 'saveCode.php',
     data: "type=restore",
     success: function (data) {
       editor.setCode(data);
     }
   });
 });

 
 $(".savedata").click(function () {

   saveAll();
 });

 $(".sharedata").click(function () {

   $(this).before("Give it a name: <input id='sharename' name='name' value='' type='text' /> <input id='makepublic' name='makepublic' type='checkbox'> Add to gallery? <input id='makedatapublic' name='makedatapublic' type='checkbox'> Make data publicly viewable? ");
   $(this).val("Finish sharing!");

   $(this).unbind();
   $(this).bind("click", function () {
     saveShare();
   });
   $(this).removeClass("sharedata");
   $(this).addClass("smooth");

 });

 $(".finishshare").click(function () {

   saveShare();

 });

 temp = 0;
 visible = "";

 // Toggle debug viewer
 $(".debug").click(function () {
   if (debugOn) {
     debugOn = 0;
     $(this).val("debug OFF");
     $("#debugViewer").hide();
   } else {
     debugOn = 1;
     $(this).val("debug ON");
     $("#debugViewer").show();
   }
 });

 $(".about").click(function () {
   if (visible != "about") {
     $(".sliderviews").slideUp();
     $("#aboutViewer").slideDown();
     visible = "about";
   } else {
     $("#aboutViewer").slideUp();
     visible = "";
   }
 });

 $(".gallery").click(function () {

   if (visible != "gallery") {
     $(".sliderviews").slideUp();
     $("#galleryViewer").slideDown();
     visible = "gallery";
   } else {
     $("#galleryViewer").slideUp();
     visible = "";
   }
 });

 $(".save").click(function () {
   if (visible != "save") {
     $(".sliderviews").slideUp();
     $("#saveViewer").slideDown();
     visible = "save";
   } else {
     $("#saveViewer").slideUp();
     visible = "";
   }
 });

 
 // Reload the data
 $("#view, .reloadViewData").click(function () {
   dataTableOpen = 0;
   viewData();
 });


 // Hide the data
 $(".hideViewData").click(function () {
   $("#dataViewer").animate({
     height: "0px"
   });
   dataTableOpen = 0;
   $(".databuttons").fadeOut();
 });


 // Sets the user session

 $("#session").submit(function () {
   setSession($("#sessionid").val());
   return false;
 });

function findLine(startQuery, endQuery) {
	console.log("Looking for " + startQuery);
	y = editor.setCursor({
         line: 0,
         ch: 0
 	});
    y = editor.getSearchCursor(startQuery, {line:0, ch:0});
    y.findNext();
    var start = y.pos.from.line;
	console.log("starting point", start);
	y = editor.getSearchCursor(endQuery, {line:start, ch:0});
	y.findNext();
	var end = y.pos.from.line;
	console.log("ending point", end);
	return end;
}
 

 // Render the suggestions
 $(".clickable").click(function () {
   var type = $(this).find("img").attr("id");

   if (type == "choropleth") {
     $(".map").show();
   }

   var name = $(this).find("img").attr("alt");
   getContent(type, name);
 });
 



 // Load the snippets
 $(".icons").click(function () {
    var codeid = $(this).attr("id");

    $.ajax({
        type: "POST",
        url: 'getSnippet.php',
        data: "type=" + codeid,
        success: function (data) {
        	if (codeid == "box") {
            y = editor.setCursor({
                line: 0,
                ch: 0
            });
            y = editor.getSearchCursor("$(\"#elements\")", currLine);
            y.findNext();
            var start = y.pos.from.line;
            console.log("Found start elements at" + start);
            y = editor.getSearchCursor(";", {
                line: start,
                ch: 0
            });
            console.log(y);
            if (y.findNext()) {
                var end = y.pos.from.line;
                console.log("Found end elements at" + end);
                editor.replaceRange("", {
                    line: start,
                    ch: 0
                }, {
                    line: end+1,
                    ch: 0
                });
            }
        	}
            var content = editor.getValue();
            if (codeid == "box") {
            	data = data.replace("X", numElements);
            }
            content += data;


            if (codeid == "box") {
            	
                numElements++;


                var result = "\n\n$(\"#elements\")";
                for (var i = 0; i < numElements; i++) {
                    result += "\n.append(element" + i + ")";
                }
                result += ";\n"
                //editor.setLine(y.pos.from.line, result);
                content += result;
                
            }
            editor.setValue(content);
            editor.scrollIntoView({
                line: editor.lineCount(),
                ch: 0
            });
            runCode();
           
        }
    });
});


 $(".dock").click(function () {
   if (dock) {
     $(this).html("Undock");
     dock = 0;
     undockAll();
   } else {
     $(this).html("Dock");
     dock = 1;
     dockAll();
   }
 });
 


    </script>
    <div class="toolbar hidden">
    
		<div class="p">
			<div class="subclasses2" method="css" id="border-radius" type="number">border-radius</div>
			<div class="subclasses2" method="css" id="background" type="color">background</div>
			<div class="subclasses2" method="css" id="" type="background-image">background-image</div>
			<div class="subclasses2" method="css" id="border-color" type="color">border-color</div>
			<div class="subclasses2" method="css" id="border-width" type="number">border-width</div>
			<div class="subclasses2" method="css" id="height" type="number">height</div>
			<div class="subclasses2" method="css" id="width" type="number">width</div>

			<div class="subclasses2" method="css" id="opacity" type="decimal">opacity</div>
			<div class="subclasses2" method="css" id="top" type="number">top</div>

			<div class="subclasses2" method="css" id="left" type="number">left</div>
			<div class="subclasses2" method="css" id="transform" type="angle">rotate</div>
			<div class="subclasses2" method="click" id="click" type="playnote">click</div>
			<div class="subclasses2" method="css" id="solid" type="choice">border-style</div>
			
		</div>
	</div>

    <div class="toolbar2 hidden">
    
		<div class="p">
			<div class="subclasses2" method="action" id="playnote">playnote</div>
		</div>
	</div>
  </body>
</html>
