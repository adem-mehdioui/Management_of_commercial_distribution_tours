<!DOCTYPE html>
<html>
<head>
	  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.2/jspdf.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/2.3.2/jspdf.plugin.autotable.js"></script>










	<style type="text/css">






.top_label{


margin-right: 20px;
}


span{
        display: inline-block;
    }

    span select input { 
        display: block; 
        position: relative; 
        bottom: -3em; 
    } 
    span input { text-align:center;}
    span label { 
        display: block; 
        position: relative; 
        text-align: center;
    } 


li{

    list-style-type: square;
    margin-bottom: 10px;

}

fieldset{
    width:1000px;
    margin:auto;
    background-color:  #BFD7ED;
    border:  1px solid #ccc;
    margin:  2em 0;
    padding:  1em;
    /*background: url(../backimage.jpg) no-repeat center center fixed;*/

}


.field_set{
  border-style: solid;
  padding-left: 10px;
  padding-right: 10px;
  padding-top: 10px;
  padding-bottom: 10px;
}




/*td { vertical-align: top; text-align: left; }*/








/* Add a black background color to the top navigation */
.topnav {
  background-color: #333;
  overflow: hidden;
  padding-top: 5px;
  width: 100%;
  position: fixed;
  top: 0%;
}

/* Style the links inside the navigation bar */
.topnav a {
  float: left;
  color: #f2f2f2;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
  font-size: 17px;
}

/* Change the color of links on hover */
.topnav a:hover {
  background-color: #ddd;
  color: black;
}

/* Add a color to the active/current link */
.topnav a.active {
  background-color: #04AA6D;
  color: white;
}

/* Hide the link that should open and close the topnav on small screens */
.topnav .icon {
  display: none;
}

.topnav {
	margin-bottom: 10px;
}








#myInput {
  background-position: 10px 12px; /* Position the search icon */
  background-repeat: no-repeat; /* Do not repeat the icon image */
  width: 15%; /* Full-width */
  padding: 6px  12px   6px 12px; /* Add some padding */
  border: 1px solid #ddd; /* Add a grey border */
}

#filters_container {


margin-bottom: 20px;
margin-left: 10px;


margin-top: 70px; 

}

#search {


	border : 1px solid #000000;
	padding: 6px  12px   6px 12px;
	cursor: pointer;
	 width: 9%;
	
}





.fixed_header tbody{
  display:block;
  overflow:auto;
  height:400px;
  width:100%;
}

.fixed_header thead tr{
  display:table-header-group;
}


#myTable{

  width: 100%;


}

thead th,tbody td{
  width: 10%;//or what you want
  float:left;

}






table {
  border-collapse: collapse;
}

table tr {
  border-bottom: 1px solid black;
}

table th {
  border-bottom: 1px solid black;
}

table tr:last-child {
  border: 0;
}







	</style>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="js/bootstrap.min.js">

<title>Suivi des tournées par GPS</title>






<!--  the rest !-->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>


<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
</head>



<body>

	





<div class="topnav"> 
	 <span class="closebtn" id="MyElement">&times;</span>
        <span id="menu">
  <a id="add" href="#add_tournee" class="nav-item"> <i class="fa fa-plus" aria-hidden="true"  > Ajouter tournée</i></a>
  <a id="consult" href="#consult_tournee" class="nav-item active"><i class="fa fa-eye" aria-hidden="true" >Consulter tournée</i></a>

    <a id="logout" href="#login" class="nav-item"><i class="fa fa-sign-out" aria-hidden="true">Se déconnecter</i></a>

 
  
</span>

</div>



<form action="" method="POST" onsubmit="setDate()">


<div id="filters_container">

<!-- add the filter inputs !-->

<!-- onkeyup="filter_with_input()" !-->




<span>
<label>Début</label>
<input type="Date" name="txtdatestart" id="datefilterfrom"  class="form-control" max="9999-12-31">

</span>

<span>
<label>Fin</label>
<input type="Date" name="txtdateend" id="datefilterto"  class="form-control" max="9999-12-31">
</span>





<!--<input type="button"   value="Initialiser"  style="text-indent:17px;" class="button-reset"> !-->

<input type="submit" name="" value="Rechercher" class="btn" id="search">



<input type="text" id="myInput" onkeyup="filter_results(); insertTfoot();"  placeholder="filtrage" > 




  <a href="#" onclick="exportPDF('content1')">Générer Rapport-PDF</a>


</div>

</form>









<?php

$table = "tournee";
$database = "suivigps";


$mysqli = new mysqli("127.0.0.1", "root", "", "suivigps");
if($mysqli->connect_error) {
  exit('Error connecting to database'); //Should be a message a typical user could understand in production
}
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$mysqli->set_charset("utf8mb4");





?>



<div id="content1">
	<table class = "fixed_header" id="myTable"  >
			<thead style="background-color: #babab8 ;">
				<tr><th>Région</th> <th>Date de mission</th> <th>Commercial</th> <th>Chauffeur</th> <th>Matricule Véhicule</th><th>Départ prévu mission</th><th>Départ chauffeur</th> <th>Départ effectif mission</th> <th>Ecart mission</th> <th>Retour constantine</th> <th>Durée Mission</th> <th>Observation</th> </tr>
			</thead>

			<tbody id="body_id" onload="insertTfoot();">
				
<?php


$table = "tournee";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Something posted

  // Assume btnSubmit1 



//calculate difference between two dates

/*

if(!empty($_POST['txtdatestart']) && !empty($_POST['txtdateend'])){
   $date1 = new DateTime($_POST['txtdatestart']);
   $date2 = new DateTime($_POST['txtdateend']);
   $difference = $date1->diff($date2);
   echo "There are " . $difference->days  . " days between " . $date1->format('d-m-Y') . " and " . $date2->format('d-m-Y');
} else {
   echo "Two dates need to be supplied";
}

*/







$stmt = $mysqli->prepare("SELECT * FROM $table where date_tournee >= ? AND date_tournee <= ? ORDER BY date_tournee ASC");
$stmt->bind_param("ss", $_POST['txtdatestart'], $_POST['txtdateend']);
$stmt->execute();
$result = $stmt->get_result();



while($row = $result->fetch_assoc()) {

//change date format to french including day of the week

setlocale(LC_TIME, "fr_FR", "French");                                                             


//format date_tournee at the same time of displaying the table records 
//display correctly monthes that contain special characters  utf8_encode() , like : Février

 echo "<tr><td>" . $row["region"] . "</td><td>" . utf8_encode(strftime("%a %d %B %G", strtotime($row['date_tournee'])))   . "</td><td>" . $row["nom_commercial"] .  "</td><td>" . $row["nom_chauffeur"]. "</td><td>" . $row["matricule"] . "</td><td>" . $row["heure_depart_prevu"] . "</td><td>" .  $row["heure_depart_chauffeur"] .  "</td><td>" . $row["heure_depart_effective"] .  "</td><td style='color: red;'>" . $row["ecart"] .  "</td><td>" . $row["heure_arrive"] .  "</td><td>" . $row["duree_mission"] .  "</td><td>" . $row["observation"] . "</td></tr>";

}

    $result->free();




$stmt->close();



}



?>
				
			</tbody>
			<tfoot>
        <tr><td id="nbr_ligne" >Total : </td></tr>
            
    </tfoot>
		</table>
</div>







<script type="text/javascript">





  //set tfoot data rows 

        var table = document.getElementById("myTable");

        var tbodyRowCount = table.tBodies[0].rows.length; // number of trips 

        document.getElementById('nbr_ligne').innerHTML = "Total des Tournées : " + tbodyRowCount;

       // console.log(tbodyRowCount);



function insertTfoot () {

        var table = document.getElementById("myTable");

        var tbodyRowCount = table.tBodies[0].rows.length; // number of trips 

        document.getElementById('nbr_ligne').innerHTML = "Total des Tournées : " + tbodyRowCount ;

       // console.log(tbodyRowCount);
}









var specialElementHandlers = {
    // element with id of "bypass" - jQuery style selector
    '.no-export': function (element, renderer) {
        // true = "handled elsewhere, bypass text extraction"
        return true;
    }
};

function exportPDF(id) {


  
    var doc = new jsPDF('l', 'pt','A4');
    var elem = document.getElementById("myTable");
    var res = doc.autoTableHtmlToJson(elem); 
    

    doc.setLineWidth(2);
    //vertical marging
    let y = 50;



// get today full date 
    var today = new Date();
    var dd = today.getDate();
    var mm = today.getMonth()+1;
    var yyyy = today.getFullYear();


    if(dd<10) 
{
    dd='0'+dd;
} 

if(mm<10) 
{
    mm='0'+mm;
} 



// get formatted date as i wanted to be 
printed_date = dd+'-'+mm+'-'+yyyy;

    var newdat = "Imprimé le : "+ printed_date;
    doc.setFontSize(10);
    doc.text(650, y, newdat);



    doc.setFontSize(15);
    doc.text(220, y, "Rapport des Tournées -Sarl UMC LAB PLUS- ");


var img = new Image()
img.src = 'images/logo.jpg'
doc.addImage(img, 'jpeg', 50, 30, 40, 40)


   doc.autoTable(res.columns, res.data, {
   	margin: {top: 80},
   	 styles: {
      fontSize: 8,
      overflow: "linebreak"
    }
   });







   /* let finalY = doc.lastAutoTable.finalY; // The y position on the page
doc.text(250, finalY, "Rapport des Tournées - Sarl UMC LAB PLUS - ");*/





//display again the title below the table of trips 





      var pageCount = doc.internal.getNumberOfPages(); //Total Page Number
for(i = 0; i < pageCount; i++) { 
  doc.setPage(i); 
  let pageCurrent = doc.internal.getCurrentPageInfo().pageNumber; //Current Page
  doc.setFontSize(10);
  doc.text('page: ' + pageCurrent + '/' + pageCount, 370, doc.internal.pageSize.height -25);
}




    doc.save("Rapport_tournées.pdf");


}







 function setDate(){

        var value_from = document.getElementById('datefilterfrom').value;
       // alert(value)



        var value_to = document.getElementById('datefilterto').value;



        localStorage.setItem("user_selected_date_from", value_from); 


        localStorage.setItem("user_selected_date_to", value_to); 


      





    }


    function getDate(){


        if (localStorage.getItem("user_selected_date_from") === null) {// Check if there is selected date. 
              return "{{moment date=d format='YYYY-MM-DD'}}"; 
        }
        return localStorage.getItem("user_selected_date_from");
    }



     function getDate_to(){


        if (localStorage.getItem("user_selected_date_to") === null) {// Check if there is selected date. 
              return "{{moment date=d format='YYYY-MM-DD'}}"; 
        }
        return localStorage.getItem("user_selected_date_to");
    }




document.getElementById('datefilterfrom').value = getDate();

document.getElementById('datefilterto').value = getDate_to();





//filtrer par input - champs de saisie-
function filter_results() {


  // Declare variables
  var input, filter, table, tr, td, i;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");
  //table.rows;

  // Loop through all table rows, and hide those who don't match the search query
  for (var i = 1; i < tr.length; i++) {
    var tds = tr[i].getElementsByTagName("td");
    //tr[i].cells;
    var flag = false;

    for (var j =0; j < tds.length; j++){

    var td = tds[j];
    if(td.innerHTML.toUpperCase().indexOf(filter) > -1){
    	flag = true;
    }




    }


if(flag) {
	tr[i].style.display="";
}
else {
	tr[i].style.display="none";
}
 
    }
  


}



//Filtrer par date début et date fin 


// this is to set yesterday date as date début de la période des tournées

/*$(document).ready( function() {
    var now = new Date();
    var month = (now.getMonth() + 1);               
    var day = 1;
    if (month < 10) 
        month = "0" + month;
    if (day < 10) 
        day = "0" + day;
    var start_month = now.getFullYear() + '-' + month + '-' + day;
    $('#datefilterfrom').val(start_month);
});

//onChange datefrom and dateto event 

/*$('#datefilterfrom').on("change", filterRows);
$('#datefilterto').on("change", filterRows);*/



//format date as dd-mm-yyyy


function formatDate(date) {
    var d = new Date(date),
        month = '' + (d.getMonth() + 1),
        day = '' + d.getDate(),
        year = d.getFullYear();

    if (month.length < 2) 
        month = '0' + month;
    if (day.length < 2) 
        day = '0' + day;

    return [day, month, year].join('-');


    //console.log(formatDate('Sun May 11,2014'));


    // output 2022-12-05
}



/* const result = formatDate(new Date('2022', '2', '28'));

console.log(result); */   // 28-03-2022*/

var table = document.getElementById("myTable");
var totalRowCount = table.rows.length; // 5
var tbodyRowCount = table.tBodies[0].rows.length; // 3






var rowcount = document.getElementById("nbr_ligne");













document.querySelectorAll(".nav-item").forEach((ele) =>
  ele.addEventListener("click", function (event) {
    event.preventDefault();
    document
      .querySelectorAll(".nav-item")
      .forEach((ele) => ele.classList.remove("active"));

    this.classList.add("active")
  })
);







//click events 




  document.getElementsByClassName('nav-item')[0]
        .addEventListener('click', function (event) {


var myText = "Tu as cliqué sur un item ajouter tournée !";
    //alert (myText);
    //redirect to the add tournee page
    window.location.replace('add_tournee.php');
  

        });


       document.getElementsByClassName('nav-item')[1]
        .addEventListener('click', function (event) {


var myText = "Tu as cliqué sur un item consulter tournée !";
    //alert (myText);
    window.location.replace('consult_tournee.php');

  

        });

  document.getElementsByClassName('nav-item')[2]
        .addEventListener('click', function (event) {


var myText = "Tu as cliqué sur un item se déconnecter !";
    //alert (myText);
    window.location.replace('login.php');

  

        });


 



$(document).ready(function(){

	$('.striped tr:even').addClass('alt');

});

















// Quick and simple export target #table_id into a csv
function download_table_as_csv(table_id, separator = ',') {
    // Select rows from table_id
    var rows = document.querySelectorAll('#' + table_id + ' tr');
    // Construct csv
    var csv = [];
    for (var i = 0; i < rows.length; i++) {
        var row = [], cols = rows[i].querySelectorAll('td, th');
        for (var j = 0; j < cols.length; j++) {
            // Clean innertext to remove multiple spaces and jumpline (break csv)
            var data = cols[j].innerText.replace(/(\r\n|\n|\r)/gm, '').replace(/(\s\s)/gm, ' ')
            // Escape double-quote with double-double-quote (see https://stackoverflow.com/questions/17808511/properly-escape-a-double-quote-in-csv)
            data = data.replace(/"/g, '""');
            // Push escaped string
            row.push('"' + data + '"');
        }
        csv.push(row.join(separator));
    }
    var csv_string = csv.join('\n');
    // Download it
    var filename = 'GPS_Report ' + new Date().toLocaleDateString() + '.csv';
    var link = document.createElement('a');
    link.style.display = 'none';
    link.setAttribute('target', '_blank');
    link.setAttribute('href', 'data:text/csv;charset=utf-8,' + encodeURIComponent(csv_string));
    link.setAttribute('download', filename);
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
}



function convertDate(d) {
    var p = d.split("/");
    return +(p[2] + p[1] + p[0]);
}









 	</script>





</body>
</html>
