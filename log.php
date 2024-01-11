
    <?php
   require("SYSTEM/AktivnostSession.php");

   Session();
  
    
    $mess="";
    $titleName="Login";
    require("DB/veza.php");
 include('templates/header.php');
 require('SYSTEM/metode.php');
 
 if(isset($_POST['potvrdi']))
 {

  $ime=$_POST['ime'];
  $pass=$_POST['pass'];
  $prov=ProvjeriDuzinuString($ime,$pass);
  $prov2=$prov[1];
  $prov=$prov[0];

 

  if($prov2==true){
  $sql="SELECT ime,isAdmin FROM korisnici where korisnickoIme='".$conn->real_escape_string($ime)."' AND lozinka='".$conn->real_escape_string($pass)."' LIMIT 1";
  $rez=$conn->query($sql);
  $x=mysqli_num_rows($rez);

  if($x==0)
  {


    $mess=KrivaLozinka($conn,$ime);
   



  }

  else
  {

    
    $jeR=jelRegistriran($conn,$ime);
    print $jeR;
    if($jeR==1)
    {
   
    $isAdmin=0;
    foreach($rez as $x)
      {
          
          $isAdmin=htmlspecialchars($x['isAdmin']);
      }

      if($isAdmin==1)
        {
          $user="user";
          $_SESSION['isAdmin']=$isAdmin;
          $_SESSION['ime']=$ime;
          SpremiPromjene($conn,$ime,"PRIJAVA");
        /*  $sqlcok="SELECT trajanje from cokki";
          $rezcok=$conn->query($sqlcok);
          
          $cokrezultat="";
          
          foreach($rezcok as $ab)
          {
            $cokrezultat=$ab['trajanje'];
          }
          */

            $_SESSION['timeNow']=time();
            $vrijmee=$_SESSION['timeNow']+8600;//vrijeme dozvoljeno
            setcookie($user,$ime,$vrijmee,"/");
            header("Location: Admin/AdminNas.php");
          
        }
      else
        {
          $user="user";
        
          $_SESSION['ime']=$ime;
          SpremiPromjene($conn,$ime,"PRIJAVA");
            $_SESSION['timeNow']=time();
            $vrijmee=$_SESSION['timeNow']+8600;//vrijeme dozvoljeno
            setcookie($user,$ime,$vrijmee,"/");
            header("Location: RegKorisnik/naslovnica.php");

        }
      }

      else
      {
        $mess="Nije Vam korisnicki racun registriran !!\n povtrdite na svom e-mailu";

      }
    

  }

  }

  else
  {
    $mess=$prov;
  }
}
 ?>




    </div>
    <div class="main">
      <div class="mainheader">
     
      <span class="err1"><?= $mess ?> </span>
      </div>
      <div class="mainBody">
      <form action="log.php" class="login" method="post" >
                <label for="">User Name: </label>
          
          
                <input name="ime" type="text" class="inp1">
               
                <label for="">Password: </label>
               
             
             
                <input name="pass" type="password" class="inp2">
              <br>
                <button name="potvrdi" >
                    Sign in
                </button>
          </form>
            
       
      </div>
      
        
    </div>
    <script src="Jscript/jsdodaj.js"></script>
<?php include('templates/footer.php') ?>