<?php
$servername = 'localhost';
$username ="root";
$password= "";
$database="notes";

$conn =mysqli_connect($servername,$username,$password,$database);

//die if not working
if(!$conn){
  die("Sorry unable to connect to server" . mysqli_connect_error());
}

?>