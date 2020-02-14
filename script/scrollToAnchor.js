function scrollToAnchor(aid){
	var aTag = $("a[name=\'"+ aid +"\']");
	$("html,body").animate({scrollTop: aTag.offset().top},"slow");
}

$(".belso_link").click(function() {
	var str = $(this).attr("href");
	scrollToAnchor(str.substring(1));
});
