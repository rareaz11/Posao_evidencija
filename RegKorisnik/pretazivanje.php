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
  $poruka="Podatci";
  $mess="";
  //11 pretrazivanje podataka
if(isset($_POST['PretraziIme']))
{
    $ime=$_POST['ime'];

    if($ime=='')
    {
        $mess="polje za pretrazivanje prazano!!!";

    }
    else{
        $poruka=0;
        //ovo je za pretragu sa join sa 2 razlicita stupca npr datum prjave i di je kontakt jendako neki email iz 
      //  SELECT ime,prezime,prijavaVrijeme FROM korisnici JOIN prijavaposao ON prijavaposao.korisnikID=korisnici.korisniciID WHERE Date(prijavaposao.prijavaVrijeme)='2022-12-10' AND kontakt='marko23123';
$sqlKorisnici1=" SELECT ime,prezime,prijavaVrijeme FROM korisnici JOIN prijavaposao ON prijavaposao.korisnikID=korisnici.korisniciID where korisnickoIme='".$conn-> real_escape_string($ime)."'";

$rez=$conn->query($sqlKorisnici1);
    }


}
//zadatak 12 Sortiranje podataka --ispisuje sve poslove ,ime tvrtke, opis posla i vrijeme prijave odredenog korisnika silazno silazno po kratkom opisu
if(isset($_POST['SortirajTvrtku']))
{
    $prezime=$_POST['imeTvrtke'];

    if($prezime=="")
    {
        $mess="polje za pretrazivanje je prazno!!";
    }
    else
    {
        $poruka=1;
        //sve prijave za odredenu tvrtku
        //sortiranje
        $sqlKorisniciPrezime="SELECT nazivTvrtke, kratakOpis ,prijavaVrijeme FROM jobs JOIN
        prijavaposao on prijavaposao.posaoID=jobs.posaoID WHERE nazivTvrtke='".$conn->real_escape_string($prezime)."' ORDER BY kratakOpis";

        $rez1=$conn->query($sqlKorisniciPrezime);


    }
}
?>

        
        <?php

        //naslov
    $titleName="Pretrazi";
 
 include('templates/header.php');?>


    </div>
    <div class="main">
      <div class="mainheader">
       
       
      </div>
      <div class="mainBody">

      <div class="reg">
                 
                 <form action="pretazivanje.php" method="post">
               
                     <label for="">
                         Pretrazivanje korisnika po imenu:
                     </label>
                     <input type="text" name="ime" class="ime">
                     <br>
                   <button type="submit" name="PretraziIme"> Pretrazi</button>
                   
     
                 </form>
     
                 <hr>
                 <form action="pretazivanje.php" method="post">
     
                 <label for="">
                     Ime Tvrtke
                 </label>
                 <input type="text" name="imeTvrtke">
                 <br>
                 <button type="submit" name="SortirajTvrtku">Pretrazi</button>
                 </form>
     <?php  if($poruka==0){
     ?>
                 <hr>
                <table>
                 <caption>Pretraga korisnika po imenu </caption>
                 <tr>
                     <th>Ime</th>
                     <th>Prezime</th>
                     <th>Datum prijave</th>
     
     
                 </tr>
     
                 <?php
                 foreach($rez as $x)
                 {?>
                 <tr>
                     <td>
                         <?=htmlspecialchars($x['ime'])?>
                     </td>
                     <td>
                         <?=htmlspecialchars($x['prezime'])?>
                     </td>
                     <td>
                         <?=date('Y-m-d h:i:s',htmlspecialchars($x['prijavaVrijeme']))?>
                     </td>
                 </tr>
                     
                <?php }
                 ?>
                </table> <?php }
     
                else if ($poruka==1){ ?>
                     <table>
                         <caption>Sortiranje  poslova za firme po datumu prijave</caption>
                         <tr>
                             <th>Nziv Tvrtke</th>
                             <th>Ime posla</th>
                             <th>Datum prijave</th>
     
                         </tr>
                         <?php foreach($rez1 as $prezime)
                         {?>
                         <tr>
                             <td>
                                 <?=htmlspecialchars($prezime['nazivTvrtke'])?>
                             </td>
                             <td>
                                 <?=htmlspecialchars($prezime['kratakOpis'])?>
     
                             </td>
                             <td>
                                 <?=date('Y-m-d h:i:s',htmlspecialchars($prezime['prijavaVrijeme']))?>
                             </td>
                         </tr>
     
                         <?php } ?>
                     </table><?php }
                     else
                     { ?>
                        <h2><?= $mess ?></h2>
                    <?php } ?>
                     

                     
                 </div>
       
      </div>
      
        
    </div>
    <script src="../Jscript/jsdodaj.js"></script>
<?php include('../templates/footer.php') ?>
