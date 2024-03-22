<?php
    require '../vendor/autoload.php';

    if (isset($_POST)){
    // mongoDB connection 
        $databaseConnection= new MongoDB\Client('mongodb://localhost:27017');
        $myDatabase = $databaseConnection->users;
        $userCollection = $myDatabase->useraccount;
        if(!$userCollection){
            die("Error" );
        }

        // Mysql connection
        $con = mysqli_connect("localhost:3307", "root", "root", "users");

        if (!$con) {
            die("Error" );
        }

            $name = $_POST["name"];
            $email = $_POST["email"];
            $dob = $_POST["birthDate"];
            $phoneNumber = $_POST["phoneNumber"];
            $gender = $_POST["gender"];
            $password = $_POST["password"];

            if(empty($name) || empty($email) || empty($dob) || empty($phoneNumber) || empty($gender) || empty($password)){
                echo "empty";
                die("");
            }

            $sql = "select * from useraccount where email='$email' and password='$password'";

            $result = mysqli_query($con,$sql);
            $noofrow = mysqli_num_rows($result);

            if($noofrow > 0){
                echo "exists";
                die("");
            }

            $data = array(
                "Name" => $name,
                "Email" => $email,
                "Dob" => $dob,
                "Gender" => $gender,
                "Phonenumber" => $phoneNumber,
                "Password" => $password
            );

            //insert into mongodb users collections
            $insert = $userCollection->insertOne($data);

            if($insert) {
                // Prepare SQL statement with prepared statement
                $sql = "INSERT INTO useraccount (name, email, dob, phonenumber, gender, password) VALUES (?, ?, ?, ?, ?, ?)";
                $stmt = mysqli_stmt_init($con);

                if (mysqli_stmt_prepare($stmt, $sql)) {
                    mysqli_stmt_bind_param($stmt, "ssssss", $name, $email, $dob, $phoneNumber, $gender, $password);
                    
                    if (mysqli_stmt_execute($stmt)) {
                        echo "success";
                        die();
                    } else {
                        echo "Error";
                    }

                    // Close statement
                    mysqli_stmt_close($stmt);
                } else {
                    echo "Error";
                }

                // Close connection
                mysqli_close($con);
            }

            else echo "fail";
    }

?>

