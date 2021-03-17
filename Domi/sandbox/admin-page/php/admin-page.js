// välj ut element
const collectionWrapper = document.querySelector(".wrapper-horizontal-collection");

// ladda böcker som finns i databasen
// kalla ajax
/* var ajax = new XMLHttpRequest();
var method = "GET";
var url = "show-collection.php";
var asynchronous = true;

ajax.open(method, url, asynchronous);
// skickar ajax förfrågan
ajax.send();

// tar emot svaret från show-collection.php
ajax.onreadystatechange = function(){

  if(this.readyState == 4 && this.status == 200) {
    // converting JSON back to array
    var data = JSON.parse(this.responseText);
    console.log(data);


  }
}
 */
if(this.readyState == 4 && this.status == 200) {
  then(response => response.text())
  then(data => {
      console.log(data);
  
      // Fyll griden med bild
      eGrid.innerHTML += data;
  })
}
