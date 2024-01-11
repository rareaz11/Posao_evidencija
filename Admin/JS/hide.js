//pokusaj dohavacanje podatak i slanja u php

var x= document.querySelector(".posao");

var xx=document.querySelector('.xx');
/////////////////////////////////////////////

var hide= document.querySelectorAll(".hideme");
var skrveni=document.querySelector('.skriveno');

hide.forEach(el=>
    {
        el.addEventListener('click',()=>
        {       
            xx.innerHTML='<input type="type" name="idposao" value="'+x.value+'" disabled>';
           
            skrveni.classList.add("act");
            
        })
    })

    

var pon=document.querySelector('.ponisti');

pon.addEventListener('click',()=>
{
    skrveni.classList.remove('act');
});


//pokusaj dohavacanje podatak i slanja u php

var x= document.querySelector(".posao");
var idnovo=document.querySelector('.id1');


