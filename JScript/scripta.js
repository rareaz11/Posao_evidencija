var x= document.querySelector('.potvrdi');
var inp1=document.querySelector('.inp1');
var inp2=document.querySelector('.inp2');
var er1=document.querySelector('.err1');
var er2 =document.querySelector('.err2');


x.addEventListener('click',()=>
{
    CheckLenght();

  
 
})
//zadatak 1
function CheckLenght()
{

    if(inp1.value.length<3)
    {
        er1.innerHTML="User Name must have minimal 3 letters";
       
    }

    else if(inp2.value.length<5)
    {
        er2.innerHTML="Password must have minimal 3 letter or number";
    }
    
    else
    {
        alert("Uspjesno");

    }

}