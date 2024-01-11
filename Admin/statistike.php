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
   }
}


$sqlBroj="SELECT *from dogadaj";
$rez=mysqli_num_rows($conn->query($sqlBroj));
require("../SYSTEM/stranicenje.php");
$brStr=PodesiStranice($conn,$rez);
$limit=$brStr[0];
$off=$brStr[1];
$brStr=$brStr[2];

$sql="SELECT*FROM dogadaj LIMIT $limit OFFSET $off";

$rezIspis=$conn->query($sql);

for($i=1;$i<$brStr+1;$i++)
{

   if(isset($_POST[$i]))
   {

      $sql="SELECT*FROM dogadaj LIMIT $limit OFFSET $off";

      $rezIspis=$conn->query($sql);
   }

   $off+=$limit;

}

//--pokusaj izjmene koda ovinsino jel button za trazenje pritisnut i koji
if(isset($_POST['poAktivnosti']))
{
   $aktivnost=$_POST['aktivnosti'];
   $sqlBroj="SELECT *from dogadaj where opis='$aktivnost'";
$rez=mysqli_num_rows($conn->query($sqlBroj));
print "ovo je broj: ".$rez;
$brStr=PodesiStranice($conn,$rez);
$limit=$brStr[0];
$off=$brStr[1];
$brStr=$brStr[2];
//----pokusaj istog stranicenja
$sql="SELECT*FROM dogadaj where opis='$aktivnost' LIMIT $limit OFFSET $off";

$rezIspis=$conn->query($sql);

for($i=1;$i<$brStr+1;$i++)
{

   if(isset($_POST[$i]))
   {

      $sql="SELECT*FROM dogadaj LIMIT $limit OFFSET $off";

      $rezIspis=$conn->query($sql);
   }

   $off+=$limit;

}


}








   //---naslov
    $titleName="Statistike";

 include('templates/header.php');
 ?> 

 
    </div>
    <div class="main">
      <div class="mainheader">
   
       <div class="pretrazi">
         <form action="" method="post">
            <label for="">Pretrazi po aktivnosti</label>
               <select name="aktivnosti" id="">
                  <option value="PRIJAVA">PRIJAVA</option>
                  <option value="ODJAVA">ODJAVA</option>
                 
               </select>
               <button name="poAktivnosti"> PODNESI</button>
         </form>
         <form action="statistike.php" method="post">
            <label for="">Pretrazi po Korisniku</label>
               <input type="text" name="korisnik">
               <button> PODNESI</button>
         </form>

       </div>
      </div>
             <div class="mainBody">
     
     
               <table>
                  <tr><th>
                     Korisnik
                  </th>
                  <th>OPIS</th>
                  <th>VRIJEME</th></tr>
                  <?php foreach($rezIspis as $r)
                  {?>
                     <tr>
                        <td><?= htmlspecialchars($r['korisnik']);?></td>
                        <td><?= htmlspecialchars($r['opis']); ?></td>
                        <td><?= date('Y-m-d h:i:s',htmlspecialchars($r['vrijeme']));?></td>
                     </tr>

                  <?php } ?>
                  
               </table>
     
       <div class="buttons">
         <form class="form22" action="statistike.php" method="post">
             <?php for($i=1;$i<$brStr+1;$i++)
             { ?>
             
                  <button name="<?=$i?>"><?=$i?></button>
                  
            <?php }
             ?>
             </form>
            </div>
             </div>


      
           
    </div>
    <script src="../Jscript/jsdodaj.js"></script>
<?php include('../templates/footer.php') ?>