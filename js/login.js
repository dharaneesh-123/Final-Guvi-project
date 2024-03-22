
$("#login").on('click',function(){
  var email = $("#email").val();
   var pass = $("#password").val();

   if( email == '' || pass == "" ){
      alert("fill all the details");
      return;
   }
   else{
      if(!email.endsWith("@gmail.com") || !email.endsWith(".com") || !email.includes("@") ) {alert("Give proper email address");return;}
      if(pass.length <= 8) {alert("Password length should be greater than 8."); return;}
   }

  $.ajax({
      url: 'php/login.php',
      type: 'POST',
      data: $("#form").serialize(),
      success:function(response){
        data = response.trim().split("##");
          if(data[0] === "Login"){
            alert("Login Successfully");
            dataJson = {"Id" :data[1],"Name":data[2],"Email":data[3],"Dob":data[4],"Gender":data[5],"Phonenumber":data[6] };
            localStorage.setItem("$ecre1",JSON.stringify(dataJson));
            console.log(dataJson);
            window.location.href = "http://localhost/guvi-project/profile.html";

          }
          else if(response.trim() === "Not exists"){
            alert("Account does not exists, Please create a account");
            window.location.href = "http://localhost/guvi-project/register.html";
          }
          else{
            alert("Error Please try again");
            window.location.reload();
          }
      }
  })
});