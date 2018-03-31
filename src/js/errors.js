$(document).ready(function(){
    $("#sign_form").submit(function(){
       var x=$(this).serializeArray();
       $.each(x,function(i,field){
console.log(field.name);
console.log(field.value);
       });
    });
});