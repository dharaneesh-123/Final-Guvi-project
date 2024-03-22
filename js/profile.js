data = JSON.parse(localStorage.getItem("$ecre1"));
$("#name").text(data["Name"]);
$("#email").text(data["Email"]);
$("#dob").text(data["Dob"]);
$("#gender").text(data["Gender"]);
$("#phonenumber").text(data["Phonenumber"]);

$("#logout").on('click',function(){
    $.ajax({
        url: 'php/profile.php',
      type: 'POST',
      data: $(this).serialize(),
      success:function(response){
        console.log(response);
      }
    });
    localStorage.removeItem("$ecre1");
    window.location.href = "http://localhost/guvi-project/";
})

$("#updatebtn").on('click',function(e){
    e.preventDefault();
    $.ajax({
        url: 'php/profile.php',
      type: 'POST',
      data: $("#form").serialize(),
      success:function(response){
        console.log(response);
        if(response.trim() === "success"){
            alert("Your Password updated Successfully");
        }
        else{
            alert("Error please try again");
        }
      }
    });
})
