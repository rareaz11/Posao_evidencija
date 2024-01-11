<?php

function Session()
{
 session_start();
 if(isset($_SESSION['ime']))
 {
   if(isset($_SESSION['isAdmin']))
   {
     header("Location:Admin/AdminNas.php");
   }

   else
   {
    header("Location: RegKorisnik/naslovnica.php");
   }
 }
}


?>