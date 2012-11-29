// Click the star to make it spin
$("canvas").drawPolygon({
  layer: true,
  fillStyle: "#c33",
  x: 100, y: 100,
  radius: 50,
  sides: 5,
  projection: -0.5,
  click: function(layer) {
    // Spin star
    $(this).animateLayer(layer, {
      rotate: '+=' + 144
    });
  }
});