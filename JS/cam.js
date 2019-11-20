
canvas = null;

(function(){
    
    canvas = document.getElementById('canvas'),
    context = canvas.getContext('2d'),
    video = document.getElementById('video'),
    capture = document.getElementById('capture'),
    pic = document.getElementById('img');
    navigator.getMedia = navigator.getUserMedia ||
                         navigator.webkitGetUserMedia ||
                         navigator.mozGetUserMedia ||
                         navigator.msGetUserMedia;
    navigator.getMedia({
        video: { width: 400, height: 300 },
        audio: false
        
    }, function(stream){
        video.srcObject = stream;
        video.play();
    }, function(error){
        //An error occured
        console.log('Something went wrong');
    });
    capture.addEventListener('click', function () {
        context.drawImage(video, 0, 0, 400, 300);
        pic.value = canvas.toDataURL('uploads/jpeg');
    }, false);
    document.getElementById('clear').addEventListener('click', function () {
        context.clearRect(0, 0, canvas.width, canvas.height);
    });
    
})();



