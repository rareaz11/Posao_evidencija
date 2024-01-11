<?php

//znaci ako nije prijava nema ulaska
if((!isset($_SESSION['ime'])))
{
    header("Location: ../log.php");
}

if((isset($_SESSION['isAdmin'])))
{
    header("Location: ../log.php");
}


?>