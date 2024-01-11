<?php
session_start();
$titleName="Dodaj Posao";
$mess="";
print_r($_COOKIE);

   
 print_r($_SESSION);
 require('../SYSTEM/AdminPrijava.php');
 $rezbool=CheckAdmin();
 if($rezbool==false)
 {
   header("Location: ../log.php");
 }

 else{
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
if(isset($_POST['dodaj']))
{
    require_once('../SYSTEM/metode.php');
    require_once('../DB/veza.php');
    $imeT=$_POST['nazivT'];
    $opisP=$_POST['opisP'];
    $sSprema=$_POST['strucna'];
    $tipUgovora=$_POST['tip'];
    $kat=$_POST['katPosla'];
//zadatak 2

    $rez=ProvjeriDuzinuString($imeT,$opisP);
    $rez2=$rez[1];
    $rez=$rez[0];
    if($rez2==false)
    {
        $mess=$rez;
    }


    else
    {
            $sql="INSERT INTO jobs(nazivTvrtke, kratakOpis, strucnaSprema, tipUgovora, kategorijaPosla)
            Values(
                '".$conn->real_escape_string($imeT)."',
                    '".$conn->real_escape_string($opisP)."',
                    '".$conn->real_escape_string($sSprema)."',
                    '".$conn->real_escape_string($tipUgovora)."',
                    '".$conn->real_escape_string($kat)."'
            
        )";
        $conn->query($sql);
        
        $mess="Spremljeno  u bazu podataka!";
       
        SpremiPromjene($conn,$_COOKIE['user'],"DODAVANJE NOVOG POSLA");
    }
}
 }

?>
        
           

<?php include('templates/header.php')?>
    </div>
    <div class="main">
      <div class="mainheader">
       
       
      </div>
      <div class="mainBody">
      <h1>Obrazac za dodavanje posla</h1>
            <h3><?php print $mess?></h3>
           

            <form action="dodajPosao.php"  method="post">
                <label for="">
                    Naziv tvrtke: 
                </label>
                <input type="text" name="nazivT">
                <label for="">
                    Opis Posla:
                </label>
                <input type="text" name="opisP">
                <label for="">
                    Strucna Sprema: 
                </label>
                <select name="strucna" id="">
                    <option value="NKV">NKV</option>
                    <option value="KV">KV</option>
                    <option value="VSS">VSS</option>
                </select>
                  <label for="">
                    Tip Ugovora: 
                  </label>
                <select name="tip" id="">
                    <option value="Odredeno">Odredeno</option>
                    <option value="Neodredeno">Neodredeno</option>
                    <option value="Honorarno">Honorarno</option>

                </select>

                <label for="">
                    Kategorija Posla: 
                </label>

                <select name="katPosla">
                    <option value="Administrativna Zanimanja">
                        Administrativna Zanimanja
                    </option>
                    <option value=" Bankarstvo">
                        Bankarstvo
                    </option>
                    <option value=" Dizajn">
                        Dizajn
                    </option>
                    <option value="Ekonomija,Financije,racunovodstvo">
                        Ekonomija,Financije,racunovodstvo
                    </option>
                    <option value="Farmceutika i biothenologija">
                        Farmceutika i biothenologija
                    </option>
                    <option value="Gradevina">
                        Gradevina
                    </option>
                    <option value="IT">
                        IT
                    </option>
                    <option value=" Managment">
                        Managment
                    </option>
                    <option value="Promet, transport,pomorstvo">
                        Promet, transport,pomorstvo
                    </option>
                    <option value="Skladistenje i logistika">
                        Skladistenje i logistika
                    </option>
                    <option value="Strojarstvo">
                        Strojarstvo
                    </option>
                    <option value="Turizam i ugostiteljstvo">
                        Turizam i ugostiteljstvo
                    </option>
                    
                    <option value="Zdravstvo">
                        Zdravstvo
                    </option>
                </select>
                <br>
                <button type="submit" name="dodaj">
                    Dodaj Posao
                </button>
            </form>
            
       
      </div>
      
        
    </div>
    <script src="../Jscript/jsdodaj.js"></script>
<?php include('../templates/footer.php') ?>