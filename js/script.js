$(function() {
  $("nav#top_bar ul").css("margin-left", (window.innerWidth - 800) / 2 + "px")
  $(window).resize(function() {
    $("nav#top_bar ul").css("margin-left", (window.innerWidth - 800) / 2 + "px")
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
  
  /* * /
  $("form#register input[type=button]").click(function() {
    var paramCheck = true;
    $("form#register select, form#register input[type=text], form#register input[type=file]").each(function() {
      if (this.value === "")
        paramCheck = false;
    });
    if (paramCheck && window.confirm("送信します。"))
      $("form#register").submit();
    else
      alert("入力項目を確認してください。");
  });
  /* */
});
