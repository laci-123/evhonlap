const trigger = document.getElementById("trigger");
document.addEventListener("click", function (event) {
    if (event.target.closest("#menu_lista") ||
        event.target.closest("#trigger") ||
        event.target.closest("#next_slide") ||
        event.target.closest("#prev_slide") ||
        event.target.tagName == "LABEL" ||
        event.target.tagName == "SPAN") 
    {
        return;
    }

    trigger.checked = false;
});