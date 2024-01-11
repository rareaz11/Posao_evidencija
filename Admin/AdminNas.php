<?php
print_r($_COOKIE);

    session_start();
print"<br>";
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
//--br prijava
$sqlBrPrijava="SELECT COUNT(*) AS br from dogadaj where opis='PRIJAVA'";
$rezPrijava=$conn->query($sqlBrPrijava);
$sqlBrPrijava=mysqli_fetch_array($rezPrijava);
$sqlBrPrijava=$sqlBrPrijava['br'];
//--br odjava
$sqlBrOdjava="SELECT COUNT(*) AS br from dogadaj where opis='ODJAVA'";
$rezOdjava=$conn->query($sqlBrOdjava);
$sqlBrOdjava=mysqli_fetch_array($rezOdjava);
$sqlBrOdjava=$sqlBrOdjava['br'];

$ukupnoDogadaj=$sqlBrPrijava+$sqlBrOdjava;

//---Filtriranje
$mess="1";
if(isset($_POST['datumi']))
{
   $mess="";
   $prviDatum=$_POST['prviDatum'];
   $drugiDatum=$_POST['drugiDatum'];
   $ime=$_POST['ime'];
   require('../SYSTEM/metode.php');
   $tes=ProvjeriDuzinuString($prviDatum,$drugiDatum,$ime);
      $tes1=$tes[1];
      $tes=$tes[0];
      if($tes1==1)
      {
         $prviDatum=strtotime("$prviDatum");
   $drugiDatum=strtotime("$drugiDatum");

   
   $sql="SELECT*FROM dogadaj WHERE vrijeme BETWEEN '$prviDatum' AND '$drugiDatum' AND korisnik='$ime'";
   $rez=$conn->query($sql);
   if(mysqli_num_rows($rez)==0)
   {
      $mess="PREGLEDAJTE UNESENE PODATKE \n POGRESNO KORISNICKO IME ILI VRMENESKI INTERVAL";
   }
      }

      else
      {
         $mess=$tes;
      }

   

}

$lista=[];

if(isset($_POST['grafDatum']))
{
   $mess="graf";
   require('../SYSTEM/metode.php');
   $prviZaGraf=$_POST['prviG'];
   $drugiZaGraf=$_POST['drugiG'];

   $tes=ProvjeriDuzinuString($prviZaGraf,$drugiZaGraf);
   $tes1=$tes[1];
   $tes=$tes[0];
   if($tes1==1)
   {
   $prviZaGraf=strtotime("$prviZaGraf");
   $drugiZaGraf=strtotime("$drugiZaGraf");

   for ($i=$prviZaGraf; $i <=$drugiZaGraf; $i+=86400)
    { 
      
      $konacno=Graf($conn,$i,$i+86400);
      $lista[]=$konacno;

      
   }


   $json = json_encode($lista);
   echo "<script>var abc = $json; alert(abc);</script>";
   
    
   }

   else
   {
      $mess==$tes;
   }
   /*for($i=0;$i<$prviDatum; $i++)
   {
      //-napomena za dalje ovjde ces povecavati vrijeme za dan
      
   }*/
}
   //----naslov
    $titleName="AdminNaslovnica";

 include('templates/header.php');
 ?> 

 
    </div>
    <div class="main">
      <div class="mainheader">
   <div class="interval">
      <form action="AdminNas.php" method="post">
         <h3>Pretrazi po korisniku i vremenskom intervalu</h3>
         <label for="">Upisi ime korisnika: </label>
         <input type="text" name="ime">
         <br>
         <br>
         <label for="">Datum od:</label>
         <input type="date" name="prviDatum" class="" onchange="Datum(this.value)">
         <label for="">Datum do:</label>
         <input type="date" name="drugiDatum" id="" class="drugi">
         <br>
         <br>
         <button class="" name="datumi">Trazi</button>
      </form>
</div>
<div class="gr">
   <h3>Prikazi graficki sve aktivnosti za odredeni interval</h3>
   
   <form action="AdminNas.php" method="post">
         
         
         <label for="">Datum od:</label>
         <input type="date" name="prviG" class="" onchange="Datum1(this.value)">
         <label for="">Datum do:</label>
         <input type="date" name="drugiG" id="" class="treci">
         <br>
         <br>
         <br>
         <button class="" name="grafDatum">Prikazi Graf</button>
      </form>

</div>
      </div>
             <div class="mainBody">
     
     <h1>OBAVJEST</h1>
     <!-- ovo je za dohvat po vremenu
       SELECT FROM_UNIXTIME(vrijeme,"%Y %M %D") FROM dogadaj;-->
       
       <table>
         <caption>UKUPNI PODATCI DOGADAJA </caption>
         <tr>
            <th>DOGADAJ</th> <th>KOLICINA</th> <th>%</th>
            <?php 
            {?> 
                 <tr>
                  <td id="prijava">PRIJAVA</td> <td><?= $sqlBrPrijava?> <td><?= ($sqlBrPrijava/$ukupnoDogadaj)*100 ?>%</td> </td>
                 </tr> 
                 <tr ><td id="odjava">ODJAVA</td> <td><?= $sqlBrOdjava?></td> <td><?= ($sqlBrOdjava/$ukupnoDogadaj)*100 ?>%</td></tr>
                 <tr><td>UKUPNO</td> <td><?=$ukupnoDogadaj ?> <td>100%</td></td></tr>
               <?php } ?>
         </tr>
       </table>
                  
                  <h1>----------------------------------------</h1>

                  <?php if($mess==""){ ?>
                  <table>
                     <tr><th>KORISNIK</th> <th>OPIS</th><th>VRIJEME</th></tr>
                     <?php foreach($rez as $a){ ?> 
                        
                        <tr>
                           <td class="ime"><?=htmlspecialchars($a['korisnik']);?></td>
                           <td> <?=htmlspecialchars($a['opis']);?> </td>
                           <td><?= date('Y-m-d h:i:s', htmlspecialchars($a['vrijeme'])); ?></td>
                        </tr>

                        <?php } ?>
                  </table>
                 

         
<?php 
} 
                  else if($mess=="1")
                  { ?>
                     <h1><?= $mess="PODATCI" ?></h1>
                  <?php }

                  else if($mess=="graf")
                  {  ?>

<div class="graf">
                  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
<canvas id="myChart" style="width:100%;max-width:600px"></canvas>


</div>

                 <?php }
                  else{?>
                        <h1><?= $mess ?></h1>
                  <?php }?>

                  
       
            </div>
           
      <!-- js za blokadu datuma-->
      
            <script src="JS/datum.js"></script>
            <script src="../Jscript/jsdodaj.js"></script>
    </div>
<?php include('../templates/footer.php') ?>