// Create five cascading stars
for (var i=0; i<5; i+=1) {

  $("canvas").drawPolygon({
    layer: true,
    fillStyle: "#c33",
    x: 50+(i*60), y: 50+(i*60),
    radius: 30,
    sides: 5,
    projection: -0.5,
    click: function(layer) {
      // Click a star to spin it
      $(this).animateLayer(layer, {
        rotate: '+=144'
      });
    }
  });

}