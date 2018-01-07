var forum = "https://www.dcard.tw/_api/forums/";
var post = "https://www.dcard.tw/_api/posts";
var url = post + "?popular=true";

function addforum() {
  $.ajax({
    url: 'https://www.dcard.tw/_api/forums',
    type: "get",
    success: function (e) {
      var t = 0;
      for (i = 0; i < e.length; i++) {
        if (e[i].invisible)
          continue;
        if (e[i].isSchool == false) $("#cat_scroll").append('<li class="cat" value="' + e[i].alias + '"><a href="#">' + e[i].name + '</a></li>');
        else if (e[i].isSchool == true) {
          $("#sch_scroll").append('<li class="sch" value="' + e[i].alias + '"><a href="#">' + e[i].name + '</a></li>');
        }
      }
      $(".cat").click(function () {
        if ($(window).width() <= 768) {
          $("nav").hide();
          $("#cat_scroll").hide();
        } else {
          $(".cat").hide();
          $("#cat_scroll").hide();
        }
        $(window).scrollTop(0);
        url = forum + this.getAttribute("value") + "/posts";
        getForum(url);
      });
      $(".sch").click(function () {
        if ($(window).width() <= 768) {
          $("nav").hide();
          $("#sch_scroll").hide();
        } else {
          $(".sch").hide();
          $("#sch_scroll").hide();
        }
        $(window).scrollTop(0);
        url = forum + this.getAttribute("value") + "/posts?popular=false";
        getForum(url);
      });
    }
  });
}

function header_set() {
  //homepage button
  $("#logo-container").click(function () {
    $(window).scrollTop(0);
    if ($(window).width() <= 768) {
      $("")
      $("nav").hide();
    } else {
      $(".cat").hide();
      $("#cat_scroll").hide();
      $(".sch").hide();
      $("#sch_scroll").hide();
    }
    $("#result").empty();
    url = post + "?popular=true";
    //getForum(url);
    //pcard('https://people.cs.nctu.edu.tw/~hkwu0313/pcard/post');
  })
  //hambuger button
  $("#ham").click(function () {
    $(".cat").hide();
    $("#cat_scroll").hide();
    $(".sch").hide();
    $("#sch_scroll").hide();
    $("nav").toggle();
  });
  //search
  $("#search_icon").click(function () {
    if (!$("#search_box").val()) {
      url = post;
      getForum(url);
    } else {
      url = 'https://www.dcard.tw/_api/search/posts?query=' + $("#search_box").val();
      getForum(url);
    }
    $("#search_box").val("");
  });
  $("#search_box").keypress(function (key) {
    if (key.keyCode == 13) {
      if (!$("#search_box").val()) {
        url = post;
        getForum(url);
      } else {
        url = 'https://www.dcard.tw/_api/search/posts?query=' + $("#search_box").val();
        getForum(url);
      }
      $(this).val("");
    }
  });
}

function nav_set() {
  //nav toggle
  $("#cat_tag").click(function () {
    $(".sch").hide();
    $("#sch_scroll").hide();
    $(".cat").toggle();
    $("#cat_scroll").toggle();
  });
  $("#sch_tag").click(function () {
    $(".cat").hide();
    $("#cat_scroll").hide();
    $(".sch").toggle();
    $("#sch_scroll").toggle();
  });
  //using api - nav bar
  $("#pop").click(function () {

    if ($(window).width() <= 768) {
      $("nav").hide();
    }
    $(window).scrollTop(0);
    url = post + '?popular=true';
    getForum(url);
  });
  $("#latest").click(function () {
    url = post + '?popular=false';
    getForum(url);
  });
  //only for pcard
  $("#pcard").click(function () {
    if ($(window).width() <= 768) {
      $("nav").hide();
    }
    $(window).scrollTop(0);
    pcard('https://people.cs.nctu.edu.tw/~hkwu0313/pcard/post');
  });
}
function pcard(url){
  $.ajax({
    url: url,
    type: "get",
    error: function () {
      $('#result').empty();
      $('#result').append("<p id='error'>ERROR 404</p>");
    },
    success: function (e) {
      $('#result').empty();
      for (i = 0; i < e.length; i++) {
        var date = dat(e[i].createdAt,false);
        $("#result").append("<div class='card' id='" + e[i].id + "' ><div class='title'>" + e[i].title + "</div>" + "<div class='content'><p style='word-wrap:break-word;'>" + pack(e[i].content) + "</p><span style='font-size:14px;position:absolute;right:3px;bottom:0;'><i>" + date + "</i></span></div>");
      }
    }
  });
}
function setting() {
  header_set();
  nav_set();
  //console set
  console.log('%c(*´艸`*)', 'color: #ff8000; font-size: 20px;');
}

function css_post() {
  $("body").css("overflow", "hidden");
  $("#result").css("filter", "blur(4px) brightness(0.4)");
  $("nav").css("filter", "blur(4px) brightness(0.4)");
  $("header").css("filter", "blur(4px) brightness(0.4)");
}

function css_nopost() {
  $("body").css("overflow", "auto");
  $("#result").css("filter", "");
  $("nav").css("filter", "");
  $("header").css("filter", "");
}

function pack(content) {
  return content.replace(/http\S*jpg|http\S*jpeg|http\S*png|http\S*gif/g, "<img src='$&' width='50%' style='margin:5% auto'>").replace(/\n/g, "<br>");
}

function dat(date,utc=true) {
  //example 2017-11-06 16:45:30
  var now = new Date();
  var n_y = now.getFullYear();
  if(utc){  
    var n_m = now.getUTCMonth() + 1;
    var n_d = now.getUTCDate();
    var n_h = now.getUTCHours();
    var n_min = now.getUTCMinutes();
  }
  else{
    var n_m = now.getMonth() + 1;
    var n_d = now.getDate();
    var n_h = now.getHours();
    var n_min = now.getMinutes();
  }
  var y = parseInt(date.slice(0, 4));
  var m = parseInt(date.slice(5, 7));
  var d = parseInt(date.slice(8, 10));
  var h = parseInt(date.slice(11, 13));
  var min = parseInt(date.slice(14, 16));
  if (y === n_y) {
    if (m === n_m) {
      if (d === n_d) {
        if (h === n_h) {
          return (n_min - min) + ("分鐘前");
        } else {
          return (n_h - h) + "小時前";
        }
      } else {
        return (n_d - d) + "天前";
      }
    } else {
      return (n_m - m) + "月前";
    }
  } else {
    return (n_y - y) + "年前"
  }
}

function getForum(url) {
  $.ajax({
    url: url,
    type: "get",
    error: function () {
      $('#result').empty();
      $('#result').append("<p id='error'>ERROR 404</p>");
    },
    success: function (e) {
      $('#result').empty();
      paste(e);
    }
  });
}

function paste(e) {
  for (i = 0; i < e.length; i++) {
    var date = dat(e[i].createdAt);
    $("#result").append("<div class='card' id='" + e[i].id + "' ><div class='title'>" + e[i].title + "</div>" + "<div class='content'>" + e[i].excerpt + "<span style='font-size:14px;position:absolute;right:3px;bottom:0;'><i>" + date + "</i></span></div>");
  }
  $(".card").click(function detail() {
    var card = $(this);
    var url = post + '/' + this.id;
    $.ajax({
      url: url,
      type: "get",
      error: function () {
        if ($(window).width() > 768) {
          $("#container").append("<div id='l'></div><div class='post' style='background-color:#333;color:#eee;text-align:center;font-size:1.4em;overflow:auto;'><img src='asset/img/icon/error.svg' width='50%' style='display:block;margin:5% auto;'>Oh！這篇文章已被作者刪除或被抓走了...</div><div id='r'></div>");
          /*********************post set********************************/
          css_post();
          $(".post").css("top", $(window).scrollTop());
          $("#l").css("top", $(window).scrollTop());
          $("#r").css("top", $(window).scrollTop());
          $("#l").click(function () {
            $(".post").remove();
            $("#l").remove();
            $("#r").remove();
            css_nopost();
          });
          $("#r").click(function () {
            $(".post").remove();
            $("#l").remove();
            $("#r").remove();
            css_nopost();
          });
        } else {
          card.contents(".content").hide();
          card.append("<div class='err' style='background-color:#333;color:#eee;text-align:center;font-size:1.4em;overflow:auto;'><img src='asset/img/icon/error.svg' width='50%' style='display:block;margin:5% auto;'>Oh！這篇文章已被作者刪除或被抓走了...</div>");
          card.off("click", detail);
          card.click(function excerpt() {
            card.contents(".content").show();
            card.contents(".err").remove();
            card.off("click", excerpt);
            card.on("click", detail);
            $(window).scrollTop(card.position().top - 40);
          });
        }
      },
      success: function (e) {
        var icon;
        if (e.gender == "F") icon = "asset/img/icon/female.svg";
        else if (e.gender) icon = "asset/img/icon/male.svg";
        else icon = "asset/img/icon/angel.svg";
        var like = e.likeCount,
          comment = e.commentCount;
        var content = pack(e.content);
        var date = dat(e.createdAt);
        if ($(window).width() > 768) {
          css_post();
          $("#container").append("<div id='l'></div><div class='post'><div class='post_title'>" + "<img src='" + icon + "' style='margin-right:10px;' >" + e.title + "<span style='position:absolute;right:10px;top:5%;font-size:14px;color:#7833a5;'>" + date + "</span></div>" + "<div class='article'>" + content + "</div><div class='bar'><img src='asset/img/icon/like.svg' style ='margin: 0 10px;'>" + "<span style='color:#bd494a;'>" + like + "</span>" + "<img src='asset/img/icon/comment.svg' style ='margin: 0 10px;'>" + "<span style='color:#006aa6;'>" + comment + "</span></div></div><div id='r'></div>");
          /*********************post set********************************/
          $(".post").css("top", $(window).scrollTop());
          $("#l").css("top", $(window).scrollTop());
          $("#r").css("top", $(window).scrollTop());
          $("#l").click(function () {
            $(".post").remove();
            $("#l").remove();
            $("#r").remove();
            css_nopost();
          });
          $("#r").click(function () {
            $(".post").remove();
            $("#l").remove();
            $("#r").remove();
            css_nopost();
          });
        } else {
          card.contents(".content").hide();
          card.append("<div class='article'>" + content + "</div><div class='bar'><img src='asset/img/icon/like.svg' style ='margin: 0 10px;'>" + "<span style='color:#bd494a;'>" + like + "</span>" + "<img src='asset/img/icon/comment.svg' style ='margin: 0 10px;'>" + "<span style='color:#006aa6;'>" + comment + '</span>');
          card.off("click", detail);
          card.click(function excerpt() {
            card.contents(".content").show();
            card.contents(".article").remove();
            card.contents(".bar").remove();
            card.contents(".comment").remove();
            card.off("click", excerpt);
            card.on("click", detail);
            $(window).scrollTop(card.position().top - 40);
          });
        }
        /**************************************************************/
        //get comment
        $.ajax({
          url: url + "/comments",
          type: "get",
          success: function (e) {
            for (i = 0; i < e.length; i++) {
              if (e[i].content == undefined) continue;
              var sch = e[i].school;
              if (sch == undefined) sch = "";
              //icon set
              var icon;
              if (e[i].gender == "F") icon = "asset/img/icon/female.svg";
              else if (e[i].gender) icon = "asset/img/icon/male.svg";
              else icon = "asset/img/icon/angel.svg";
              var content = pack(e[i].content);
              //show
              if ($(window).width() > 768) {
                $(".post").append("<div class='comment'><div class='comment_title'><img src='" + icon + "'  style='margin-right:5px; vertical-align:middle;' >" + sch + "<span style='position:absolute;right:10px;color:#7833a5;font-size:14px;'>B" + e[i].floor + "</span>" + "</div>" + "<div class='content'>" + content + "</div>");
              } else {
                card.append("<div class='comment'><div class='comment_title'><img src='" + icon + "' style='margin-right:5px ;' >" + sch + "<span style='position:absolute;right:10px; color:#7833a5;font-size:10px;'>B" + e[i].floor + "</span>" + "</div>" + "<div class='content'>" + content + "</div>");
              }
            }
          }
        });
      }
    });
  });
}

function getArticle(url) {
  $.ajax({
    url: url,
    type: "get",
    error: function () {
      $('#result').empty();
      $('#result').append("<p id='error'>ERROR 404<br>NOT FOUND</p>");
    },
    success: function (e) {
      var icon;
      if (e.gender == "F") icon = "asset/img/icon/female.svg";
      else if (e.gender) icon = "asset/img/icon/male.svg";
      else icon = "asset/img/icon/angel.svg";
      var like = e.likeCount,
        comment = e.commentCount;
      var content = pack(e[i].content);
      $("#container").append("<div id='l'></div><div class='post' id='" + e.id + "'><div class='title'>" + "<img src='" + icon + "'  style='margin-right:10px;' >" + e.title + "</div>" + "<div class='article'>" + content + "</div><div class='bar'><img src='asset/img/icon/like.svg' style ='margin: 0 10px;'>" + "<span style='color:#bd494a;'>" + like + "</span>" + "<img src='asset/img/icon/comment.svg' style ='margin: 0 10px;'>" + "<span style='color:#006aa6;'>" + comment + '</span>' + "</div></div><div id='r'></div>");
      /*********************post set********************************/
      getComment(url);
      css_post();
      $(".post").css("top", $(window).scrollTop());
      $("#l").css("top", $(window).scrollTop());
      $("#r").css("top", $(window).scrollTop());
      $("#l").click(function () {
        $(".post").remove();
        $("#l").remove();
        $("#r").remove();
        css_nopost();
      });
      $("#r").click(function () {
        $(".post").remove();
        $("#l").remove();
        $("#r").remove();
        css_nopost();
      });
    }
  });
}

function getComment(url) {
  $.ajax({
    url: url + "/comments",
    type: "get",
    success: function (e) {
      for (i = 0; i < e.length; i++) {
        if (e[i].content == undefined) continue;
        var sch = e[i].school;
        if (sch == undefined) sch = "";
        //icon set
        var icon;
        if (e[i].gender == "F") icon = "asset/img/icon/female.svg";
        else if (e[i].gender) icon = "asset/img/icon/male.svg";
        else icon = "asset/img/icon/angel.svg";
        var content = pack(e[i]);
        //show
        $(".post").append("<div class='comment'><div class='figure'><img src='" + icon + "' style='margin-right:5px;' >" + sch + "<br></div>" + "<div class='content'>" + content + "</div>");
      }
    }
  });
}

function renew() {
  if (url.search(/\?/) == -1) {
    url = url + "?before=" + $(".card")[$(".card").length - 1].id;
  } else if (url.search(/offset/) != -1) {
    var temp = url.split("=");
    url = temp[0] + "=" + temp[1] + "=" + (parseInt(temp[2]) + 30);
  } else if (url.search(/query/) != -1) {
    url = url + "&offset=30";
  } else if (url.search(/before/) != -1) {
    url = url.split("before")[0] + "before=" + $(".card")[$(".card").length - 1].id;
  } else {
    url = url + "&before=" + $(".card")[$(".card").length - 1].id;
  }
  $.ajax({
    url: url,
    type: "get",
    error: function () {
      renew();
    },
    success: function (e) {
      paste(e);
    }
  });
}

$(function () {
  setting();
  addforum();
  //defalut data
  pcard('https://people.cs.nctu.edu.tw/~hkwu0313/pcard/post');//getForum(url);
  /*
    //auto renew
    $(window).scroll(function () {
  //    if ($(window).width() <= 768) $("nav").hide();
  //$(this).scrollTop() >= $(document).height() - $(window).height()
        if ($(this).scrollTop() >= $(document).height() - $(window).height()) {
            renew();
        }
    });
    */
  //RWD
  $(window).resize(function () {
    if ($(window).width() < 766) {
      $("nav").hide();
      $("#cat_scroll").hide();
      $("#sch_scroll").hide();
    } else {
      $("nav").show();
      $("#cat_scroll").hide();
      $("#sch_scroll").hide();
      $(".cat").hide();
      $(".sch").hide();
    }
    if ($(window).width() < 485) $("#search").hide();
    else $("#search").show();
  });
});
/*
  //go to top  
    $("html,body").animate({
                scrollTop: 0
            }, 900);
            */
