(function(){
    
    var canvas = document.getElementById('canvas'),
    context = canvas.getContext('2d'),
    video = document.getElementById('video'),
    capture = document.getElementById('capture'),
    pic = document.getElementById('img');
    //getting value of the button
    apply = document.getElementById('apply');


    navigator.getMedia = navigator.getUserMedia ||
                         navigator.webkitGetUserMedia ||
                         navigator.mozGetUserMedia ||
                         navigator.msGetUserMedia;

    navigator.getMedia({
        video: true,
        audio: false
        
    }, function(stream){
        video.srcObject = stream;
        video.play();
    }, function(error){
        //An error occured
        console.log('Something went wrong')
    });

    capture.addEventListener('click', function () {
        context.drawImage(video, 0, 0, 400, 300);
        pic.value = canvas.toDataURL('uploads/jpeg');
    }, false);
    //applying the sticker to the canvas
    apply.addEventListener('click', function () {
        var sticker = document.getElementById('stickers').value;
        if (sticker == bubbles)
        else if (sticker == lips)
        else
        context.drawImage(sticker, 0, 0, 80, 80);
    })
    document.getElementById('clear').addEventListener('click', function () {
        context.clearRect(0, 0, canvas.width, canvas.height);
    });
    
})();