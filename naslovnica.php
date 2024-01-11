

        <?php 
        /*NEMOJ ZABORAVVIT KAKO SE REZ VRTE U TABLICMA--STRANICENJE --frontend SKACE*/
     require("SYSTEM/AktivnostSession.php");

     Session();
     
    $titleName="Naslovnica";
    require("DB/veza.php");
 include('templates/header.php');
 require("SYSTEM/stranicenje.php");
 //dohvacanje broja podattaka;
 $sqlBroj="SELECT*FROM jobs";

 $rezPoslova=$conn->query($sqlBroj);
 $brojPoslova=mysqli_num_rows($rezPoslova);

 



//s ovim dobivamo 3 varijable limit ,offset i ispis stranica;

 $postavkeIspisa=PodesiStranice($conn,$brojPoslova);

 $limitIspis=$postavkeIspisa[0];
 $off=$postavkeIspisa[1];
 $brstr=$postavkeIspisa[2];

 $rez=[];
//ovo je default rezultat tablice;
$sql="SELECT* FROM jobs LIMIT $limitIspis OFFSET $off";
$rez=$conn->query($sql);

 for ($i=1; $i < $brstr+1; $i++)
 
 {

    if(isset($_POST[$i]))
    {


      $sql="SELECT* FROM jobs LIMIT $limitIspis OFFSET $off";
      $rez=$conn->query($sql);
      
    } 

    $off+=$limitIspis;
    
  
 }
 
 //grananje if 0 onda ce upozorti korisnika da nema podataka
//ali u kodu dole


 
 

 ?>
    </div>
    <div class="main">
      <div class="mainheader">
   
       
      </div>
             <div class="mainBody">
      <h1>Ponuda poslova</h1>
       
      <?php  if($brojPoslova==0)
      { ?>
    <h3 style="color:red">Zao nam je trenutno nema dostupnih poslova poslova</h3>
      <?php }
    

      else
      { ?>

        <table>
          <tr>
           <th>naziv tvrtke</th>
           <th>Opis</th>
           <th>Strucna Sprema</th>
           <th>Tip Ugovora</th>
           <th>Kategorija Posla</th>
          </tr>
          <?php foreach($rez as $x){ ?>

            <tr><td><?=htmlspecialchars($x['nazivTvrtke']); ?></td>
            <td><?= htmlspecialchars($x['kratakOpis']); ?></td>
            <td><?= htmlspecialchars($x['strucnaSprema']); ?></td>
            <td><?= htmlspecialchars($x['tipUgovora']);?></td>
            <td><?= htmlspecialchars($x['kategorijaPosla']); ?></td>
          </tr>
          <?php } ?>


        </table>
        
      <?php } ?>
      <form class="form1" action="naslovnica.php" method="post">
      
             <?php for($btn=1; $btn<$brstr+1;$btn++)
             { ?>
        
             <button name="<?=$btn?>">
              <?= $btn?>
             </button>
            
           <?php } ?> 
           </form>
       
            </div>
      
        
    </div>
    <script src="Jscript/jsdodaj.js"></script>
<?php include('templates/footer.php') ?>
     

