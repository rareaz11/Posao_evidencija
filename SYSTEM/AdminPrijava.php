<?php

//znaci ako nije prijava nema ulaska
//ako korincko ime nije postavljeno nema ulaska
function CheckAdmin()
{
    if((!isset($_SESSION['ime'])))
{
    
    return false;
}

if(!isset($_SESSION['isAdmin']))
{
    
    return false;
}

else
{
    return true;
}
}

?>