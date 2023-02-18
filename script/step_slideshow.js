const next = document.getElementById("next_slide");
const prev = document.getElementById("prev_slide");
const container = document.getElementById("slideshow_container");
const slide = document.getElementById("the_slide");

let timeout_set = false;
let click_by_user = true;
let stopped = false;

function auto_next_slide(){
    timeout_set = false;
    
    if(stopped){
        return;
    }
    
    container.classList.add("slideshow_transition");
    setTimeout(function(){
        click_by_user = false
        next.click();
        click_by_user = true;
    }, 250);

    setTimeout(function(){
        container.classList.remove("slideshow_transition");
    }, 500);
}

function user_click(){
    if(click_by_user){
        if(stopped){
            return;
        }

        stopped = true;
        setTimeout(function(){
            stopped = false;
            auto_next_slide();
        }, 20000);
    }
}

slide.addEventListener("load", function(){
    if(!timeout_set){
        timeout_set = true;
        setTimeout(function(){
            auto_next_slide();
        }, 5000);
    }
});

next.addEventListener("click", user_click);
prev.addEventListener("click", user_click);

if(!timeout_set){
    setTimeout(function(){
        auto_next_slide();
    }, 5000);
}
