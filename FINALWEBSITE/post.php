<?php

//receives data values from fetch and stores in variables
$firstName = $_POST['firstName'];
$lastName = $_POST['lastName'];
$lastName2 = $_POST['lastName2'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$address = $_POST['address'];
$locker = $_POST['locker'];



//database information
$servername = "localhost:3306";
$username = "root";
$password = "password";
$database = "userdatabase";


//connecting to database
$conn = new mysqli($servername, $username, $password, $database);

//building database query
$sql = "INSERT INTO users (firstname, lastname, lastname2, phone, email, address, locker)
VALUES (?,?,?,?,?,?,?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("sssssss", $firstName, $lastName, $lastName2, $phone, $email, $address, $locker);

//executing query
$stmt->execute();
echo "posting into databse...";
echo $firstName." was registered successfully!...";

//sending email

$to = $email;
$subject = 'Bienvenido a PaMiTierra Envios :)!';
$message = '<h1>Bienvenido.</h1><p>Hemos confirmado tu cuenta!</p><p>Numero de casillero: #00000</p>';

$headers = "From: PaMiTierra Envios<tobymiller2021@gmail.com>\r\n";
$headers .= "Reply-To: tobymiller2021@gmail.com\r\n";
$headers .= "Content-type: text/html\r\n";

mail($to, $subject, $message, $headers);


$stmt->close();
$conn->close();