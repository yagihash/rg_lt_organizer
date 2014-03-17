$(function() {
  $("nav#top_bar ul").css("margin-left", $("div#wrap").css("margin-left"));
  $(window).resize(function() {
    $("nav#top_bar ul").css("margin-left", $("div#wrap").css("margin-left"));
  });
  $("nav#top_bar ul li a").hover(function() {
    $(this).stop().animate({
      backgroundColor : "#77DDD1",
    }, 100);
  }, function() {

    $(this).stop().animate({
      backgroundColor : "#C4E9E0"
    }, 300);
  });
});
