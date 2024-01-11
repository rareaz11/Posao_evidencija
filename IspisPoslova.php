<?php
 require("SYSTEM/AktivnostSession.php");

 Session();
require("SYSTEM/stranicenje.php");

$titleName="Popis Poslova";
require_once('DB/veza.php');
//ispis posla




$br=5;


if(isset($_POST['tvr']))
{
    $br=0;
}
if(isset($_POST['op']))
{
    $br=1;
}
if(isset($_POST['st']))
{
    $br=2;
}

if(isset($_POST['ur']))
{
    $br=3;
}

if(isset($_POST['kp']))
{
    $br=4;
}
?>



        
<?php include('templates/header.php')?>
    </div>
    <div class="main">
      <div class="mainheader">
       
      <div class="trazilica">

      <div class="ajax"><form action="" method="post"> <button name="tvr">Pretrazi po Tvrtkama</button>
      <button name="op">Po Opisu</button>
       <button name="st">Po strucnoj Spremi</button>
        <button name="ur">Po Ugovoru O Radu</button>
         <button name="kp">PO KATEGORIJI POSLA</button></form> </div>
        <?php if($br==0){ ?>
                <div>
                    <label for="">Pretrazi po tvrtkama:</label>
                    <input type="text" class="comp">
                    <button  onclick="Tvrtka()">Tvrtke</button>
                </div> <?php }
            
                else if($br==1){
                 ?>
                 <div>
                <label for="">Pretrazi po opisu Posla:</label>
                    <input type="text" class="ko">
                    <button onclick="Opis()">Opis  Posla</button>
                </div>
                 <?php }

               else if($br==2) { ?>

                <div>
                <label for="">Pretrazi po strucnoj spremi:</label>
                    <select class="struk" id="">
                        <option value="NKV">NKV</option>
                        <option value="KV">KV</option>
                        <option value="VSS">VSS</option>
                    </select>
                    <button onclick="Struka()">Struka</button>
                </div>
<?php }

               else if($br==3){ ?>
                  
                <div>
                <label for="">Pretrazi po ugovoru:</label>
                    <select class="tipP" id="">
                        <option value="Odredeno">Odredeno</option>
                        <option value="Neodredeno">Neodredeno</option>
                        <option value="Honorarno">Honorarno</option>
                    </select>
                    <button onclick="TipUgovora()">Ugovor</button>
                </div>
<?php }

               else if($br==4) { ?>

                <div>
                <label for="">Pretrazi po kategoriji posla:</label>
                <select class="kPosla">
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
                    <button onclick="Kategorije()">Kategorije posla</button>
                </div>
                <?php }
                
                else if($br==5){ ?>

                        <h1></h1>
                <?php } ?>

                
            </div>
            
      </div>
      <div class="mainBody">
      <h1>Ponuda poslova</h1>
            


<table class="ajaxP">

</table>


               
          
       
      </div>
      
        
    </div>
    <script src="JScript/regJavaScript.js"></script>
    <script src="JScript/ajax.js"></script>
    <script src="Jscript/jsdodaj.js"></script>
<?php include('templates/footer.php') ?>