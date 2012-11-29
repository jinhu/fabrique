$("canvas")
.drawArc({
  layer: true,
  fillStyle: "#ffffff",
  strokeStyle: "#36b",
  strokeWidth: 2,
  x: 150, y: 150,
  radius: 50,
  ccw: true,
  draggable: true,
  bringToFront: true
})
.drawRect({
  layer: true,
  fillStyle: "#6c1",
  strokeStyle: "#6c1",
  strokeWidth: 2,
  x: 100, y: 100,
  width: 100, height: 100,
  draggable: true,
  bringToFront: true
});