var element = $("<div />")
  .css("position", "absolute")
  .css("background", "#000")
  .css("width", 100 + "px")
  .css("height", 100 + "px")
  .css("top", 100 + "px")
  .css("left", 100 + "px");
  
$("#elements")
  .html(element);
  
$(element).click(function () {
  playSound(1.0);
});

var audioCtx, soundBuffer;

function playSound(x) {
  if (soundBuffer) {
    var sound = audioCtx.createBufferSource();
    var gain = audioCtx.createGainNode();
    sound.buffer = soundBuffer;
    sound.playbackRate.value = x;
    sound.connect(gain);
    gain.connect(audioCtx.destination);

    var volume = 0.5;
    gain.gain.value = volume;

    sound.noteOn(0);

  }
}

audioCtx = new webkitAudioContext();

function bufferSound(event) {
  var request = event.target;
  soundBuffer = audioCtx.createBuffer(request.response, false);
}

var request = new XMLHttpRequest();
request.open('GET', 'piano.mp3', true);
request.responseType = 'arraybuffer';
request.addEventListener('load', bufferSound, false);
request.send();