$(function() {
  var q = search2obj(location.search);
  if (q["m"])
    var time = q["m"];
  else if (q["s"])
    var time = sec2min(q["s"]);
  else
    var time = "05:00";
  $("span.time_rest").text(time);

  // TODO: 質疑応答モード追加

  var loop;
  $("form.controll").submit(function() {
    if ( typeof loop !== "undefined")
      clearInterval(loop);
    var loginName = $("input#login_name").val();
    $("input#login_name").val("");
    $("span#presenter").text(loginName);
    loop = startTimer(time);
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
      if (sec <= 60) {
        $("span.time_rest").css("color", "#DD0000");
      }
      if (sec == 0) {
        clearInterval(loop);
        sound.play();
      }
    }, 1000);
    return loop;
  }

  // 秒数を渡す
  // xx:xxの形式で時間を返す
  function sec2min(sec) {
    if (isNaN(sec))
      return false;
    var min = ("0" + (sec / 60 | 0)).slice(-2);
    var sec = ("0" + (sec % 60 | 0)).slice(-2);
    return min + ":" + sec;
  }

  // xx:xxの形式で時間を渡す
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

  // location.searchをそのまま渡すと幸せになれる
  function search2obj(search) {
    if (!search)
      return {};
    search = search.substr(1).split("&");
    for (var i = 0, obj = {}, size = search.length; i < size; i++) {
      var q = search[i].split("=");
      obj[q[0]] = q[1] || "";
    }
    return obj;
  }

});
