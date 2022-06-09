/* Toggle between adding and removing the "responsive" class to topnav when the user clicks on the icon */
function myFunction() {
    var x = document.getElementById("myTopnav");
    if (x.className === "topnav") {
      x.className += " responsive";
    } else {
      x.className = "topnav";
    }
  }



  function toggle_Navbar(x) {
    x.classList.toggle("change");
  }


var modal = document.getElementById('id01');

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}


$(':radio').change(function() {
  console.log('New star rating: ' + this.value);
});



function updateCost()
{
  
var rate=1000;
var date1 = new Date(document.getElementById("arrival").value);
var date2 = new Date(document.getElementById("departure").value);
  
var Difference_In_Time = date2.getTime() - date1.getTime();
  
// To calculate the no. of days between two dates
var Difference_In_Days = Difference_In_Time / (1000 * 3600 * 24);
    
var amount =Difference_In_Days*rate;
//document.getElementById("amount").value = amount;


  if(isNaN(amount)) {document.getElementById("amount").value = 0;}

  else  if(amount<=0) {document.getElementById("amount").value = 0;}
  else document.getElementById("amount").value = amount;
    
}

