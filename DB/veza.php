<?php
$lh="localhost";
$ro="root";
$pass="";
$db="evidencija_poslova";

$conn= new mysqli($lh,$ro,$pass,$db);

if($conn->connect_error)
{
    die("veza nije uspjela: " . $conn->connect_error);

}

?>