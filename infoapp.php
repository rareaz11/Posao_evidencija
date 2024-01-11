<?php
 require("SYSTEM/AktivnostSession.php");

 Session();
$rez="";
$rez2="";
    $titleName="Info";
    require("DB/veza.php");
  
 include('templates/header.php');
 if(isset($_POST['podnesi']))
 {
  $ime=$_POST['ime'];
  $email=$_POST['mail'];
  $poruka=$_POST["por"];
  require("SYSTEM/metode.php");
 $rez=ProvjeriDuzinuString($ime,$email,$poruka);
 //namjesteno je tako da lovi po jednu vrijednost
$provjeri=$rez[1];//ako je 0 ne smije dozvolit slanje
 $rez=$rez[0];

 if($provjeri==true)
 {

  $rez=ProvjeriSlova($ime);
  

  $rezbool=$rez[1]; 
 

  if($rezbool==true)
  {

    $rez=CheckEmail($email);
    $rez2=$rez[1];
    $rez=$rez[0];
    if($rez2==true)
    {
     
      $header="From: $email";
    //za konfiguraciju ovog koristen Yt php contact form
    //postavke u php.ini
    //ovdje ide kod za slati email autoru
    mail("zelicantonio5@gmail.com",$ime,$poruka,$header);
    $rez="poslano";

    }

    else
    {
      $rez;
    }
   
  
  }

  

  else
  {
    $rez="Tekst treba sadrzi samo slova";
    
  }
}
 }

 ?>
 
    </div>
    <div class="main">
      <div class="mainheader">
       
       
      </div>
      <div class="mainBody">
      <h1>Kontaktiraj me</h1>
            
      <span><?= $rez;?> </span>

    
      <form action="infoapp.php" method="post">
   

        <label for="">Vase ime: </label>
        <input type="text" name="ime" placeholder="unesite ime">
        <label for="">Vasa e-mail adresa: </label>
        <input type="text" name="mail" placeholder="email">
        <br>
        <textarea type="text" name="por" id="" cols="30" rows="10" placeholder="Vase pitanje?"></textarea>

        <br>
        <button type="submit" name="podnesi">Posalji</button>
      </form>
       
      </div>
      
        
    </div>
    <script src="Jscript/jsdodaj.js"></script>
<?php include('templates/footer.php') ?>
     