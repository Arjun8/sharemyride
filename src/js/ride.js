$(document).ready(function(){
    $("#search2").click(function(){
        var formdata=$("#offer_form").serialize();
        $.ajax(
            {
                type:"POST",
                url:"ride.php",
                data:formdata,
                cache: false
            }
        );
    })
});