// Create a drawHeart() method
$.jCanvas.extend({
  name: "drawHeart",
  props: {
    faded: false
  },
  fn: function(ctx, p) {
    // Fade heart if chosen
    if (p.faded) {
      ctx.globalAlpha = 0.5;
    }
    // Draw heart
    ctx.lineWidth = p.radius;
    ctx.lineCap = "round";
    ctx.lineJoin = "miter";
    ctx.beginPath();
    ctx.moveTo(p.x-(p.radius/2), p.y-(p.radius/2));
    ctx.lineTo(p.x, p.y);
    ctx.lineTo(p.x+p.radius/2, p.y-p.radius/2);
    ctx.stroke();
    ctx.closePath();
  }
});

// Use the drawHeart() method
$("canvas").drawHeart({
  strokeStyle: "#c33",
  radius: 80,
  x: 150, y: 130
})
.drawHeart({
  strokeStyle: "#c33",
  radius: 50,
  x: 300, y: 130,
  faded: true
});