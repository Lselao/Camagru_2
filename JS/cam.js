
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
function stickers(path) {
    var sticker = new Image();
    var width = video.offsetWidth, height = video.offsetHeight;
    sticker.src = path;
    if (canvas) {
        contxt = canvas.getContext('2d');
        contxt.drawImage(sticker, 0, 0, width, height);
        pic.value = canvas.toDataURL('image/png');
        if (!(document.getElementById("img"))) {
            var elem = document.createElement("img");
            elem.setAttribute("src", sticker.src);
            document.getElementById("stickers").appendChild(elem);
        }
        else {
            var elem = document.createElement("img");
            elem.setAttribute("src", "images/hydrangeas.jpg");
        }
    }
};
