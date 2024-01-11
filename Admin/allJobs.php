<?php


session_start();


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

//pamcenje odreedeno vremena korisnika gasi ga
if($vrijmee<time())
{ 
    require('../SYSTEM/metode.php');
  SpremiPromjene($conn,$_SESSION['ime'],"ODJAVA");
  Destroy_Session_Cookie();
   
}
//-button izlaz
if(isset($_POST['clic']))
{ require('../SYSTEM/metode.php');
  SpremiPromjene($conn,$_SESSION['ime'],"ODJAVA");
  Destroy_Session_Cookie();
}
//dohavacanje svih racuna tj broj racuna--------------------------
$sqlBroj="SELECT*FROM jobs";
//--ukljuciavanje sstranicenja
require("../SYSTEM/stranicenje.php");
$rezKorisnika=$conn->query($sqlBroj);
//broj rows u iz sql-a
$brojKorisnika=mysqli_num_rows($rezKorisnika);
//stavaljamo metodu za stranicenje 
$straniceKorisnika=PodesiStranice($conn,$brojKorisnika);
//podatci iz returna
$limitIspis=$straniceKorisnika[0];
 $off=$straniceKorisnika[1];
 $brstr=$straniceKorisnika[2];

 if(isset($_POST['noviBrojac']))
 {$off=$_POST['noviBrojac'];
    $sql="SELECT* FROM jobs LIMIT $limitIspis OFFSET $off";
$rez=$conn->query($sql);

for($i=1;$i<$brstr+1; $i++)
{
    if(isset($_POST[$i]))
    {
          
                $sql="SELECT* FROM jobs LIMIT $limitIspis OFFSET $off";
                $rez=$conn->query($sql);

    }
   
}
 }
 else{

//ovo je default rezultat tablice;
$sql="SELECT* FROM jobs LIMIT $limitIspis OFFSET $off";
$rez=$conn->query($sql);
for($i=1;$i<$brstr+1; $i++)
{
    if(isset($_POST[$i]))
    {
          
                $sql="SELECT* FROM jobs LIMIT $limitIspis OFFSET $off";
                $rez=$conn->query($sql);

    }
   
}
}

if(isset($_POST['izbrisi']))
{

    $id=$_POST['ID'];

    $sql="DELETE FROM jobs WHERE posaoID=$id";
    $conn->query($sql);
    require("../SYSTEM/metode.php");
    SpremiPromjene($conn,$_COOKIE['user'],"BRISANJE OGLASA");

}


if(isset($_POST['napravi']))
{

  $id=$_POST['idposao'];
  if($id==0 || $id=="")
  {
    print "GRESKA!!!!!!!!!!!!\nPOGELDAJ SVOJ JS KOD ADMIN HIDE ";

  }
  else
  {
    $tip=$_POST['tip'];
    $strucna=$_POST['strucna'];

    $sql="UPDATE jobs SET tipUgovora='".$conn->real_escape_string($tip)."',
     strucnaSprema ='".$conn->real_escape_string($strucna)."'
     WHERE posaoID='".$conn->real_escape_string($id)."'";

     $conn->query($sql);

     print "USPJESNO";

  }



}


//moram povuci sve radi dohvacanja podataka
$sqlAll="SELECT* FROM jobs";
$rezAll=$conn->query($sqlAll);

//-Aktiviraj

}
//--ime stranice i header 
    $titleName="Uredivanje Poslova";

 include('templates/header.php');
 ?> 

 
    </div>
    <div class="main">
      <div class="mainheader">
      <h1>Pregled korisnickih racuna</h1>

      <div class="skriveno"> 
        <h4>Promjena podataka</h4>
        <form action="allJobs.php" method="post">
          
        <label for="" class="xx">Tip Ugovora:</label>
        <select name="tip" id="">
                    <option value="Odredeno">Odredeno</option>
                    <option value="Neodredeno">Neodredeno</option>
                    <option value="Honorarno">Honorarno</option>

                </select>

                <label for="">
                    Strucna Sprema: 
                </label>
                <select name="strucna" id="">
                    <option value="NKV">NKV</option>
                    <option value="KV">KV</option>
                    <option value="VSS">VSS</option>
                </select>
                <button name="napravi" >Podnesi</button>

                <button class="ponisti"> Ponisti</button>

      </form>
    
    </div>
       
      </div>
    <div class="mainBody">
     
     
    
      
      
       <table>
        <tr> <th>Naziv Tvrtke</th> <th>OpIS</th> <th>Strucna Sprema</th> <th>Tpi Ugovora</th><th>Kategorija posla</th> </tr>
    
        <?php foreach($rez as $kor){ ?>

            <tr>
                
                <td name="novo"><?=htmlspecialchars($kor['nazivTvrtke'])?></td>
                <td><?=htmlspecialchars($kor['kratakOpis'])?></td>
                <td><?=htmlspecialchars($kor['strucnaSprema'])?></td>
                <td><?=htmlspecialchars($kor['tipUgovora'])?></td>
                <td><?=htmlspecialchars($kor['kategorijaPosla'])?></td>
                <td>
                  
                <input type="hidden" name="ID" value="<?=htmlspecialchars($kor['posaoID'])?>">

                    <button class="hideme" name="izmjeni">Izmjeni</button></td>
          <td><form action="allJobs.php" method="post">
                    <input type="hidden" class="posao" name="ID" value="<?=htmlspecialchars($kor['posaoID'])?>">

                    <button name="izbrisi">Izbrisi</button>

                </form></td>
                
            </tr>

            <?php } ?>
    </table>

            <div class="forms">
    <?php for($i=1;$i<$brstr+1;$i++)
    { ?><form class="form4" action="allJobs.php" method="post">
             <?php $off=$limitIspis*($i-1); ?>
            <input name="noviBrojac" type="hidden" value="<?=$off?>">
           <button name="<?=$i?>"><?=$i?></button>
            </form>
               <?php } ?></div>
            </div>





           
            <script src="JS/hide.js"></script>
            <script src="../Jscript/jsdodaj.js"></script>
    </div>
<?php include('../templates/footer.php') ?>