$(document).ready(
  function () {
    $("#map").css("display","none");
    $("#map1").css("display","none");
    $("#ride2").css("display","none");
    $("#account").click(function(e){
      $("#first").css("display","none");
      $("#com").css("display","none");
      $("#map").css("display","none");
      $("matrix").css("display","none");
      $("#error").css("display","none");
      $("#map1").css("display","none");
      $("#grid1").css("display","none");
      $("#grid2").css("display","none");
      $("#ride2").css("display","none");
      $("#form1").css("display","none");
      $('#f_ride').css("display","none");
      $('#matrix2').css("display","none");
      $("#settings").show();
      e.preventDefault();
    });
    $("#upload").click(function(){
      $("#upload_form").show();
      $("#updatepicturemessage").empty();
    });
    $("#close1").click(function(e){
      $("#upload_form").css("display","none");
      e.preventDefault();
     });
        $("#login_1,#login_2,#login3").click(function (e) {
      $("#first").css("display","none");
      $("#com").css("display","none");
      $("#map").css("display","none");
      $("matrix").css("display","none");
      $("#error").css("display","none");
      $("#map1").css("display","none");
      $("#ride2").css("display","none");
      $("#form1").css("display","none");
      $('#f_ride').css("display","none");
      $('#matrix2').css("display","none");
      $("#settings").css("display","none");
      $(".grid").css("background", "url(src/images/woodland-road-falling-leaf-natural-38537.jpeg)");
      $("#logon").show();
      e.preventDefault();
    });
    $('#ride').click(function () {
      $("#first").css("display","none");
      $("#error").css("display","none");
      $("#error4").css("display","none");
      $("#grid1").css("display","none");
      $("#grid2").css("display","none");
      $("#hello2").css("display","none");
      $("#settings").css("display","none");
      $(".grid").css("background", "url(src/images/woodland-road-falling-leaf-natural-38537.jpeg)");
      $('#com').show();
      $('#f_ride').show();
      $("#map").show();
    });
    $('#off_ride').click(function (e) {
      $("#first").css("display","none");
      $("#grid1").css("display","none");
      $("#grid2").css("display","none");
      $("#settings").css("display","none");
      $("#error").css("display","none");
      $("#hello2").css("display","none");
      $(".grid").css("background", "url(src/images/woodland-road-falling-leaf-natural-38537.jpeg)");
      $('#com').show();
      $('#ride2').show();
      $("#map").show();
      e.preventDefault();
    });
    $("#sign_up ,#sign_up1").click(function (e) {
      $("#first").css("display","none");
      $("#com").css("display","none");
      $('#f_ride').css("display","none");
      $("#settings").css("display","none");
      $("#logon,#error4").css("display","none");
      $(".grid").css("background", "url(src/images/woodland-road-falling-leaf-natural-38537.jpeg)");
      $("#form1").show();
      e.preventDefault();
    });
    $('#front .mdl-card__title,#front1 .mdl-card__title').css("background", "url(src/images/pexels_photo.jpg) center / cover");
    var h = ["pexels_photo.jpg", "pexels_photo_207171.jpg", "pexels_photo_386009.jpg", "pexels_photo_894359.jpg", "california-road-highway-mountains-63324.jpeg"];
    var f = ["Share a ride", "Cheaper and Easy", "Less Time consuming", "Grow Socially"];
    var m = ["Help yourself and environment by sharing a ride", "Choose from a large number of available rides", "Cheaper and eco-friendly!", "Carpooling can provide you with new friendships and company for your commute."];
    var k = 0;

    function setImage() {
      if (k < 5) {
        $('#front .mdl-card__title,#front1 .mdl-card__title').css("background", "url(src/images/" + h[k] + ") center / cover")
        $(".mdl-card__supporting-text p").text(f[k]);
        $('.mdl-car_title-text p').text(m[k]);
        k++;
      } else {
        k = 0;
      }
    }
    //setInterval(function(){setImage()},2000);
    var j = 1;
    $('#next').click(function () {
      if (j <= 4) {
        $('#front .mdl-card__title,#front1 .mdl-card__title').css("background", "url(src/images/" + h[j] + ") center / cover");
        $(".mdl-card__supporting-text p").text(f[j]);
        $('.mdl-car_title-text p').text(m[j]);

        j++;
      } else {
        j = 0;
      }
    });
    $('#previous').click(function () {
      if (j >= 0) {
        $('#front .mdl-card__title,#front1 .mdl-card__title').css("background", "url(src/images/" + h[j] + ") center / cover");
        $(".mdl-card__supporting-text p").text(f[j]);
        $('.mdl-car_title-text p').text(m[j]);

        j--;
      } else {
        j = 4;
      }
    });
  }
);