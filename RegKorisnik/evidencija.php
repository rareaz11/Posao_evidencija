<?php
session_start();

$mess="";
print_r($_COOKIE);

   
 print_r($_SESSION);
  require("../DB/veza.php");
  require('../SYSTEM/prov_prijava.php');
  
 //ovo tu vrijeme
    $vrijmee1=$_SESSION['timeNow']+8600;

    if($vrijmee1< time())
    { require_once('../SYSTEM/metode.php');
      SpremiPromjene($conn,$_SESSION['ime'],"ODJAVA");
       Destroy_Session_Cookie();
        
    }
  if(isset($_POST['clic']))
  { require_once('../SYSTEM/metode.php');
   
    SpremiPromjene($conn,$_SESSION['ime'],"ODJAVA");
   Destroy_Session_Cookie();
     
  }

  $korisnik=$_COOKIE['user'];
  $sqlKor="SELECT korisniciID FROM korisnici where korisnickoIme='$korisnik'";
  $kor=$conn->query($sqlKor);
  $sqlID=$kor->fetch_array(MYSQLI_ASSOC); //ovdje id
  $sqlID=$sqlID['korisniciID'];


  $sql="SELECT nazivTvrtke,kratakOpis,tipUgovora,jobs.posaoID FROM jobs JOIN prijavaposao ON prijavaposao.posaoID=jobs.posaoID WHERE korisnikID=$sqlID";

  $myRes=$conn->query($sql);
//brisanje prijave za posao
  if(isset($_POST['izbrisi']))
  {

    $idPosao=$_POST['posao'];
    
    $sql="DELETE FROM prijavaposao where posaoID=$idPosao and korisnikID=$sqlID";
    
    $conn->query($sql);

    require_once('../SYSTEM/metode.php');
    SpremiPromjene($conn,$_SESSION['ime'],"BRISANJE PRIJAVE");

  }



?>
        
           

<?php $titleName="Evidencija"; 
include('templates/header.php')?>
    </div>
    <div class="main">
      <div class="mainheader">
       
       
      </div>
      <div class="mainBody">
      <h1>MOJE PRIJAVE</h1>
           
      <table>
        <tr>
            <th>*</th>
            <th>NAZIV TVRTKE</th>
            <th>KRATAK OPIS</th>
            <th>TIP UGOVORA</th>
        </tr>

        <?php
        $count=1;
        foreach($myRes as $x)
        {
        ?>
        <tr><td><?=$count?></td>
            <td><?=htmlspecialchars($x['nazivTvrtke']);?></td>
            <td><?=htmlspecialchars($x['kratakOpis']);?></td>
            <td><?= htmlspecialchars($x['tipUgovora']);?></td>
            <td>
                <form action="evidencija.php" method="post">
                    
                    <input type="hidden" name="posao" value="<?= htmlspecialchars($x['posaoID']);?>">
                    <button name="izbrisi">
                        IZBRISI</button>
                </form>
            </td>
    
    </tr>

        <?php
       $count++; }
        ?>
      </table>
       
      </div>
      
        
    </div>
    <script src="../Jscript/jsdodaj.js"></script>
<?php include('../templates/footer.php') ?>