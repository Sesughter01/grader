//var z;
//z=["cp","bp","sp","gp","pp"];
//var  i;
//i=0;


function moneyValue() {
  var x= document.getElementById("noc").value;
  if(x>=0 && x<=99){
    
    var y = 300;
     document.getElementById("moneyValue1").innerHTML = "NGN"+ x*y;

  }else if(x>=100 && x<=500){
    var y = 300;
   document.getElementById("moneyValue2").innerHTML = "NGN"+ x*y;
  }else if(x>=501 && x<=1000) {
    var y = 300;
    document.getElementById("moneyValue3").innerHTML = "NGN"+ x*y;
  }else if(x>=1001 && x<=3000){
    var y = 300;
    document.getElementById("moneyValue4").innerHTML = "NGN"+ x*y;
  }else if(x3000){
    var y = 300;
    document.getElementById("moneyValue5").innerHTML = "NGN"+ x*y;
  }else{
      document.getElementById("moneyValue1").innerHTML= "This is not a valid entry, refresh ";

  }

}
  