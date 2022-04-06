<?php

//OMAR************************************************************************
// !!!!         LAST UPDATED 04/05/22 11:42 PM




//receives data values from fetch and stores in variables...
$firstName = $_POST['firstName'];
$lastName = $_POST['lastName'];
$lastName2 = $_POST['lastName2'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$address = $_POST['address'];
$locker = $_POST['locker'];



//database information[LOCAL]
$servername = "localhost:3306";
$username = "root";
$password = "password";
$database = "userdatabase";
//database information[HOSTING]
/*
$servername = "localhost";
$username = "id18712288_root";
$password = "19930507oD!@";
$database = "id18712288_userdatabase";
*/

//connecting to database...
$conn = new mysqli($servername, $username, $password, $database);

//first query to see if the email submitted is already in our database...

    $sql = "SELECT * FROM users WHERE email= ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s",$email);
//executing query...
    $stmt->execute();
    $result = $stmt->get_result(); //gets result object and stores it in variable...
    $rows = mysqli_num_rows($result); //gets number of rows of object and stores in variable...
    $stmt->close(); //close stmt object

    if($rows > 0){ //if rows are greater than 0 it means an email is already in the db...
        echo "false";
    }else{//if not, then store user with new query....
        $sql2 = "INSERT INTO users (firstname, lastname, lastname2, phone, email, address, locker)
                    VALUES (?,?,?,?,?,?,?)";
        $stmt = $conn->prepare($sql2);
        $stmt->bind_param("sssssss", $firstName, $lastName, $lastName2, $phone, $email, $address, $locker);
        $result = $stmt->execute();
        $stmt->close();
        if($result === false){ //if execution returns 'false' an error happened...
            echo "false";
        }else{//if returns 'true' it was successful...
            echo "true";

        }
    }


//sending email

$to = $email;
$subject = 'Bienvenido a PaMiTierra Envios :)!';
$message = '<h1>Bienvenido.</h1><p>Hemos confirmado tu cuenta!</p><p>Numero de casillero: #00000</p>';

$headers = "From: PaMiTierra Envios<tobymiller2021@gmail.com>\r\n";
$headers .= "Reply-To: tobymiller2021@gmail.com\r\n";
$headers .= "Content-type: text/html\r\n";

mail($to, $subject, $message, $headers);



$conn->close();