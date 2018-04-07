$(document).ready(function () {
    $("#error").hide();
    $("#error4").hide();
    $("#log_in").click(function(e){
        e.preventDefault();
        $("#error4").show();
        var formData = $("#log_form").serialize();
      //  console.log(formData);
        $.ajax({
            type: "POST",
            url: "login.php",
            data: formData,
            cache: false,
        }).done(function (html) {
            if(html==='redirect')
            {
                window.location.href="index.php";
            }
            else
            {
             //   alert("hello");
                $("#error5").empty().append(html);
               // console.log(html);
            }
        });
    });
    $("#cone").click(function (e) {
        e.preventDefault();
        $("#error").show();
        var formData = $("#sign_form").serialize();
        $.ajax({
            type: "POST",
            url: "signup.php",
            data: formData,
            cache: false,
        }).done(function (html) {
            if (html === 'redirect') {
                $("#firstname").val('');
                $("#lastname").val('');
                $("#email").val('');
                $("#passw").val('');
                $("#passw2").val('');
                $("#phonenmuber").val('');
                $(".grid").prepend('<div class="mdl-card mdl-shadow--2dp" style="text-align:center;height:5%;width:80%;margin: 0 auto;margin-top:25px;"><h2 class="mdl-text mdl-color-text--primary">Your Account was created Successully!Login to enjoy</h2></div>');
                $("#logon").show();
                $("#redirect,#redirect1").hide();
                $("#error1,#error5").hide();
                $("#sign_form").hide();
            } else {
                $("#error1").empty().append(html);
                $("#firstname").val('');
                $("#lastname").val('');
                $("#email").val('');
                $("#passw").val('');
                $("#passw2").val('');
                $("#phonenmuber").val('');
            }
        })
    });
    $("#error #error1").on('click', '#login_3', function () {
        $(".grid").css("background", "url(src/images/woodland-road-falling-leaf-natural-38537.jpeg)");
        $("#logon").show();
        $("#redirect").hide();
        $("#error1").hide();
        $("#sign_form").hide();
    });
});