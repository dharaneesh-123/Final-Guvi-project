<?php
    require '../vendor/autoload.php';

if(isset($_POST)) {
    $email = $_POST["email"];
    $pass = $_POST["pass"];

    $con = mysqli_connect("localhost:3307", "root", "root", "users");
    $sql = "select * from useraccount where email='$email' and password='$pass'";

    $result = mysqli_query($con,$sql);
    $noofrow = mysqli_num_rows($result);

    if($noofrow == 1) {

        $databaseConnection= new MongoDB\Client('mongodb://localhost:27017');
        $myDatabase = $databaseConnection->users;
        $userCollection = $myDatabase->useraccount;

        if(!$userCollection){
            die("Connection failed to connect to Database/Collection " );
        }

        $item = $userCollection->findOne(array('Email' => $email));
        $data = $item->jsonSerialize();

        if(!empty($data)){
            echo "Login##";
            echo $data->_id . "##" .$data->Name . "##". $data->Email ."##". $data->Dob ."##". $data->Gender ."##". $data->Phonenumber;
            die();
        }

        echo "Error";

        // while($row) {
        //     echo "id: " . $row["userid"]. "<br> Name : " . $row["name"]. "<br> " . "Email : ". $row["email"]. "<br>";
        //     echo "DOB : " . $row["dob"] . "<br> PhoneNumber : " . $row["phonenumber"] ."<br> Gender : ".$row["gender"]; 
        //     $row = mysqli_fetch_assoc($result);
        // }
    }
    else echo "Not exists";
}
else echo "Get method not allowed";

?>
