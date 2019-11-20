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
            elem.setAttribute("src", "images/hydrangeas.png");

           // echo '<script>alert("sxczc")</script>';
        }
    }
};