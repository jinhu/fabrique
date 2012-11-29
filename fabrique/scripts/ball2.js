var element = $("<div />")
  .css("position", "absolute")
  .css("background", "#000")
  .css("width", 20 + "px")
  .css("height", 20 + "px")
  .css("border-radius", 10 + "px")
  .attr("id", "ball");
  
$("#elements")
  .html(element);
  
  // Position Variables
  var x = 0;
  var y = 0;
   
  // Speed - Velocity
  var vx = 0;
  var vy = 0;
   
  // Acceleration
  var ax = 0;
  var ay = 0;
   
  var delay = 5;
  var vMultiplier = 0.01;
  
  window.onload = function() {
    if (window.DeviceMotionEvent==undefined) {
    	
     
    } else {
    	window.ondevicemotion = function(event) {
    	 
    		ax = event.accelerationIncludingGravity.x;
    		ay = event.accelerationIncludingGravity.y;
    	}
     
    	setInterval(function() {
    		vy = vy + -(ay);
    		vx = vx + ax;
     
    		var ball = document.getElementById("ball");
    		y = parseInt(y + vy * vMultiplier);
    		x = parseInt(x + vx * vMultiplier);
    		
    		if (x<0) { x = 0; vx = 0; }
    		if (y<0) { y = 0; vy = 0; }
    		if (x>document.documentElement.clientWidth-20) { x = document.documentElement.clientWidth-20; vx = 0; }
    		if (y>document.documentElement.clientHeight-20) { y = document.documentElement.clientHeight-20; vy = 0; }
    		
    		ball.style.top = y + "px";
    		ball.style.left = x + "px";
    		document.getElementById("pos").innerHTML = "x=" + x + "<br />y=" + y;
    	}, delay);
    } 
  };