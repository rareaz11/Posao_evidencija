<?php 
 require("SYSTEM/AktivnostSession.php");

 Session();



//ovaj gore session indtf stvara session start





;
require('DB/veza.php');
$messError="";
if(isset($_POST['potvrdi']))
{
 

    $ime=$_POST['ime'];
    $prezime=$_POST['prezime'];
    $userN=$_POST['user'];
    $email=$_POST['mail'];
    $pass=$_POST['p1'];
    $pass2=$_POST['p2'];
    $email2=$_POST['mail1'];
   
//zadatak 2

require("SYSTEM/metode.php");

$messError=ProvjeriDuzinuString($ime,$prezime,$userN,$email,$pass,$pass2,$email2);
$messError2=$messError[1];
$messError=$messError[0];
if($messError2==1)
{



  $messError=JacinaLozinke($pass,$pass2);

  $messError2=$messError[1];

  $messError=$messError[0];

 
  if($messError2==1)
  {

    if($email!=$email2)
    {
        $messError="Email mora biti isti u oba polja";
    }
    else
    {
    $messError=CheckEmail($email);
    $messError2=$messError[1];
    $messError=$messError[0];
    if($messError2==true)
    {
        $messError="";

        $sql="INSERT INTO korisnici(ime,prezime,kontakt,korisnickoIme,lozinka)
        Values('".$conn->real_escape_string($ime)."',
        '".$conn->real_escape_string($prezime)."',
        '".$conn->real_escape_string($email)."',
        '".$conn->real_escape_string($userN)."',
        '".$conn->real_escape_string($pass)."'
        )";
        $conn->query($sql);
        
        header("Location:log.php");

    }
    else
    {

        $messError;
    }

}

  }
    else
    {
        $messError;
        //poruka !!
    }

}}



}

?>
   
        <?php
    $titleName="Registriraj se";
 include('templates/header.php');?>

    </div>
    <div class="main">
      <div class="mainheader">
       
       
      </div>
      <div class="mainBody">
      
      <form action="Registracija.php" method="post">
            <span><?= $messError ?></span>
                <label for="">
                    Ime:
                </label>
                <input type="text" name="ime" class="ime">
                <label for="">
                    Prezime: 
                </label>
                <input type="text" name="prezime" class="prezime">
                <label for="">Korisnicko ime: </label>
               
                <input type="text" name="user"  class="user" onkeyup="User(this.value);">
                <span class="test1"></span>
                <label for="">Email:</label>
                <input type="email" name="mail" class="mail1" onkeyup="Mail(this.value);">
                <span class="test2"></span>
                <label for="">Potvrdite email: </label>
                <input type="email" name="mail1" class="mail2">
                <label for="">Lozinka: </label>
                <input type="password" name="p1" class="pass">
                <label for="">Potvrdi lozinku: </label>
                <input type="password" name="p2" class="pass2">
                <br>
             
          <br>
               
                <button class="btn1" type="submit" name="potvrdi">Potvrdi</button>

              

            </form>
          
            
       
      </div>
      
        
    </div>
    <script src="Jscript/jsdodaj.js"></script>
<?php include('templates/footer.php') ?>
<script src="Jscript/regJavaScript.js"></script>
     