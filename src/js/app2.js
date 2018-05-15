$("#book_b").click(function (e) { 
    e.preventDefault();
    var seats=$("#calc").val().trim();
    var c=0;
    if(seats==="")
    {
        c++;
        $("#err_1").show().append("<h6 class='class='mdl-text mdl-color-text--red'>Please enter number of seats</h6>");
    }
    else
    {
        $("#err_1").css("display","none");
    }
    if(c===0)
    {
    var formData=$("#book_form").serialize();
    $.ajax({
        type: "POST",
        url: "book2.php",
        data: formData,
        cache: false,
    }).done(function (html) {
        if(html==='Redirect')
        {
            window.location.href="index.php";
        }
    });

 }})
 $("#fget").click(
     function (e) {
         e.preventDefault();
         var c=0;
         var email=$("#email").val().trim();
         if(email==="")
         {c++;
             $("#err_2").show().append("<h6 class='class='mdl-text mdl-color-text--red'>Please enter a email</h6>");
         }
         else
         {
             $("#err_2").css("display","none");
         }
         if(c===0)
         {
            var formData=$("#pwd_form").serialize();
            $.ajax({
                type: "POST",
                url: "forgetpwd.php",
                data: formData,
                cache: false,
            }).done(function (html) {
                if(html==="continue")
                {
                    window.location.href="reset.php";
                }
                else
                {
                    $("#msg_board1").show();
                    $("#msg_board").text(html);
                }
               })
         }
               }
 );
 $("#pwd_button").click(
    function (e) {
        e.preventDefault();
        var c=0;
        var pwd=$("#pwd").val().trim();
        var cpwd=$("#cpwd").val().trim();
        if(pwd==="")
        {c++;
            $("#err_3").show().append("<h6 class='class='mdl-text mdl-color-text--red'>Please enter a password</h6>");
        }
        else
        {
            $("#err_3").css("display","none");
        }
        if(cpwd==="")
        {c++;
            $("#err_4").show().append("<h6 class='class='mdl-text mdl-color-text--red'>Please enter a password</h6>");
        }
        else
        {
            $("#err_4").css("display","none");
        }
        if(pwd!==cpwd)
        {c++;
            $("#err_5").show().append("<h6 class='class='mdl-text mdl-color-text--red'>Password does not match</h6>");
        }
        else
        {
            $("#err_5").css("display","none");
        }
        if(c===0)
        {
           var formData=$("#reset").serialize();
           $.ajax({
               type: "POST",
               url: "alterpwd.php",
               data: formData,
               cache: false,
           }).done(function (html) {
               if(html==="continue")
               {
                   $("#error4").show();
                   $("#error5").show().append("Your password was successfullly changed login to continue");
                   window.location.href="login_form.php";
               }
              })
        }
              }
);
$("#otp_button").click(
    function(e){
e.preventDefault();
var c=0;
var otp=$("#otp").val().trim();
if(otp==="")
{
    c++;
    $("#otp2").show().append("<h6 class='class='mdl-text mdl-color-text--red'>Please enter the otp</h6>");
}
else
{
    $("#otp2").css("display","none");
}
if(c===0)
{
    var formData=$("#otp5").serialize();
    $.ajax({
        type: "POST",
        url: "verify.php",
        data: formData,
        cache: false,
    }).done(function (html) {
        if(html==="continue")
        {
            $("#otp5").css("display","none");
            $("#otp2").empty().show().append("<h6 class='class='mdl-text mdl-color-text--red'>Your otp was correct</h6>");
            window.location.href="newpwd.php";
        }
        else if(html==="dcontinue")
        {
            $("#otp2").show().append("<h6 class='class='mdl-text mdl-color-text--red'>Please enter the correct otp</h6>");
        }
       })
 
}
    }
);