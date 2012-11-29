var element1 = 
    $("<input id='freqSlider' type='range' value='2000' min='0' max='22000' step='1' />")
       .css("position", "absolute")
       .css("top", 100+"px");
var element2 = 
    $("<input id='freqDisplay' type='text' />")
       .css("position", "absolute")
       .css("top", 200+"px");
var element3 = 
    $("<button id='btnPlay'>Play Sound</button>")
       .css("position", "absolute")
       .css("top", 300+"px");
var element4 = 
    $("<button id='btnPause'>Pause Sound</button>")
       .css("position", "absolute")
       .css("top", 400+"px");
$("#elements")
.html(element1
	.add(element2)
	.add(element3)
	.add(element4)
);

var ctxt = new webkitAudioContext(),
	oscillator = ctxt.createOscillator();

var updateFreq = function(freq) {
	oscillator.type = parseInt($('#comboWaveType').val(),10) ;
	oscillator.frequency.value = freq;
	oscillator.connect(ctxt.destination);
	oscillator.noteOn && oscillator.noteOn(0); // this method doesn't seem to exist, though it's in the docs?
	$("#freqDisplay").val(freq + "Hz");
};
        
$("#freqSlider").bind("change",function() {
    $("#freqDisplay").val( $("#freqSlider").val() + "Hz");
    updateFreq($("#freqSlider").val());
});
        
$("#btnPlay").click(function() {
	updateFreq($("#freqSlider").val());
});

$("#btnPause").click(function() {
	oscillator.disconnect();
});