<?php
//header('Content-type: application/xhtml+xml');
session_start();
//if ($_SESSION['sessionid'] =='') {
	//session_start()
$_SESSION['sessionid'] = session_id();
//}

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
<link rel="apple-touch-startup-image" href="startup.png">

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
<script type="text/javascript" src="http://codemirror.net/lib/codemirror.js"></script>
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
		<a href="index.php"><h1>fabrique</h1></a>
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
   <canvas width='1040' height='1100'></canvas>
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
		<div class="subicons" id="add"></div>
		<div class="subicons" id="delete"></div>
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

 var blurManagement = function (e) {
 	console.log("blurred");
 }
 
 var focusManagement = function (e) {
 	console.log("focused");
 	ignore = true;
 }
 var autocompleteManagement = function (e) {
   console.log("auto");
   $('div.CodeMirror').find('textarea').blur();
   if (!ignore) {
   	console.log("not ignored");
   var si = editor.getScrollInfo();
   //console.log(si.y);
   currLine = editor.getCursor(true);
   var toffset = ((currLine.line + 2) * 20) - si.y;
   //console.log(toffset);
   
   //console.log(currLine);
   obj = editor.getTokenAt(currLine);
   var loffset = (obj.start * 6);
   //console.log(obj);
   
   if (obj.className == null) {
     $("#slider2").hide();
     $(".farbtastic").hide();
     $(".tip").hide();
   }
   
   // Is it a boolean?
   if (obj.className == "binary") {
	 var newstring = "true";
   	 var line = editor.getLine(currLine.line);
     if (obj.string == "true") {
		var newstring = "false";
     } 
     editor.replaceRange(newstring, {
         line: currLine.line,
         ch: obj.start
       }, {
         line: currLine.line,
         ch: obj.end
       });
       
     runCode();
   	

   	
   } 

    // Is it a font color?
   if (obj.className == "string" && obj.string.startsWith("\"#")) {
     console.log("Color");
     $("#picker").unbind();
     $('#picker').farbtastic(function (e) {
       var c = hexToRgb(e),
         h = rgbToHsl(c.r, c.g, c.b),
         r = hslToRgb(h.h, h.s, h.l),
         rgb = 'rgb(' + r.r + ',' + r.g + ',' + r.b + ')';
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
     $.farbtastic("#picker").setColor(obj.string);
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
     $("#slider2").hide();
     $(".tip").show();
     $(".farbtastic").hide();
     $("#delete").click(function() {
     	
     });
     $("#add").click(function() {
     	alert("add?");
     });
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
		if (obj.string.indexOf(".") !== -1) {
			val = parseFloat(obj.string);
			step = 0.1;
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
       slide: function (event, ui) {
         //console.log(obj.start);
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

     $("#slider2").css("margin-top", toffset + 30 + "px");
     $("#slider2").css("margin-left", loffset + "px");
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
   onChange: focusManagement,
        onFocus: function() {
          ignore = false;
        }
      });
      editor.setSize(500, 550);

      runCode();
      
      // Some extra stuff to do after the vis has been rendered
 function runPostCode() {

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

 
 //. Get the SVG
 $("#samples").click(function () {
   var recipe = window.open('', 'Samples', 'width=600,height=600');

   var html = '<?php include("samples.txt") ?>';
   recipe.document.open();
   recipe.document.write(html);
   recipe.document.close();

   return false;
 });

 //. Get the SVG
 $("#extract").click(function () {
   var recipe = window.open('', 'SVG content', 'width=600,height=600');

   var html = '<html><head><title>SVG content</title></head><body>Save the following into a blank text file and save as .svg<div id="content"><textarea cols="70" rows="30">' + vis.scene[0].canvas.innerHTML + '</textarea></div></body></html>';
   recipe.document.open();
   recipe.document.write(html);
   recipe.document.close();

   return false;
 });

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
       var content = editor.getValue();
       content += data;
       editor.setValue(content);
       editor.scrollIntoView({line:editor.lineCount(), ch:0});
       runCode();
     }
   });
 })



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
 
 $(".brew").click(function () {
   var src = $(this).attr("src");

   $(".brew").css("border", "3px solid #08306b");
   $(this).css("border", "3px solid #fff");

   var hue = $(this).attr("src").split("/")[1].split(".")[0];
   var dataclasses = $("#dataclasses").val();
   var colorstring = JSON.stringify(gvcolors[hue + dataclasses]);

   $.ajax({
     type: "POST",
     url: 'getColors.php',
     data: "hue=" + hue + "&classes=" + dataclasses + "&colorstring=" + colorstring,
     success: function (data) {
       var content = editor.getValue();
       content = content.replace("vis.render();", "");
       content += data;
       content += "\n\nvis.render();";
       editor.setCode(content);
       editor.jumpToLine(editor.lastLine())
       runCode();
     }
   });
 });


    </script>
  </body>
</html>
