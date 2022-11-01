let current_slide = Number(document.getElementById("current_image").innerHTML);


function change_slide(step){
    let slides = document.getElementById("images").children;
    let n_slides = slides.length;

    current_slide += step;
    if(current_slide < 0){
        current_slide = n_slides - 1;
    }
    else if(current_slide >= n_slides){
        current_slide = 0;
    }

    let the_slide = document.getElementById("the_slide");
    the_slide.src = slides[current_slide].innerHTML;

    let slide_number = document.getElementById("slide_number");
    slide_number.innerHTML = (current_slide + 1) + "/" + n_slides;

    setTimeout(function() {
        if(!the_slide.complete){
            document.getElementById("slideshow_loading").style.display = "inline-block";
        }
    }, 500);
}

function next_slide(){
    change_slide(1);
}

function prev_slide(){
    change_slide(-1);
}

function doc_keyUp(e) {

    if(e.key === "ArrowRight"){
        next_slide();
    }
    else if(e.key === "ArrowLeft"){
        prev_slide();
    }
}

function hide_loading(){
    document.getElementById("slideshow_loading").style.display = "none";
}

document.getElementById("next_slide").addEventListener("click", next_slide);
document.getElementById("prev_slide").addEventListener("click", prev_slide);
document.getElementById("the_slide").addEventListener("load", hide_loading);
document.addEventListener('keyup', doc_keyUp, false);
