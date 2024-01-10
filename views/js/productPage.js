document.addEventListener('DOMContentLoaded', function() {

    function changeImage(image){
        let mainImage = document.getElementById("mainImage");
        mainImage.children[0].src = image;
    }
    var images = document.getElementsByClassName("image");

    for(let i = 0; i<images.length; i++){
        if(images[i].id != "mainImage"){
            images[i].addEventListener("click", function(){
                changeImage(images[i].children[0].src);
                images[i].classList.add("clicked");
                for(let x = 0; x<images.length; x++){
                    if(x!=i){
                        images[x].classList.remove("clicked");
                    }
                }
            })
        }
    }


});
