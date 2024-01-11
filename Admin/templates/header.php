<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=$titleName?></title>
    <link rel="stylesheet" href="../Css/style.css">   
</head>
<body>
<div class="grid">
    <div class="header">
    <button class="btnOpen">
               Open Menu
            </button>
        <div class="skriveni">
            
                <button class="btnClose">
                    Close
                </button>
        </div>
        <div class="headerl">
           <a href="AdminNas.php">Home</a>
           <a href="allJobs.php">Poslovi</a>
           <a href="dodajPosao.php">Dodaj Posao</a>
           <a href="Podesavanje.php">Podesi Sustav</a>
           <a href="pregledRacuna.php" >Aktivacija Korisnika</a>
           <a href="statistike.php">Statistike</a>
        </div>
        <div class="headerr">
           
        <a href="brisiSve.php"><?=$_SESSION['ime']?></a>  
            
           <a href=""><form action="AdminNas.php" method="post">
                <button name="clic">Unisti</button>
            </form></a>
        </div>