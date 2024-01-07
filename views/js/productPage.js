document.addEventListener('DOMContentLoaded', function() {

    function changeImage(image){
        let mainImage = document.getElementById("main");
        mainImage.src = image;
    }
    var images = document.getElementsByClassName("image");

    for(let i = 0; i<images.length; i++){
        images[i].addEventListener("click", function(){
            changeImage(images[i].children[0].src);
            if(images[i].className == "image"){
                images[i].className = "clicked";
            }else{
                images[i].className = "image";

            }
        })
    }

});
