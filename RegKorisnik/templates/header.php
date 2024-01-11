
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
           <a href="naslovnica.php">Pregledaj Poslove</a>
          
           <a href="pretazivanje.php" class="aa">Pretrazi</a>
           <a href="evidencija.php">Evidencija</a>
        </div>
        <div class="headerr">
           
      
            <form action="naslovnica.php" method="post">
            <button name="clic"><?=$_SESSION['ime']?>-LOG OUT</button>
            </form>
       
           
           
        </div>