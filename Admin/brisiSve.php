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



//-brisi sve

}


if(isset($_POST['br']))
{

    $sql="TRUNCATE TABLE  prijavaposao;";
    //*$conn->query($sql);*/

  /*  $sql1="TRUNCATE TABLE jobs";

   $conn->query($sql1);*/
}
//--ime stranice i header 
    $titleName="Brisi sve";

 include('templates/header.php');
 ?> 

 
    </div>
    <div class="main">
      <div class="mainheader">
     

       
      </div>
    <div class="mainBody">
     
     
            <form action="brisiSve.php" method="post">
                <button name="br">IZBRISI SVE</button>
            </form>
      
   

           
            </div>





           
            <script src="JS/hide.js"></script>
            <script src="../Jscript/jsdodaj.js"></script>
    </div>
<?php include('../templates/footer.php') ?>