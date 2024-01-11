<?php

//metoda provjera duzine bilo kojeg stringa metoda prima n parametara
function ProvjeriDuzinuString(...$prva)
{
    $mess='';
        $i=0;
    while ($i < count($prva)) 
    {
     
        if($prva[$i]=='')
        {
            $mess="Polja nesmiju biti prazna";
            $test=false;
            return array($mess,$test);
        }

        else if(strlen($prva[$i])<4)
        {
            $mess="Jedno od polja ima malo znakova";
            $test=false;
            return array($mess,$test);
        }
           $i++;
    
    }
$mess="uredu";
$test=true;
    return array($mess,$test);
}

//provjera jel string sadrzi samo slova
function ProvjeriSlova($string)
{
    //metoda prondaena na stack overflow --!preg_match("/^[a-zA-Z']*$/"--izmjenjna jos je sadrzavala da moze sadravati prazna mjesta
    if (!preg_match("/^[a-zA-Z ']*$/",$string)) 
    {

            $tes1=false;
        $nameErr = "za unos imena, prezimena i poruke koristite iskljucivo Velika i mala slova";
        return array($nameErr,$tes1);
      }

      else
      {
        $tes1=true;
        $nameErr="OK";
        return array($nameErr,$tes1);
      }

}

// provjera jacine lozinke

function JacinaLozinke($lozinka,$lozinka2)
{
    $vSlova=preg_match('@[A-Z]@',$lozinka);
    $mSlova=preg_match('@[a-z]@',$lozinka);
    $broj=preg_match('@[0-9]@',$lozinka);
    $znakovi=preg_match('@[^\w]@',$lozinka);

    if(!$vSlova)
    {
        $tes1=false;
        $nameErr = "Lozinka mora sadrzi velika slova";
        return array($nameErr,$tes1);
    }
    else if(!$mSlova)
    {
        $tes1=false;
        $nameErr = "Lozinka mora sadrzi mala slova";
        return array($nameErr,$tes1);
    }
    else if(!$broj)
    {
        $tes1=false;
        $nameErr = "Lozinka mora sadrzi brojeve";
        return array($nameErr,$tes1);
    }
    else if(!$znakovi)
    {
        $tes1=false;
        $nameErr = "Lozinka mora sadrzi znakove";
        return array($nameErr,$tes1);
    }
    else if(strlen($lozinka)<8)
    {
        $tes1=false;
        $nameErr = "Lozinka mora sadrzi minimalno 8 znakova";
        return array($nameErr,$tes1);
    }

    else if($lozinka!=$lozinka2)
    {
        $tes1=false;
        $nameErr = "Lozinke moraju biti iste!!";
        return array($nameErr,$tes1);
    }



      else
      {
        $tes1=true;
        $nameErr="OK";
        return array($nameErr,$tes1);
      }

    

}


//provjera emaila
//kod  pornaden na w3schools--izmjenjen kod
function CheckEmail($email)
{

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) 
    {
        $mess="email nije ispravan";
        $test=false;
        return array($mess,$test);
    } 
    else
     {
        
        $mess="email ispravan";
        $test=true;
        return array($mess,$test);
    }

}


//metoda za preacanje dogadaja u aplikaciji
//<td><?= date('Y-m-d h:i:s',htmlspecialchars( $a['vrijemeDogadaja'])); 
//KOD LINIJU IZNAD JE ZA VRACANJE IZ BAZE!!!!!!! NE ZABORAVI
function SpremiPromjene($conn,$korisnik,$opis)
{
    $vrijeme=time();
    //ne zaboravi pitat profu jel dosta tri podatka u bazi
    //npr opis: doadaj,brisanje, izmjena,
    //datum i vrijeme
    //korisnicko ime koje je to napravilo
  
    $sqlVrijeme="INSERT INTO dogadaj(korisnik,vrijeme,opis)
    Values('".$conn->real_escape_string($korisnik)."',
    '".$conn->real_escape_string($vrijeme)."'
    ,'".$conn->real_escape_string($opis)."')";

    $conn->query($sqlVrijeme);

}

function Destroy_Session_Cookie()
{
    setcookie("user",$_SESSION['ime'],time()-3600,"/");
    session_unset();
    session_destroy();
    header('Location: ../log.php');
}


//prvjera jel korisniku odobrena registracija

function jelRegistriran($conn,$korisnicko)
{   

    $sql="SELECT isRegistriran FROM korisnici where korisnickoIme='$korisnicko' LIMIT 1";
    $rez=$conn->query($sql);
        $isReg=0;
    foreach($rez as $x)
    {
        $isReg=htmlspecialchars($x['isRegistriran']);

        
    }

    if($isReg==1)
    {
        return true;
    }

    else
    {
        return false;
    }


}

//Hvatanje pogresaka lozinke 

function KrivaLozinka($conn,$korisnik)
{
    $brojNula=0;
    //broj koji odreduje
    $sqlBlokada="SELECT*FROM blokiraj";
$rezBlokada=$conn->query($sqlBlokada);
$blokiraj=0;
 foreach($rezBlokada as $z){                
    $blokiraj=$z['nBroj'];
 }
 //pita jel postoji korisnik
    $sql="SELECT korisnickoIme From korisnici where korisnickoIme='$korisnik'";
    $rez=mysqli_num_rows($conn->query($sql));
    if($rez==1)
    {//podizemo vrijednost za 1
        $sql="UPDATE korisnici SET countBlokiraj=countBlokiraj+1 where korisnickoIme='$korisnik'";
        $conn->query($sql);
        SpremiPromjene($conn,$korisnik,"POGRESNA LOZINKA");
        $sql="SELECT countBlokiraj FROM korisnici where korisnickoIme='$korisnik'";
        $rez=$conn->query($sql);

        $rezUk=mysqli_fetch_array($rez);
        $rezUk['countBlokiraj'];
        if($rezUk['countBlokiraj']==$blokiraj)
        {
            ImeKorisnika($conn,$korisnik);
            return "Pogrijesili ste lozinku 3 puta !! Javite se autoru na email : zelicantonio5@gmail.com";
            

        }
        else
        {
            return "Pogresno korisnicko ime ili lozinka";
        }
            
        }

    
    else
    {
        return"Pogresno korisnicko ime ili lozinka";
    }
}




function ImeKorisnika($conn,$ime)
{
    $sql="UPDATE korisnici SET isRegistriran=0 where korisnickoIme='$ime'";
    $conn->query($sql);

}

//metoda za popunit graf

function Graf($conn,$prvi,$drugi)
{

    $sql="SELECT COUNT(*) AS prijava FROM dogadaj WHERE vrijeme BETWEEN $prvi 
      and $drugi AND opis='PRIJAVA'";
      $sql2="SELECT COUNT(*) AS odjava FROM dogadaj WHERE vrijeme BETWEEN $prvi 
      and $drugi AND opis='ODJAVA'";

      $rez1=mysqli_fetch_array($conn->query($sql));
      $rez2=mysqli_fetch_array($conn->query($sql2));
      $brojP=$rez1[0];
      $brojO=$rez2[0];
      

       return array($brojP,$brojO);
      
}
?>