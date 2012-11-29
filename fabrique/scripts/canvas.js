$("canvas").drawText({
  fillStyle: "#000000",
  x: 500, y: 100,
  font: 60 + "pt Helvetica Neue, Helvetica, sans-serif",
  text: "Welcome to Fabrique"
});

$("canvas").drawText({
  fillStyle: "#000000",
  x: 500, y: 287,
  maxWidth: 771,
  font: 30 + "pt Helvetica Neue, Helvetica, sans-serif",
  text: "Fabrique combines canvas elements, jQuery, and" 
  + " live code editing for a fun, touch-based iterative" 
  + " programming experience. Start by clicking on any "
  + " number or font in the code."
});

$("canvas").drawRect({
  fillStyle: "#fff",
  strokeStyle: "#000",
  strokeWidth: 40,
  x: 490, y: 630,
  width: 440,
  height: 340,
  cornerRadius: 10,
});

$("canvas").drawText({
  fillStyle: "#000000",
  x: 495, y: 860,
  maxWidth: 671,
  font: 29 + "pt Helvetica Neue, Helvetica, sans-serif",
  text: "Will you try me on an iPad?"
});


$("canvas").drawEllipse({
  fillStyle: "#333",
  strokeStyle: "#000",
  x: 710, y: 620,
  width: 20, height: 20
});

$("canvas").drawImage({
  source: "images/screenshot.jpg",
  x: 290, y: 480,
  width: 400,
  height: 300,
  fromCenter: false
});