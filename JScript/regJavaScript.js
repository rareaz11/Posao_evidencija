var btn1=document.querySelector('.btn1');
var ime=document.querySelector('.ime');
var prezime=document.querySelector('.prezime');
var userName=document.querySelector('.user');
var mail=document.querySelector('.mail1');
var mail2=document.querySelector('.mail2');
var pass=document.querySelector('.pass');
var pass2=document.querySelector('.pass2');
var test= /[A-Z]/g;
var test2=/[0-9]/g;


//zadatak1
btn1.addEventListener("click",()=>
{
     
    if((ime.value=="") || (prezime.value==""))
    {
        alert("Ime ili prezime je prazno!!");
    }
    else if(pass.value!=pass2.value)
    {
        alert("Lozinke se ne podudaraju!!");

    }
    else if((pass.value=="")||(pass2.value=="")||(pass.value.length<8))
    {
        alert("Polje lozinka je prazno ili nema dovoljno znakova\n MINIMALAN BROJ ZNAKOVA 8!!!!");
    }
    //razlicitost emaila
    else if(mail.value!=mail2.value)
    {
        alert("email se nepodudara!!");

    }
    else if(mail.value.includes("@")==false)
    {
        alert("email ne sadrzi znak @")
    }

    //provjera jel lozinka sadrzava velika i mala slova i brojeve

 
  else if(pass.value.match(test)&&pass.value.match(test2))
    {
    
    }

    else
    {
        alert("lozinka treba sadrzavati velika slova i brojeve!!");
    }


    
});

//3 zadatak ajax pretrazivanje
var zz=document.querySelector('.test1');


function User(str)
{
    
    if(str.length==0)
    {
        zz.innerHTML="";
    }
    else{
    AjaxRequest('data','Show');}

    

 }

 function AjaxRequest(page, callback) {
    // otvori novi HTTP zahtjev
    const xhr = new XMLHttpRequest();
    xhr.open('GET', 'PHP/'+page+'.php');
    // definiraj kako će se obraditi odgovor poslužitelja
    xhr.onload = () => {
    if (xhr.readyState === XMLHttpRequest.DONE) {
    // provjera odgovora poslužitelja pomoću HTTP koda odgovora
    if ((xhr.status >= 200 && xhr.status < 300) || xhr.status === 304) {
    // odgovor je OK, pozovi povratnu funkciju u kojoj će se obraditi primljeni podaci
    let functionName = window[callback];
    if (typeof functionName === 'function') {
    functionName(xhr.responseText);
    }
    else alert('Nepodržana AJAX povratna metoda ' + callback + '()');
    }
    else {
    // prikaz pogreške u komunikaciji između web stranice i poslužitelja
    alert('AJAX pogreška: ' + xhr.statusText);
    }
    }
    };
    // pošalji zahtjev prema poslužitelju
    xhr.send();
    }


    function Show(items)
    {
        
        items=JSON.parse(items);
        var korisnik=items['korisnicko'];
        var i=0;

        while(i<korisnik.length)
        {
        
            if(korisnik[i]['korisnickoIme']==userName.value)
            {
                zz.style.color="red";
                zz.innerHTML="korisnicko ime je zauzeto";
                btn1.disabled=true;
                btn1.style.opacity=0.3;
                return;
            }
            else
            {
               
                zz.style.color="green";
                zz.innerHTML="korisnicko ime je slobodno"; 
                btn1.disabled=false;
                btn1.style.opacity=1;
                
            
            }
            i++;


       /* var i=0;  

            korisnik.forEach(element => 
            {
                
                alert(element['korisnickoIme']);

            }
            */
          
        }
        
    }
//kraj 3 zadatka
var obav=document.querySelector(".test2");
function Mail(vrj)
{
    if(vrj.length==0)
    {
        obav.innerHTML="";

    }

    else
    {
        AjaxRequest('data','EmailShow');
    }

}

function EmailShow(Amails)
{

  
    Amails=JSON.parse(Amails);
  mails=Amails['email'];
    var i=0;
 
        while(i<mails.length)
        {
        
            if(mails[i]['kontakt']==mail.value)
            {
                obav.style.color="red";
                obav.innerHTML="Upisali ste E-mail koji se vec korsti";
                btn1.disabled=true;
                btn1.style.opacity=0.3;
                return;
            }
            else
            {
               
                obav.style.color="green";
                obav.innerHTML="Dostupan Email"; 
                btn1.disabled=false;
                btn1.style.opacity=1;

            
            }
            i++;
            }
}







//----------------------------------------------------------------------------------
//za dinamicko ucitavanje pdataka 




    
 




   