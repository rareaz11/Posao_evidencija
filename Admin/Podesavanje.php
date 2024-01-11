<?php
print_r($_COOKIE);

session_start();

print_r($_SESSION);
require('../SYSTEM/AdminPrijava.php');
$rezbool=CheckAdmin();
if($rezbool==false)
{
  header("Location: ../log.php");
}

else{

require("../DB/veza.php");

//ovo tu vrijeme
$vrijmee=$_SESSION['timeNow']+8600;

//pamcenje odreedeno vremena korisnika
if($vrijmee<time())
{ require('../SYSTEM/metode.php');
  SpremiPromjene($conn,$_SESSION['ime'],"ODJAVA");
  Destroy_Session_Cookie();
   
}

if(isset($_POST['clic']))
{ require('../SYSTEM/metode.php');
  SpremiPromjene($conn,$_SESSION['ime'],"ODJAVA");
  Destroy_Session_Cookie();
}}

//cookies
$sqlcok="SELECT trajanje from cokki";
$rezcok=$conn->query($sqlcok);

$cokrezultat="";

foreach($rezcok as $ab)
{
  $cokrezultat=$ab['trajanje'];
}

  
//kod za stranicu---------------------------------------------------
 $sql="SELECT*FROM stranice";

$rez=$conn->query($sql);

 foreach($rez as $z){                
    $trnutno=$z['brPrikaza'];
 }
 


//---blokada korisnika

$sqlBlokada="SELECT*FROM blokiraj";

$rezBlokada=$conn->query($sqlBlokada);
$blokiraj=0;
 foreach($rezBlokada as $z){                
    $blokiraj=$z['nBroj'];
 }
 
if(isset($_POST['spremi']))
{
    $br=$_POST['broj'];
    $sql="UPDATE stranice SET brPrikaza=$br where brPrikaza=$trnutno";
    $conn->query($sql);
    require('../SYSTEM/metode.php');
  SpremiPromjene($conn,$_SESSION['ime'],"STRANICENJE");
}

if(isset($_POST['blok']))
{
    $br=$_POST['blokada'];
    $sql="UPDATE blokiraj SET nBroj=$br where nBroj=$blokiraj";
    $conn->query($sql);
    require('../SYSTEM/metode.php');
  SpremiPromjene($conn,$_SESSION['ime'],"MAX BROJ LOZINKA");
}

if(isset($_POST['backup']))
{
  require("backup.php");
}

if(isset($_POST['restore']))
{
 $file=$_POST['file'];
 
 print_r($file);

}

if(isset($_POST['cok']))
{
  $cokii=$_POST['cokvrj'];

  $sql="UPDATE cokki SET trajanje=$cokii where id=1";
    $conn->query($sql);
    require('../SYSTEM/metode.php');
  SpremiPromjene($conn,$_SESSION['ime'],"PROMJENA COOKIES");
}


//templates-------------------
$titleName="Podesavanje Sustava";
require("templates/header.php")
 ?> 

 
    </div>
    <div class="main">
      <div class="mainheader">
      </div>
             <div class="mainBody">
              <div class="postavke">

             

             <div class="one">
             <h2>  Trenutni broj prikaza po stranica je  :<?=$trnutno?> </h2>
              
              
                   
   
                   
            <form class="formP" action="Podesavanje.php" method="post">
            <label for="">Unesi novu vrijednost </label>   
            <input type="number" placeholder="uneste broj" name="broj" id="">
                <br>
                <button name="spremi">Spremi</button>
            </form>
     

             </div>

             <div class="two">

             <h2>Blokiranje korisnika nakon n pokusaja: <?= $blokiraj?></h2>
             
             

             <form class="formP"  action="Podesavanje.php" method="post">
              <label for="">Unesi novu vrijednost </label>
              <input type="number" name="blokada" placeholder="unesite broj">
             <br>
              <button name="blok">Spremi</button>
             </form>
             </div>
            
             </div>
       
            </div>

            <div>
              <form action="Podesavanje.php" method="post">
                
                <h2>PAZI! VRIJEDNOST UNOSI BROJCANU: 1H = 3600s</h2>
                <h2>2min=120</h2>
                <h2>Trenutno Cookies traje:<?= $cokrezultat?> </h2>
                <label for="">Upisi koliko zelite da traje cookie</label>
                <input type="number" name="cokvrj" id="">
                <button name="cok">Cookie</button>
              </form>
            </div>
           


            --------
            


          <div><h3>NAPRAVI BACKUP BAZE PODATAKA</h3>
        <form action="Podesavanje.php" method="post">
          <button name="backup">BACKUP</button>
        </form></div>

        -------------
          <h3>UCITAJ SIGURNOSNU KOPIJU</h3>
        <form action="Podesavanje.php" method="post">
  <input type="file"  name="file">
  <button name="restore"> Upload</button>
</form>
           
          
          
      
        
    </div>
    <script src="../Jscript/jsdodaj.js"></script>
<?php include('../templates/footer.php') ?>