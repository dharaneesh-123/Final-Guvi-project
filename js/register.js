$("#register").on('click',function(){
    var name = $("#name").val();
    var email = $("#email").val();
    var dob = $("#dob").val();
    var phone = $("#phoneno").val();
     var male = $("#male").val();
     var female = $("#female").val();
     var pass = $("#password").val();
     var repass = $("#repassword").val();

     if(name =='' || email == '' || dob == '' || phone == '' || (male ==''  && female =="") || pass == "" || repass == ""){
        alert("fill all the details");
        return;
     }
     else{
        if(name.length < 3 ) {alert("Name should contains minimum length of 3");return;}
        if(!email.endsWith("@gmail.com") || !email.endsWith(".com") || !email.includes("@") ) {alert("Give proper email address");return;}
        var d = new Date(dob);
        if(d.getFullYear() < 1900 || d.getFullYear() > 2024){ alert("Year is invalid");return;}
        if(phone.length != 10) {alert("Phone number must be length 10"); return;}
        var regExp = /[a-zA-Z]/g;
        if(regExp.test(phone)) {alert("phone number should only contains numbers");return;}

        if(!(pass === repass)) {alert("Password is not matching.");return;}
        if(pass.length <= 8) {alert("Password length should be greater than 8.");return;}
     }

    $.ajax({
        url: 'php/register.php',
        type: 'POST',
        data: $("#form").serialize(),
        success:function(response){
            if(response.trim() === "success"){
                alert("Registered successfully");
                window.location.href='http://localhost/guvi-project/login.html';
            }
            else if(response.trim() === "empty"){
                alert("Field should not be empty");
                window.location.reload();
            }
            else if(response.trim() === "exists"){
                alert("Account already exists");
                window.location.reload();
            }
            else{
                alert("Error on the database connection");
                window.location.reload();
            }
        }
    })
});