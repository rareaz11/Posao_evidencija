var test=document.querySelector(".test1");

test.addEventListener('click',()=>alert(abc));


var y=document.querySelector(".drugi");
var g=document.querySelector(".treci");

function Datum(str)
{
    y.min=str;
} 
function Datum1(str)
{
    g.min=str;
} 
//var prijava=document.getElementById("prijava");
//var prijava2=prijava.innerHTML;
//var odjava2=document.querySelector("#odjava");
//var odjava=odjava2.innerHTML;
//var ime2=document.querySelector(".ime");
//var ime=ime2.innerHTML;
var test=document.querySelector(".test1");

test.addEventListener('click',()=>
{
abc.forEach(element => {
  
  
});
});
var x;
abc.forEach(el=>
{//neide dalje pitaaj profesoraaa
  x=el[0];

})



const xValues = ["01-01-2024","02-01-2024","03-01-2024","01-01-2024"];

new Chart("myChart", {
  type: "line",
  data: {
    labels: xValues,
    datasets: [{ 
      data: [860,1140,1060,1060,1070,1110,1330,2210],
      borderColor: "green",
      fill: false
    }, { 
        label:"PRIJAVA",
      data: [10,220],
      borderColor: "red",
      fill: false
    }, { 
      label:"ODJAVA",
      data: [300,700,2000,2000,1000,200,100],
      borderColor: "blue",
      fill: false
    }
  ]
   
  },
  options: {
    legend: {display: true},
    title: {
        display: true,
        text: "NEKI KORISNIK"
      }
   
  }
});