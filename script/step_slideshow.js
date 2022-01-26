let next = document.getElementById("next_slide");
let container = document.getElementById("slideshow_container");

function auto_next_slide(){
    container.classList.add("slideshow_transition");
    setTimeout(function(){
	next.click();
    }, 250);
    setTimeout(function(){
	container.classList.remove("slideshow_transition");
    }, 500);
}

document.getElementById("the_slide").addEventListener("load", function(){
    setTimeout(function(){
	auto_next_slide();
    }, 5000);
});
