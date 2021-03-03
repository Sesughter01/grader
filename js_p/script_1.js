
function myMonth(){
  var month = new Array();
month[0] = "January";
month[1] = "February";
month[2] = "March";
month[3] = "April";
month[4] = "May";
month[5] = "June";
month[6] = "July";
month[7] = "August";
month[8] = "September";
month[9] = "October";
month[10] = "November";
month[11] = "December";
 var d= new Date();
  var n =month[d.getMonth()];
  document.getElementById("currentMonth").innerHTML=n;
}
function showRegForm(str) {
   var xhttp;
   if(str==""){
     document.getElementById("myRegForm").innerHTML="";
     return;
   }
   xhttp= new XMLHttpRequest();
   xhttp.onreadystatechange= function(){
      if(this.readyState==4 && this.status==200){
        document.getElementById("myRegForm").innerHTML=this.responseText;
      }
   }
   xhttp.open("GET","registration.php",true);
   xhttp.send();
};

