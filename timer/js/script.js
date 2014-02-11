$(function() {
  // TODO: 時間設定追加
  // TODO: 質疑応答モード追加

  var loop;
  $("form.controll").submit(function() {
    if ( typeof loop !== "undefined")
      clearInterval(loop);
    var loginName = $("input#login_name").val();
    $("input#login_name").val("");
    $("span#presenter").text(loginName);
    loop = startTimer();
    return false;
  });

  function prepareSound() {
    // Thanks for くらげ工匠(http://www.kurage-kosho.info/)
    var audio = new Audio("");
    var canPlayWav = (audio.canPlayType("audio/wav") == "maybe");
    if (canPlayWav) {
      audio.src = "sounds/cym03.wav";
    } else {
      audio.src = "sounds/cym03.mp3";
    }
    return audio;
  }

  function startTimer(formatted_time) {
    $("span.time_rest").css("color", "#000000");
    var sound = prepareSound();
    var sec = min2sec(formatted_time) || 300;
    var min = sec2min(sec);
    $("span.time_rest").text(min);
    var loop = setInterval(function() {
      $("span.time_rest").text(sec2min(--sec));
      if (sec == 0) {
        clearInterval(loop);
        sound.play();
      } else if (sec == 60) {
        $("span.time_rest").css("color", "#DD0000");
      }
    }, 1000);
    return loop;
  }

  // 秒数を渡す
  // xx'xx"の形式で時間を返す"
  function sec2min(sec) {
    if (isNaN(sec))
      return false;
    var min = ("0" + (sec / 60 | 0)).slice(-2);
    var sec = ("0" + (sec % 60 | 0)).slice(-2);
    return min + ":" + sec;
  }

  // xx'xx"の形式で時間を渡す
  // 秒数を返す
  function min2sec(formatted) {
    var formatted = formatted || "";
    if (!formatted.match(/^[0-9]{2}:[0-9]{2}$/))
      return false;
    var min = parseInt(formatted.match(/^([0-9]{2})/)[1]);
    var sec = parseInt(formatted.match(/([0-9]{2})$/)[1]);
    if (sec > 59)
      return false;
    return min * 60 + sec;
  }

});
