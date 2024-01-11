
AjaxRequest('dataPosao','IspisPosao')
    
var lista=[];

function IspisPosao(company)
{
   
    company=JSON.parse(company);
    company=company['naziv'];
    
    lista=company;

   
         
}

var tab= document.querySelector(".ajaxP");
var opisi= document.querySelector(".ko");
function Opis()
{

    if(opisi.value.length==0)
    {
        tab.innerHTML="POGRESAN UNOS ILI TRENUTNO NEMA POSLOVA";
    }

    else{
    
    tab.innerHTML="<tr><th>*</th><th>Naziv Tvrtke</th><th>Opis posla</th><th>Strucna Sprema</th><th>Ugovor o radu</th><th>Kategorija Posla</th></tr>";
    var z=0;
    var broji=1;
    while (z<lista.length)
     {
        
        if(lista[z]['kratakOpis']==opisi.value)
        {
            tab.innerHTML+="<tr><td>"+broji+"</td><td>" + lista[z]['nazivTvrtke']+"</td><td>" + lista[z]['kratakOpis']+"</td> <td>" + lista[z]['strucnaSprema']+"</td> <td>" + lista[z]['tipUgovora']+"</td><td>" + lista[z]['kategorijaPosla']+"</td></tr>";
        broji++;
        }
       
        
        z++;
    
        
    }

}
    
}
var tvrtka= document.querySelector(".comp");

function Tvrtka()
{

    if(tvrtka.value.length==0)
    {
        tab.innerHTML="POGRESAN UNOS ILI TRENUTNO NEMA POSLOVA";
    }

    else{
    
    tab.innerHTML="<tr><th>*</th><th>Naziv Tvrtke</th><th>Opis posla</th><th>Strucna Sprema</th><th>Ugovor o radu</th><th>Kategorija Posla</th></tr>";
    var z=0;
    var broji=1;
    while (z<lista.length)
     {
        
        if(lista[z]['nazivTvrtke']==tvrtka.value)
        {
            tab.innerHTML+="<tr><td>"+broji+"</td><td>" + lista[z]['nazivTvrtke']+"</td><td>" + lista[z]['kratakOpis']+"</td> <td>" + lista[z]['strucnaSprema']+"</td> <td>" + lista[z]['tipUgovora']+"</td><td>" + lista[z]['kategorijaPosla']+"</td></tr>";
        broji++;
        }
       
        
        z++;
    
        
    }

}
    
}

function Tvrtka()
{

    if(tvrtka.value.length==0)
    {
        tab.innerHTML="POGRESAN UNOS ILI TRENUTNO NEMA POSLOVA";
    }

    else{
    
    tab.innerHTML="<tr><th>*</th><th>Naziv Tvrtke</th><th>Opis posla</th><th>Strucna Sprema</th><th>Ugovor o radu</th><th>Kategorija Posla</th></tr>";
    var z=0;
    var broji=1;
    while (z<lista.length)
     {
        
        if(lista[z]['nazivTvrtke']==tvrtka.value)
        {
            tab.innerHTML+="<tr><td>"+broji+"</td><td>" + lista[z]['nazivTvrtke']+"</td><td>" + lista[z]['kratakOpis']+"</td> <td>" + lista[z]['strucnaSprema']+"</td> <td>" + lista[z]['tipUgovora']+"</td><td>" + lista[z]['kategorijaPosla']+"</td></tr>";
        broji++;
        }
       
        
        z++;
    
        
    }

}
    
}
//za strucnu spremu
var struk= document.querySelector(".struk");
function Struka()
{

    if(struk.value.length==0)
    {
        tab.innerHTML="POGRESAN UNOS ILI TRENUTNO NEMA POSLOVA";
    }

    else{
    
    tab.innerHTML="<tr><th>*</th><th>Naziv Tvrtke</th><th>Opis posla</th><th>Strucna Sprema</th><th>Ugovor o radu</th><th>Kategorija Posla</th></tr>";
    var z=0;
    var broji=1;
    while (z<lista.length)
     {
        
        if(lista[z]['strucnaSprema']==struk.value)
        {
            tab.innerHTML+="<tr><td>"+broji+"</td><td>" + lista[z]['nazivTvrtke']+"</td><td>" + lista[z]['kratakOpis']+"</td> <td>" + lista[z]['strucnaSprema']+"</td> <td>" + lista[z]['tipUgovora']+"</td><td>" + lista[z]['kategorijaPosla']+"</td></tr>";
        broji++;
        }
       
        
        z++;
    
        
    }

}
    
}

//tip posla
var tipP= document.querySelector(".tipP");
function TipUgovora()
{

    if(tipP.value.length==0)
    {
        tab.innerHTML="POGRESAN UNOS ILI TRENUTNO NEMA POSLOVA";
    }

    else{
    
    tab.innerHTML="<tr><th>*</th><th>Naziv Tvrtke</th><th>Opis posla</th><th>Strucna Sprema</th><th>Ugovor o radu</th><th>Kategorija Posla</th></tr>";
    var z=0;
    var broji=1;
    while (z<lista.length)
     {
        
        if(lista[z]['tipUgovora']==tipP.value)
        {
            tab.innerHTML+="<tr><td>"+broji+"</td><td>" + lista[z]['nazivTvrtke']+"</td><td>" + lista[z]['kratakOpis']+"</td> <td>" + lista[z]['strucnaSprema']+"</td> <td>" + lista[z]['tipUgovora']+"</td><td>" + lista[z]['kategorijaPosla']+"</td></tr>";
        broji++;
        }
       
        
        z++;
    
        
    }

}
    
}

var kategory= document.querySelector(".kPosla");
function Kategorije()
{

    if(kategory.value.length==0)
    {
        tab.innerHTML="POGRESAN UNOS ILI TRENUTNO NEMA POSLOVA";
    }

    else{
    
    tab.innerHTML="<tr><th>*</th><th>Naziv Tvrtke</th><th>Opis posla</th><th>Strucna Sprema</th><th>Ugovor o radu</th><th>Kategorija Posla</th></tr>";
    var z=0;
    var broji=1;
    while (z<lista.length)
     {
        
        if(lista[z]['kategorijaPosla']==kategory.value)
        {
            tab.innerHTML+="<tr><td>"+broji+"</td><td>" + lista[z]['nazivTvrtke']+"</td><td>" + lista[z]['kratakOpis']+"</td> <td>" + lista[z]['strucnaSprema']+"</td> <td>" + lista[z]['tipUgovora']+"</td><td>" + lista[z]['kategorijaPosla']+"</td></tr>";
        broji++;
        }
       
        
        z++;
    
        
    }

}
    
}




/*ajax req NAPOMENA UZETO IZ VJEZBE 5*/

function AjaxRequest(page, callback) {
    
    const xhr = new XMLHttpRequest();
    xhr.open('GET', 'PHP/'+page+'.php');
    xhr.onload = () => {
    if (xhr.readyState === XMLHttpRequest.DONE) {
    if ((xhr.status >= 200 && xhr.status < 300) || xhr.status === 304) {
    let functionName = window[callback];
    if (typeof functionName === 'function') {
    functionName(xhr.responseText);
    }
    else alert('Nepodržana AJAX povratna metoda ' + callback + '()');
    }
    else {
   
    alert('AJAX pogreška: ' + xhr.statusText);
    }
    }
    };
    xhr.send();
    }