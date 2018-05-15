$(document).ready(function(){
  $("#upload").click(function () {
      $("#upload_form").show();
      $("#updatepicturemessage").empty();
    });
    $("#close1").click(function (e) {
      $("#upload_form").css("display", "none");
      e.preventDefault();
    });
    $('#front .mdl-card__title,#front1 .mdl-card__title').css("background", "url(src/images/output5.webp) center / cover");
    var h = ["output5.webp", "output4.webp", "output1.webp", "output2.webp", "output3.webp"];
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