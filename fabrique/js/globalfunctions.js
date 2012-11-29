function hslToRgb(h, s, l) {
  var r, g, b;

  if (s == 0) {
    r = g = b = l; // achromatic
  } else {
    function hue2rgb(p, q, t) {
      if (t < 0) t += 1;
      if (t > 1) t -= 1;
      if (t < 1 / 6) return p + (q - p) * 6 * t;
      if (t < 1 / 2) return q;
      if (t < 2 / 3) return p + (q - p) * (2 / 3 - t) * 6;
      return p;
    }

    var q = l < 0.5 ? l * (1 + s) : l + s - l * s;
    var p = 2 * l - q;
    r = hue2rgb(p, q, h + 1 / 3);
    g = hue2rgb(p, q, h);
    b = hue2rgb(p, q, h - 1 / 3);
  }

  return {
    r: parseInt(r * 255),
    g: parseInt(g * 255),
    b: parseInt(b * 255)
  };
}

function rgbToHsl(r, g, b) {
  r /= 255, g /= 255, b /= 255;
  var max = Math.max(r, g, b),
    min = Math.min(r, g, b);
  var h, s, l = (max + min) / 2;

  if (max == min) {
    h = s = 0; // achromatic
  } else {
    var d = max - min;
    s = l > 0.5 ? d / (2 - max - min) : d / (max + min);
    switch (max) {
      case r:
        h = (g - b) / d + (g < b ? 6 : 0);
        break;
      case g:
        h = (b - r) / d + 2;
        break;
      case b:
        h = (r - g) / d + 4;
        break;
    }
    h /= 6;
  }

  //return [h*100, s*100, l*70];
  //return {h:parseFloat(h*360), s:parseInt(s*100), l:parseInt(l*80)};
  return {
    h: h,
    s: s,
    l: l * .8
  };
}

function hexToRgb(hex) {
  var result = /^#?([a-f\d]{2})([a-f\d]{2})([a-f\d]{2})$/i.exec(hex);
  return result ? {
    r: parseInt(result[1], 16),
    g: parseInt(result[2], 16),
    b: parseInt(result[3], 16)
  } : null;

}

function isInt(n) {
  return n === +n && n === (n | 0);
}



function runCode() {
//console.log("Running");

  hiddenvars = 0;
  $("#elements").html("");
  allslices = Array();
  $("#fig").html("");
  $("canvas").remove();
  $(".renderarea").prepend("<canvas width='1040' height='1100'></canvas>");
  canvas = $("canvas")[0];
  canvas.style.width = "520px";
  canvas.style.height = "550px";
  var context = canvas.getContext('2d');
  context.clearRect(0, 0, canvas.width, canvas.height);
  var head = document.getElementById("fig");
  var script = document.createElement("script");
  var content = editor.getValue();

  if (content.indexOf("script") == -1 && content.indexOf("alert") == -1 && content.indexOf("src") == -1) {
    var savedcontent = editor.getValue();
    localStorage.setItem('code', savedcontent);
    script.text = content;
    head.appendChild(script);
    runPostCode();

  } else {
    alert("Invalid string found. An attempt has been made to prevent unwanted malicious code to execute. If you believe this is in error, please contact the author.");
  }
  
}

function goToLabel(index) {
  editor.jumpToLine(allslices[index - 1]);
}


function loadAll(id) {
  url = "loadAll.php?id=" + id;
  $.getScript(url, function (returneddata) {

  });
}

function ajaxFileUpload() {
  //starting setting some animation when the ajax starts and completes
  $("#loading").ajaxStart(function () {
    $(this).show();
  }).ajaxComplete(function () {
    $(this).hide();
  });

  $.ajaxFileUpload({
    url: 'doajaxfileupload.php',
    secureuri: false,
    fileElementId: 'fileToUpload',
    dataType: 'json',
    success: function (data, status) {
      if (typeof (data.error) != 'undefined') {
        if (data.error != '') {
          alert(data.error);
        } else {
          alert(data.msg);
        }
        //jscallback();
      }
      url = "parseData.php";
      $.getScript(url, function (returneddata) {
        $("#JSLINT_INPUT").html(returneddata);
        $("#submitjslint").click();
      });
    },
    error: function (data, status, e) {
      alert(e);
    }
  })

  return false;

}
// jslint callback

function jscallback() {
  var htm = $("#JSLINT_OUTPUT").html();
  // No errors
  if (htm.indexOf("Error:") == -1 && htm.indexOf("Problem") == -1) {

    //runCode();
    runDebug();
    loadDataIntoViewer();
    //$("#view").show();	
    //$("#plottypes").show();
  } else {
    $(".errorsdisplay").html(htm);
    $("#errorcode").html($("#JSLINT_INPUT").html());
    $(".errorsdisplay, .errorsdisplaytextarea").slideDown(function () {
      $("#errorcode").height($(".errorsdisplay").height() - 30);
    });
    $(".errorsdisplay").append("<input type='button' value='Ignore errors, dammit. I know what I am doing &raquo;' id='ignore'>");
    $("#ignore").click(function () {
      $(".errorsdisplay, .errorsdisplaytextarea").slideUp();
      runDebug();
      loadDataIntoViewer();
    });
    var erroreditor = CodeMirror.fromTextArea("errorcode", {
      parserfile: ["tokenizejavascript.js", "parsejavascript.js"],
      stylesheet: "css/jscolors.css",
      path: "js/",
      lineNumbers: true,
      autoMatchParens: true
    });


  }
}

function countProperties(obj) {
  var prop;
  var propCount = 0;

  for (prop in obj) {
    propCount++;
  }
  return propCount;
}

function isDate(dateStr) {

  var datePat = /^(\d{1,2})(\/|-)(\d{1,2})(\/|-)(\d{4})$/;
  var matchArray = dateStr.match(datePat); // is the format ok?
  var newformat = false;
  if (matchArray == null) {
    var datePat = /^(\d{1,2})(\/|-)(\w{3})(\/|-)(\d{4})$/;
    var matchArray = dateStr.match(datePat); // is the format ok?
    if (matchArray != null) {
      newformat = true;
    } else {
      return false;
    }
  }
  if (newformat) {
    return true;
  } else {
    month = matchArray[1]; // p@rse date into variables
    day = matchArray[3];
    year = matchArray[5];

    if (month < 1 || month > 12) { // check month range
      alert("Month must be between 1 and 12.");
      return false;
    }

    if (day < 1 || day > 31) {
      alert("Day must be between 1 and 31.");
      return false;
    }

    if ((month == 4 || month == 6 || month == 9 || month == 11) && day == 31) {
      alert("Month " + month + " doesn`t have 31 days!")
      return false;
    }

    if (month == 2) { // check for february 29th
      var isleap = (year % 4 == 0 && (year % 100 != 0 || year % 400 == 0));
      if (day > 29 || (day == 29 && !isleap)) {
        alert("February " + year + " doesn`t have " + day + " days!");
        return false;
      }
    }
  }
  return true; // date is valid
}

// Source: http://pietschsoft.com/post/2008/01/14/JavaScript-intTryParse-Equivalent.aspx
function tryParseInt(str, defaultValue) {
  var retValue = defaultValue;
  if (str != null) {
    if (str.length > 0) {
      if (!isNaN(str)) {
        retValue = parseInt(str);
      }
    }
  }
  return retValue;
}

// Put things into debugViewer
function runDebug() {
  $("#debugViewer").html("");
  $(".debugViewer").html("");
  var predictions = $("<strong>Predictions</strong> - check to use (<a class='help' href='#'>help</a>)<br />");
  predictions.bind("click", function () {
    viewHelp("predictions");
  });
  $(".debugViewer").append(predictions);
  var firstRow = data[0];
  var length = data[0].length;

  if (length != undefined) {
    // Todo: generalize this
    length = data[0][0].length;
    firstRow = data[0][0];
    // It could also be an array of numbers
  }
  if (length === undefined) {
    counter = 0;

    for (property in firstRow) {
      date = "";
      number = "";
      // If the property is a string:
      if (isNaN(data[0][property])) {
        if (isDate(data[0][property]) && isDate(data[1][property])) {
          date = "selected";
        }
        if (tryParseInt(data[0][property].replace(",", ""), 0) != 0) {
          number = "selected";
        }
      } else {
        number = "selected";
      }
      var select = $("<div id='selecttype'><select class='typeselector' id='type" + counter + "'><option value='nominal'>category</option><option " + number + " value='quantitative'>number</option><option " + date + " value='date'>date</option></select></div>");
      var input = $("<div id='chooseselection'><input type='checkbox' id='" + counter + "' name='usedata' class='usedata' value='" + property + "' /></div>");

      $(".debugViewer").append(property + "<br />");
      $(".debugViewer").append(select.html());
      $(".debugViewer").append(input.html() + "<br />");
      $(".debugViewer").find(".usedata:last").bind("click", function () {

        // Allow users to order
        if ($(this).attr("checked")) {

          if (!($(this).val() in variablesToUse)) {
            variablesToUse.push($(this).val());
            pseudovars.push("pv" + $(this).attr("id"));
            variableTypes.push($("#type" + $(this).attr("id")).val());
          }
        } else {

          var idx = variablesToUse.indexOf($(this).val());
          if (idx != -1) {
            variablesToUse.splice(idx, 1);
            variableTypes.splice(idx, 1);
            pseudovars.splice(idx, 1);
          }
        }
        checkAll();
      });
      counter++;

      //$(".debugViewer").append(data[0][property]);
      //$(".debugViewer").append(data[1][property]);

    }
  } else {


  }
}

function checkAll() {
  //variablesToUse = new Array();
  $("#selectedvars").remove();
  $(".clickable").hide();
  $(".debugViewer").append("<div id='selectedvars'>Variables selected:<br />" + variablesToUse + "<br /><br /></div>");

  var numbers = countItems(variableTypes, "quantitative");
  var categories = countItems(variableTypes, "nominal");
  var dates = countItems(variableTypes, "date");

  // Where all the decision making happens
  if (numbers != undefined) {
    if (numbers == 2) {
      $(".n2").show();
    }
    if (numbers >= 1 && categories >= 2) {
      $(".stackedbars").show();
    }
    if (numbers >= 1 && categories == 1) {
      alert("Showing grouped bars");
    }
  }
  if (dates != undefined) {
    if (dates == 1 && categories >= 1) {
      alert("Showing candlestick, discrete");
    }
  }

}

function saveSVG(id) {
  var svg = vis.scene[0].canvas.innerHTML
  $.ajax({
    type: "POST",
    url: 'saveSVG.php',
    data: "svg=" + svg + "&id=" + id,
    success: function (data) {}
  });
}

function bindAll() {
  $(".gallery").click(function () {
    alert($(this).attr("id"));
  });
}

function saveShare() {
  var title = $("#sharename").val();
  var id = randomPassword(10);
  var public = $("#makepublic").is(':checked');
  var datapublic = $("#makedatapublic").is(':checked');
  saveAll();
  saveSVG(id);
  // Save data and everything else
  $.ajax({
    type: "POST",
    url: 'saveData.php',
    data: "id=" + id + "&title=" + title + "&public=" + public + "&datapublic=" + datapublic,
    success: function (data) {
      $(".smooth").after(data);
      $(".smooth").addClass("sharedata");
      $(".sharedata").removeClass(".smooth");

    }
  });
}

function randomPassword(length) {
  chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890";
  pass = "";
  for (x = 0; x < length; x++) {
    i = Math.floor(Math.random() * 62);
    pass += chars.charAt(i);
  }
  return pass;
}

function saveAll() {
   saveLoc()


   // Save code
   var code = editor.getValue();
   $.ajax({
     type: "POST",
     url: 'saveCode.php',
     data: "type=save&data=" + encodeURIComponent(code),
     success: function (data) {
       //$(".sessionstatus").html(data);	
     }
   });
 }
 
function saveLoc() {


}

function loadDataIntoViewer() {
  var ppTable = prettyPrint(data);
  $("#dataViewer").html(ppTable);
}

// View the data
function viewData(location) {
  var c = editor.getSearchCursor("view", true, true);
  if (c.findNext()) {
    c.select();
  }

  if (!dataTableOpen) {
    loadDataIntoViewer();
    $(".databuttons").fadeIn();
    $("#dataViewer").animate({
      height: "200px"
    });
    $(".2").bind("click", function () {
      // This is done multiple times but the last one is what we want.
      var index = ($(this).parent().find(".1:first").html());

    });
    dataTableOpen = 1;
    $(".2").editable("save.php", {

    });
  }

  if (location == undefined) {

  } else {

    $(".1").each(function () {

      if ($(this).html() == location) {
        $(this).effect("highlight", {}, 4000);

        $('#dataViewer').animate({
          scrollTop: temp + $(this).position().top - 100
        });
        temp = temp + $(this).position().top - 100;
      }
    });
  }
}

function countItems(a, s) {
  counter = 0;
  for (x = 0; x < a.length; x++) {
    if (a[x] == s) {
      counter++;
    }
  }
  return counter;
}


// Do all the backend stuff
function uglifyData(code) {
  var len = variablesToUse.length;
  var types = variableTypes;

  for (var i = 1; i <= len; i++) {
    reg = new RegExp('\\|quantitative' + i + '\\|', 'gi');
    code = code.replace(reg, variablesToUse[i - 1])
  }

  for (var i = 1; i <= len; i++) {
    maxval = 0;

    for (var j = 0; j < data.length; j++) {
      // Sanitize data
      if (variableTypes[i - 1] == "quantitative") {
        // Check if the data is indeed numerical:
        curval = data[j][variablesToUse[i - 1]];
        if (!isNaN(curval)) {
          if (parseFloat(curval) > parseFloat(maxval)) {
            maxval = curval;

          }
        } else {
          // It's a string containing numbers?
          curval = curval.replace(",", "");
          data[j][variablesToUse[i - 1]] = curval;
          if (tryParseInt(curval, 0) != 0) {
            if (parseFloat(curval) > parseFloat(maxval)) {
              maxval = curval;

            }
          }
        }
      }
    }
    reg = new RegExp('\\|maxquantitative' + i + '\\|', 'gi');
    code = code.replace(reg, parseInt(Math.ceil(maxval)))
  }
  editor.setCode(code);
  runCode();
  //alert("here");

}

function getContent(type, prettyname) {
  $.ajax({
    type: "POST",
    url: 'getContent.php',
    data: "type=" + type,
    success: function (data) {
      uglifyData(data);
      $(".chartcodetype").html(prettyname);
    }
  });
}

function lookupSyntax(type) {
  $.ajax({
    type: "POST",
    url: 'lookup.php',
    data: "type=" + type,
    success: function (data) {
      $("#syntax").html(data);
      $("#syntax").slideDown();
    }
  });
}


function setSession(id) {
  $.ajax({
    type: "POST",
    url: 'setSession.php',
    data: "id=" + id,
    success: function (data) {
      window.location.reload()
    }
  });
}


function viewHelp(content) {
  if (content == "predictions") {
    var recipe = window.open('', 'Help with data', 'width=600,height=600');

    var html = '<?php include("help.txt") ?>';
    recipe.document.open();
    recipe.document.write(html);
    recipe.document.close();

    return false;
  }
}

// Dock everything
function dockAll() {
  $("#leftside").draggable();
  $("#rightside").draggable();
  $("#middle").draggable();
  $("#dataViewer").resizable();
  $(".ui-icon ui-icon-gripsmall-diagonal-se").css("float", "left;");
}
// Dock everything
function undockAll() {
  $("#leftside").draggable("destroy");
  $("#rightside").draggable("destroy");
  $("#middle").draggable("destroy");
  $("#dataViewer").resizable("destroy");
}