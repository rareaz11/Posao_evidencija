<?php


    session_start();

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
   $mess="";
//operacija poslovi
$sqlBroj="SELECT*FROM jobs";
//--ukljuciavanje sstranicenja
require("../SYSTEM/stranicenje.php");
$rezKorisnika=$conn->query($sqlBroj);
//broj rows u iz sql-a
$brojposao=mysqli_num_rows($rezKorisnika);
//stavaljamo metodu za stranicenje 
$stranicePosao=PodesiStranice($conn,$brojposao);

$limitIspis=$stranicePosao[0];
 $off=$stranicePosao[1];
 $brstr=$stranicePosao[2];

 if(isset($_POST['noviBrojac']))
 {

  $off=$_POST['noviBrojac'];

  $sql="SELECT*FROM jobs LIMIT $limitIspis OFFSET $off";

  $rez=$conn->query($sql);



 }
 //prijava na posao
if(isset($_POST['prijavise']))
{
  $off=$_POST['noviBrojac'];
  $id=$_POST['id'];
  $korisnik=$_COOKIE['user'];

  $sql="SELECT*FROM jobs LIMIT $limitIspis OFFSET $off";

  $rez=$conn->query($sql);
  //dohvati id korisnika
  $sqlKor="SELECT korisniciID FROM korisnici where korisnickoIme='$korisnik'";

  $kor=$conn->query($sqlKor);
  $sqlID=$kor->fetch_array(MYSQLI_ASSOC); //ovdje id
  $sqlID=$sqlID['korisniciID'];
/* poruka */
$testiraj="SELECT ime,prezime FROM korisnici JOIN 
prijavaposao ON prijavaposao.korisnikID=korisnici.korisniciID where posaoID=$id and korisniciID=$sqlID";
//jel se vec prijavio
$testBroj=mysqli_num_rows($conn->query($testiraj));

 if($testBroj==0){


  
  //------------------
  //drugi dio
 $novoP=time();
  $sqlPosao="INSERT INTO prijavaposao(posaoID,korisnikID,prijavaVrijeme)
  Values('".$conn->real_escape_string($id)."',
  '".$conn->real_escape_string($sqlID)."',
  '".$conn->real_escape_string($novoP)."')";
  
  $conn->query($sqlPosao);
  require_once('../SYSTEM/metode.php');
  SpremiPromjene($conn,$_SESSION['ime'],"PRIJAVA POSAO");
 }

 else
 {
  $mess="VEC STE SE PRIJAVILI NA OVAJ POSAO";

 }
  


}
 
else
{
  $sql="SELECT*FROM jobs LIMIT $limitIspis OFFSET $off";

  $rez=$conn->query($sql);


}



//alll


  //naslov
    $titleName="Naslovnica Korisnik";

 include('templates/header.php');


 ?> 
 
    </div>
    <div class="main">
      <div class="mainheader">
   
       
      </div>
             <div class="mainBody">

             <?php if($mess==""){?>

              <table>
                <tr>
                  <th>*</th> <th>NAZIV TVRTKE</th> <th>OPIS</th> <th>STRUCNA SPREMA</th> <th> UGOVOR</th> <th>KATEGORIJA POSLA</th>
                </tr>
                <?php $count=1;
                foreach($rez as $x){ ?> 
                
                
                
                <tr>
                  <td><?=htmlspecialchars($x['posaoID']);  ?></td>
                  <td><?=htmlspecialchars($x['nazivTvrtke']);?></td>
                  <td><?=htmlspecialchars($x['kratakOpis']);?></td>
                  <td><?=htmlspecialchars($x['strucnaSprema']);?></td>
                  <td><?=htmlspecialchars($x['tipUgovora']);?></td>
                  <td><?=htmlspecialchars($x['kategorijaPosla']);?></td>
                  <td>
                    <form action="naslovnica.php" method="post">
                    <input type="hidden" name="noviBrojac" value="<?=$off?>">
                      <input name="id" type="hidden" value="<?=htmlspecialchars($x['posaoID']);?>">
                      <button name="prijavise">Prijavi se</button>
                    </form>
                  </td>
                </tr>
                
                
                
                <?php 
              $count++;
              
              }
              ?>
              </table>

       
     
       <div class="regKor">
        <?php for($i=1; $i<$brstr+1;$i++) { ?>

              <form action="naslovnica.php" method="post">
                <?php
                $off=$limitIspis*($i-1);
                ?>
                <input type="hidden" name="noviBrojac" value="<?=$off?>">

                <button name="<?=$i?>"><?=$i?></button>
              </form>
          <?php } ?>
       </div>
       <?php } 
       
       else{?>   
       
          <h1><?=$mess?></h1>
       <?php  } ?>
            </div>
            
      
            <script src="../Jscript/jsdodaj.js"></script>
    </div>
<?php include('../templates/footer.php') ?>