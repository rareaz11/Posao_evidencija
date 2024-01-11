var btnOpen=document.querySelector('.btnOpen');
var skriveno=document.querySelector('.skriveni');
var close=document.querySelector('.btnClose');
var izb2= document.querySelector('.headerr');
var izb=document.querySelector('.headerl');


btnOpen.addEventListener('click',()=>
{
    skriveno.classList.add("pokazi");
    izb2.classList.add('activel');
    btnOpen.style.visibility="hidden";
    izb.classList.add('activel');
})

close.addEventListener('click',()=>
{
    skriveno.classList.remove("pokazi");
    izb2.classList.remove("activel")
    btnOpen.style.visibility="visible";
    izb.classList.remove('activel');
})