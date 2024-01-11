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
{ require('../SYSTEM/metode.php');
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
$sqlBroj="SELECT*FROM korisnici";
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
    $sql="SELECT* FROM korisnici LIMIT $limitIspis OFFSET $off";
$rez=$conn->query($sql);

for($i=1;$i<$brstr+1; $i++)
{
    if(isset($_POST[$i]))
    {
          
                $sql="SELECT* FROM korisnici LIMIT $limitIspis OFFSET $off";
                $rez=$conn->query($sql);

    }
   
}
 }
 else{

//ovo je default rezultat tablice;
$sql="SELECT* FROM korisnici LIMIT $limitIspis OFFSET $off";
$rez=$conn->query($sql);
for($i=1;$i<$brstr+1; $i++)
{
    if(isset($_POST[$i]))
    {
          
                $sql="SELECT* FROM korisnici LIMIT $limitIspis OFFSET $off";
                $rez=$conn->query($sql);

    }
   
}
}


//moram povuci sve radi dohvacanja podataka
$sqlAll="SELECT* FROM korisnici";
$rezAll=$conn->query($sqlAll);

//-Aktiviraj
foreach($rezAll as $x)
{
    
    $ime=htmlspecialchars($x['korisnickoIme']);
    if(isset($_POST[htmlspecialchars($x['korisnickoIme'])]))
    {
        
            //ako je aktivan promjeni u nula
        if(htmlspecialchars($x['isRegistriran'])==1)
        {
            $sqlDec="UPDATE korisnici SET isRegistriran=0 where korisnickoIme='$ime'";
            $conn->query($sqlDec);
            require('../SYSTEM/metode.php');
            require("../DB/veza.php");

            SpremiPromjene($conn,$_SESSION['ime'],"DEAKTIVIRAO CLANA");
        }
        //ako nije aktivan stavi u 1
        else if(htmlspecialchars($x['isRegistriran'])==0)
        {
            $sqlDec="UPDATE korisnici SET isRegistriran=1 where korisnickoIme ='$ime'";
            $conn->query($sqlDec);
            require('../SYSTEM/metode.php');
            require("../DB/veza.php");

            SpremiPromjene($conn,$_SESSION['ime'],"AKTIVIRAO CLANA");
        }

    }
}
}
//--ime stranice i header 
    $titleName="Aktivacija Racuna";

 include('templates/header.php');
 ?> 

 
    </div>
    <div class="main">
      <div class="mainheader">
      <h1>Pregled korisnickih racuna</h1>
       
      </div>
    <div class="mainBody">
     
     
      
      
       <table>
        <tr> <th>Korisnik ID</th> <th>ime</th> <th>prezime</th> <th>kontakt</th><th>korisnicko Ime</th> <th>Aktiviraj/Deaktiviraj</th></tr>
    
        <?php foreach($rez as $kor){ ?>

            <tr>
                
                <td name="novo"><?=htmlspecialchars($kor['korisniciID'])?></td>
                <td><?=htmlspecialchars($kor['ime'])?></td>
                <td><?=htmlspecialchars($kor['prezime'])?></td>
                <td><?=htmlspecialchars($kor['kontakt'])?></td>
                <td><?=htmlspecialchars($kor['korisnickoIme'])?></td>
                <td><?php if(htmlspecialchars($kor['isRegistriran'])==1)
                {?>
              
                    <form action="pregledRacuna.php" method="post">
                    <?php print $off; ?>
                     <input name="noviBrojac" type="hidden" value="<?=$off?>"> <?php
                    ?>
                    <button name="<?=htmlspecialchars($kor['korisnickoIme'])?>">Deaktiviraj</button>
                </form>
                <?php } 
                
                else
                { ?>
               
                <form action="pregledRacuna.php" method="post">
                <?php print $off; ?>
                     <input name="noviBrojac" type="hidden" value="<?=$off?>"> <?php
                    ?>
                <button name="<?=htmlspecialchars($kor['korisnickoIme'])?>">Aktiviraj</button>
                </form>
                    
                <?php }
                ?>


            </td>
                
            </tr>

            <?php } ?>
    </table>

            <div class="forms">
    <?php for($i=1;$i<$brstr+1;$i++)
    { ?><form class="form4" action="pregledRacuna.php" method="post">
             <?php $off=$limitIspis*($i-1); ?>
            <input name="noviBrojac" type="hidden" value="<?=$off?>">
           <button name="<?=$i?>"><?=$i?></button>
            </form>
               <?php } ?></div>
            </div>





            
           
      
        
    </div>
    <script src="../Jscript/jsdodaj.js"></script>
<?php include('../templates/footer.php') ?>