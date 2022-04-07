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

//LAST UPDATED APRIL 6   9:03 PM     *****************
//sending email

$to = $email;
$subject = 'Bienvenido a PaMiTierra Envios :)!';
$message = '<body style="background-color: #ffffff; color: #00002f; text-align: center">
            <h1>Bienvenido(a), ' .$firstName. '.</h1><h1>Hemos confirmado tu cuenta!</h1>
            <h1 style="color: #2438e9">Numero de casillero: '.$locker.'</h1>
            <br><br>
            <a href="https://pamitierraenvios.com"><img src="https://pamitierraform.000webhostapp.com/personaje%20de%20envios-01.png" width="400"></a>
            <a href="https://pamitierraenvios.com"><h3>pamitierraenvios.com</h3></a></body>';

$headers = "From: PaMiTierra Envios<tobymiller2021@gmail.com>\r\n";
$headers .= "Reply-To: tobymiller2021@gmail.com\r\n";
$headers .= "Content-type: text/html\r\n";

mail($to, $subject, $message, $headers);



$conn->close();