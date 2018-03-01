initFontResize = function(){
	$(".resizeTextFont").each(function(){
		var fontSize = parseInt($(this).css("font-size"));
		if($(this).attr("alt-font") == null)
		{
			$(this).attr("alt-font",fontSize);
		}
	});
	
	$(".resizeRow").each(function(){
		var heightSize = parseInt($(this).css("height"));
		if($(this).attr("alt-height") == null)
		{
			$(this).attr("alt-height",heightSize);
		}
	});
	
	$(".resizeWidth").each(function(){
		var widthSize = parseInt($(this).css("width"));
		if($(this).attr("alt-width") == null)
		{
			$(this).attr("alt-width",widthSize);
		}
	});
	resize();
};
function resize() {
	$(".resizeTextFont").each(function(index){
		var preferredHeight = 980;
		var displayHeight = $(window).innerHeight();
		var percentage = displayHeight / preferredHeight;
	 
		var fontSize = parseInt($(this).attr("alt-font"));
		var newFontSize = Math.floor(fontSize * percentage) - 1;
		$(this).css("font-size", newFontSize);
	});
	
	$('.resizeImage').each(function() {
		var preferredHeight = 980;
		var displayHeight = $(window).innerHeight();
		var percentage = displayHeight / preferredHeight;
		
		var heightSize = parseInt($(this).attr("alt-height"));
		var widthSize = parseInt($(this).attr("alt-width"));
		
		var aspect = widthSize / heightSize;
		var newHeightSize = Math.floor(heightSize * percentage) - 1;
		var newWidthSize = Math.floor(newHeightSize * aspect);
		$(this).css("height", newHeightSize);
		$(this).css("width", newWidthSize);
		
	});
	$(".resizeRow").each(function(index){
	 var preferredHeight = 980;
	 var displayHeight = $(window).innerHeight();
	 var percentage = displayHeight / preferredHeight;
	 
	 var heightSize = parseInt($(this).attr("alt-height"));
	 var newHeightSize = Math.floor(heightSize * percentage) - 1;
	 $(this).css("height", newHeightSize);
	});
	
	$(".resizeWidth").each(function(){
	 var preferredHeight = 980;
	 var displayWidth = $(window).innerHeight();
	 var percentage = displayWidth / preferredHeight;
	 
	 var widthSize = parseInt($(this).attr("alt-width"));
	 var newWidthSize = Math.floor(widthSize * percentage) - 1;
	 $(this).css("width", newWidthSize);
	});
}
	
jQuery(document).ready(function() {
  $("#home").height($(window).height());
  $(window).resize(function() {
    $("#home").height($(window).height());
    $("#home").css("min-height", "600px");
  });
  $("#header").height($(window).height());
  $(window).resize(function() {
    $("#header").minHeight($(window).height());
    $("#header").css("min-height", "600px");
  });
  $("#boss_timer").height($(window).height());
  $(window).resize(function() {
    $("#boss_timer").height($(window).height());
    $("#boss_timer").css("min-height", "600px");
  });
  $("#trading_post").height($(window).height());
  $(window).resize(function() {
    $("#trading_post").height($(window).height());
    $("#trading_post").css("min-height", "600px");
  });
  initFontResize();
});
jQuery(document).ready(function($) {
  $(".scroll").click(function(types) {
    types.preventDefault();
    $("html,body").animate({
      scrollTop : $(this.hash).offset().top
    }, 1E3);
  });
});
