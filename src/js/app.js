$(document).ready(function () {
    $("#error").hide();
    $("#error4").hide();
    var c=0;
    $("#update1").click(function(e){
        e.preventDefault();
       if($("#firstname1").val()===""||$("#firstname1").val()===" ")
        {
            $("#d1").show()
            $("#d").text("First Name can not be empty");
            return false;
        }
        else
        {
            $("#d1").css('display','none');
        }
        if($("#lastname1").val()===""||$("#lastname1").val()===" ")
        {
            $("#f1").show();$("#f").text("Last name can not be empty");
            return false;
        }
        else
        {
            $("#f1").css('display','none');
             }
        if(!$("#Male1").prop('checked')&&!$("#Female1").prop('checked')&&!$("#other1").prop('checked'))
        {
            $("#g1").show();$("#g").text("Please Select your gender");
            return false;
        }
        else
        {
             $("#g1").css('display','none');
        var formData = $("#update2").serialize();
        $.ajax({
            type: "POST",
            url: "update.php",
            data: formData,
            cache: false,
        }).done(function (html) {
            if(html==="redirect")
            { location.reload();
                $("#msg").text("Your changes were successfull");
                $("#message_board").show().slideDown();
               }
            else
            {
                $("#message_board").show().slideDown().text(html);
            }
    });
}});
    $("#log_in").click(function(e){
        e.preventDefault();
        var formData = $("#log_form").serialize();
        $.ajax({
            type: "POST",
            url: "login.php",
            data: formData,
            cache: false,
        }).done(function (html) {
            if(html==='redirect')
            {
                $("#error").hide();
                $("#error4").hide();
                //console.log(html+"I am here");
                window.location.href="index.php";
            }
            else
            {
             //   alert("hello");
             $("#error4").show();
                $("#error5").empty().append(html);
               // console.log(html);
            }
        });
    });
    $("#cone").click(function (e) {
        e.preventDefault();
        var formData = $("#sign_form").serialize();
        var firstname=$("#firstname").val();
        var lastname=$("#lastname").val();
        var c=0;
        if(firstname===""||firstname===" ")
        {
            c++;
            $("#e_fname").show().empty().append("<h6 class='mdl-text mdl-color-text--red'>Please fill this field</h6>");
        }
        else
        {
            $("#e_fname").css("display","none");
        }
        if(lastname===""||lastname===" ")
        {
            c++;
            $("#e_lname").show().empty().append("<h6 class='mdl-text mdl-color-text--red'>Please fill this field</h6>");
        }
        else
        {
            $("#e_lname").css("display","none");
        }
        if(!$("#Male").prop('checked')&&!$("#Female").prop('checked')&&!$("#other").prop('checked'))
        {
            $("#e_gender").show();
            c++;
            $("#e_gender").empty().append("<h6 class='mdl-text mdl-color-text--red'>Please Select your gender</h6>");
        }
        else
        {
             $("#e_gender").css('display','none');
        }
        var email=$("#email").val();
        if(email===""||email===" ")
        {c++;
            $("#e_email").show().empty().append("<h6 class='mdl-text mdl-color-text--red'>Please enter your email</h6>");
        }
        else
        {
            $("#e_email").css("display","none");
        }
        var passw1,passw2;
        passw1=$("#passw").val();
        passw2=$("#passw2").val();
        if(passw1===""||passw1===" ")
        {
            c++;
            $("#e_passw").show().empty().append("<h6 class='mdl-text mdl-color-text--red'>Please enter a password</h6>");
            console.log("Hello there"+passw1);
        
        }
        else
        {
            $("#e_passw").css("display","none");
            }
        if(passw2===""||passw2===" ")
        {c++;
            $("#e_passw2").show().empty().append("<h6 class='mdl-text mdl-color-text--red'>Please enter the password again</h6>");
            //console.log(passw2);
        }
        else
        {
            $("#e_passw2").css("display","none");
        }
        if(passw1!==passw2)
        {
            c++;
            $("#e_passw3").show().empty().append("<h6 class='mdl-text mdl-color-text--red'>Passwords do not match</h6>");
        }
        else
        {
            $("#e_passw3").css("display","none");
        }
        var mobile=$("#phonenumber").val();
        if(mobile===""||mobile===" ")
        {   c++;
            $("#e_mobile").show().empty().append("<h6 class='mdl-text mdl-color-text--red'>Please enter your mobile number</h6>")
           }
            else
            {
                $("#e_mobile").css("display","none");
            }
        if(c===0)
        {
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
            }
            else if(html==="registered") 
            {
              //  $("#form1").hide();
                $("#error").show();
                $("#error1").empty().append('<h3>That email is already registered. Do you want to log in?</h3><button class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored mdl-color--primary" id="login_3" ><a  style="text-decoration:none;color:white;" href="login_form.php">Login</a></button>');
            }
            else {
                $("#error").show();
                $("#error1").empty().append(html);
                $("#firstname").val('');
                $("#lastname").val('');
                $("#email").val('');
                $("#passw").val('');
                $("#passw2").val('');
                $("#phonenmuber").val();
            }
        })}
        else
        {
            $("#error").hide();
        }
    }
 
);
    $("#error #error1").on('click', '#login_3', function () {
        $(".grid").css("background", "url(src/images/woodland-road-falling-leaf-natural-38537.jpeg)");
        $("#logon").show();
        $("#redirect").hide();
        $("#error1").hide();
        $("#sign_form").hide();
    });
});