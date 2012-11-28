$("canvas").drawText({
  fillStyle: "#000000",
  x: 215, y: 50,
  maxWidth: 420,
  font: 15 + "pt Helvetica Neue, Helvetica, sans-serif",
  text: "Photo and video uploading from a web app is still relatively new to the iOS experience. Try it out here."
});

var element1 = 
    $("<input type='file' accept='video/*' capture='camcorder'>")
       .css("position", "absolute")
       .css("top", 150+"px");
 
var element2 = 
    $("<input type='file' accept='audio/*' capture='camcorder'>")
       .css("position", "absolute")
       .css("top", 180+"px");      

$("#elements")
.html(element1.add(element2));