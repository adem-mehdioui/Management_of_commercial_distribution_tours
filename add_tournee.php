<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
 

 

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.1/css/bootstrap-select.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.1/js/bootstrap-select.js"></script>




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
        top:-0.5em;
        text-align: center;
    } 


li{

    list-style-type: square;
    margin-bottom: 10px;

}

fieldset{
    width:90%;
    height: 90%;
    background-color:  #BFD7ED;
    border:  1px solid #ccc;
    margin:  0.5em 0;
    
    /*background: url(../backimage.jpg) no-repeat center center fixed;*/

}


.field_set{
  border-style: solid;
  padding-left: 10px;
  padding-right: 10px;

  
}


textarea {
  width: 170px;
  height: 70px;
} 


td { vertical-align: top; }

.middle{

	vertical-align: top;

}


#difference {

color: red;
border-color: red;
pointer-events: none;


}

#duree_mission {

pointer-events: none;

  }




input[id="difference"]::-webkit-calendar-picker-indicator {
   filter: invert(0.14) sepia(0.83) saturate(72) hue-rotate(11deg) ;   	
}


/* Add a black background color to the top navigation */
.topnav {
  background-color: #333;
  overflow: hidden;
  padding-top: 5px;
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


#mylegend{
	margin-bottom: 40px;

}


.textarea1 {
  resize: none;
  width: 350px;
  height: 100px;

}





#mylegend{
	float:left;
}






	</style>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="js/bootstrap.min.js">

<title>Suivi des tournées par GPS</title>
</head>


<!--filter: invert(0.5) sepia(1) saturate(5) hue-rotate(175deg);!-->



<?php

// database connection code
// $con = mysqli_connect('localhost', 'database_user', 'database_password','database');

$con = mysqli_connect('localhost', 'root', '','suivigps');


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Something posted




// database insert SQL code
/*$sql = "INSERT INTO `tournee` (`region`, `date_tournee`, `nom_commercial`, `nom_chauffeur`,'matricule' ,'heure_depart_chauffeur', 'heure_depart_commercial', 'heure_premiere_visite', 'heure_dernier_visite','heure_arrive_commercial','heure_arrive_chauffeur','nombre_visite_clients','temps_tournee','observation') VALUES ( '$region', '$date', '$nom_comm', '$nom_chauff','$mat_vehicule',$depart_chauff','$depart_comm','$heure_1_visite','$heure_d_visitee','$heure_arrive_comm','$heure_arrive_chauff','$nbr_visite','$temps_tournee')";*/


$stmt = $con->prepare("INSERT INTO tournee (region, date_tournee, nom_commercial, nom_chauffeur, matricule ,heure_depart_chauffeur ,heure_depart_prevu, heure_depart_effective, ecart, heure_arrive, duree_mission, observation) VALUES ( ?, ?, ?, ?,?,?,?,?,?,?,?,?)");

$stmt->bind_param('ssssssssssss',$region,$date, $nom_comm, $nom_chauff, $matricule, $heure_depart_chauffeur, $heure_depart_prevu, $heure_depart_effective,$ecart ,$heure_arrive, $duree_mission, $observation);

$region = $_POST['txtregion'];
$date = $_POST['txtdate'];
$nom_comm = $_POST['txtnom_comm'];
$nom_chauff = $_POST['txtnom_chauff'];
$matricule = $_POST['txtmatricule'];
$heure_depart_chauffeur = $_POST['heure_depart_chauffeur'];
$heure_depart_prevu = $_POST['heure_depart_prevu'];
$heure_depart_effective = $_POST['heure_depart_effective'];
$ecart = $_POST['ecart'];
$heure_arrive = $_POST['heurearrive'];
$duree_mission = $_POST['duree_mission'];
$observation = $_POST['observation'];





$stmt->execute();

$stmt->close();




}

// submit
// set success flash message (you are using a framework, right?)




?>


<body>





<div class="topnav"> 
	 <span class="closebtn" id="MyElement">&times;</span>
        <span id="menu">
  <a id="add" href="#add_tournee" class="nav-item active"> <i class="fa fa-plus" aria-hidden="true"  > Ajouter tournée</i>
  </a>
  <a id="consult" href="#consult_tournee" class="nav-item"><i class="fa fa-eye" aria-hidden="true" >Consulter tournée</i>
  </a>


  <a id="logout" href="#login" class="nav-item"><i class="fa fa-sign-out" aria-hidden="true">Se déconnecter</i></a>
  
  
 
</span>

</div>



	<div class="container" id="container">

<fieldset  class="field_set" >
<legend id="mylegend" style="text-decoration: underline;">Saisie Des Indicateurs GPS pour le Suivi des Tournées Commerciales</legend>
<form name="frmContact" method="post" action="add_tournee.php">

<p>

<span >
<label for="Name">Région<span class="glyphicon glyphicon-map-marker"></span></label>
<!--<input type="text" name="txtregion" class="form-control" required="true"  >   !-->


<select    class="selectpicker form-control" data-width="auto" name="txtregion" data-live-search="true" required >
	<option disabled selected value>Choisir Région</option>
        <option>23/1</option>
        <option>23/2</option>
        <option>36 Taref</option>
        <option>C1</option>
        <option>C2</option>
        <option>C3</option>
        <option>C4</option>
        <option>C5</option>
        <option>24 Guelma</option>
        <option>21 Skikda</option>    
        <option>21/1 Collo</option>
        <option>19 Setif</option>     
        <option>19/1 Ain azel</option>     
        <option>19/2 Bougaa</option>
        <option>43 Mila</option>  
        <option>05 Batna</option>
        <option>05/1 Merouana</option>
        <option>07 Biskra</option> 
        <option>51 Ouled djellal</option> 
        <option>04 Oum El Bouaghi</option>   
        <option>34 BBA</option>  
        <option>12 Tebessa /El Ouenza</option>   
        <option>12/1 Bir El Ater</option>    
        <option>06 Bejaia /Akbou</option>
        <option>41 Souk Ahras</option>    
        <option>10 Bouira</option>    
        <option>40 Khenchla</option>       
        <option>SUD 1</option>  
        <option>SUD 2</option> 
        <option>47 Ghardaia</option> 
        <option>18 Jijel</option> 

<optgroup label="Régions additionnelles">   
        <option>16 Alger</option>   
        <option>31 Oran</option>    
    </optgroup>
 

        


      
 
</select>


</span>


<span>
<label for="email">Date</label>
<input type="Date" name="txtdate" required="true" id="date_tournee" value=" <?php echo date('d-m-Y',strtotime("-1 days")); ?>" class="form-control" max="9999-12-31">
</span>

<span>
<label for="phone">Nom du Commercial</label>
<!--<input type="text" name="txtnom_comm" required="true" class="form-control"> !-->



<select class="selectpicker form-control" data-width="auto" name="txtnom_comm" required="true" data-live-search="true" required >
		<option disabled selected value>Choisir Commercial</option>
		<optgroup label="Délégué commercial">  
     
        <option>Filali Yahia</option>
        <option>Azzam Tarek</option>
        <option>Boulaam Khaled</option>
        <option>Beghidja Atef</option>
        <option>Bahri Seif</option>
        <option>Boukerrouche Hichem</option>
        <option>Diabi Redha</option>
        <option>Kouider Smail</option>
        <option>Talbi Naoufel</option>    
        <option>Daoudi Taki</option>
        <option>Euchi Mounder</option>
        <option>Merahi Oussama</option>     
        <option>Guerfa Salah</option>
         </optgroup>  

         <optgroup label="Service Achats">   
        <option>Mouatsi Saber</option>
        <option>Serdouk Mohamed</option>
         </optgroup>  

        <optgroup label="Service Trésorerie">
        <option>Bouhidel Djallel</option>
        </optgroup>  





        <optgroup label="Service Administration">
        <option>Taleb Rached</option>  
        </optgroup>

         <optgroup label="Service Direction">
         <option>Haroun Abdelkader</option>  

         </optgroup>
        
        <optgroup label="Service Commercial">
        <option>Ouzir Zakaria</option>
        <option>Kemmouche Ahmed</option>
        </optgroup>  

        <option>Service Caisse</option>   
     
 
</select>


</span>

<span>
	<label for="message">Nom du Chauffeur</label>
   <!-- <input type="text" name="txtnom_chauff" required="true" class="form-control" >   !-->

<select class="selectpicker form-control" data-width="auto" name="txtnom_chauff" required="true" data-live-search="true" required >
  <option disabled selected value>Choisir Chauffeur</option>
  <option>Aouina Sofiane</option>
  <option>Aissous Zahreddine</option>
  <option>Mechati Seddik</option>
  <option>Abdi Abderrahmane</option>
  <option>Amraoui Abdelghani</option>
  <option>Djedli Riad</option>
  <option>Merikhi Salah</option>
  <option>Zouaoui Sofiane</option>
  <option>Guerrot Sofiane</option>
  <option>Benamira Rabah</option>
  <option>Taleb Rached</option>
  <option>Zoghmar Ghoulam</option>
  <option>Parc MGX</option>

 
</select>


</span>

<span>
	<label for="message">Matricule Véhicule</label>
   <!--   <input type="text" name="txtmatricule" class="form-control">   !-->


<select class="selectpicker form-control" data-width="auto" name="txtmatricule" required="true" data-live-search="true" required >
  <option disabled selected value>Choisir Véhicule</option>
  <option>Kangoo 00272-320-25</option>
  <option>Kangoo 01097-314-25</option>
  <option>Cady 00117-318-25</option>
  <option>Kangoo 00267-315-25</option>
  <option>K2700 00804-317-25</option>
  <option>Cady 00201-318-25</option>
  <option>Stepway 10602-119-25</option>
  <option>K2700 00045-314-25</option>
  <option>Berlingo 00242-317-25</option>
  <option>Partner 01377-310-25</option>
  <option>Partner 00178-317-25</option>
  <option>Cady 00122-318-25</option>
  <option>Kangoo 01232-315-25</option>
  <option>Kangoo 00268-315-25</option>
  <option>K2700 00742-316-25</option>


 

</select>


</span>

</p>
<p>&nbsp;</p>











<table class="form-group" >   

	  


    <tr>
        <td>
            <label>Heure prévue mission : </label>
        </td>
        <td  style="padding-left:10px;">
            <input id="start" name="heure_depart_prevu" value="" type="time" class="form-control">
        </td>
        <th rowspan="2">
        	<label style="color: red;" >Ecart : </label>
        	<input type="time" name="ecart" id="difference" class="form-control" ></th>
        </th>

    </tr>

     <tr>
        <td>
            <label>Heure départ chauffeur : </label>
        </td>
        <td  style="padding-left:10px;">
            <input name="heure_depart_chauffeur" value="" type="time" class="form-control">
        </td>
     
    </tr>

    
    <tr >
        <td>
            <label>Heure effective mission : </label>
        </td>
        <td  style="padding-left:10px;" >
            <input id="end" name="heure_depart_effective" value="" type="time"  class="form-control">
        </td>

     

       
     
    </tr>

     <tr>
        <td>
            <label>Heure retour à Constantine: </label>
        </td>
        <td  style="padding-left:10px;" >
            <input id="heure_arrive" name="heurearrive" value="" type="time" class="form-control">
        </td>

    </tr>
     <tr>
        <td>
            <label>Durée de la mission : </label>
        </td>
        <td  style="padding-left:10px;">
            <input id="duree_mission" name="duree_mission" value="" type="time"  class="form-control" >
        </td>
                   <script>






function diff(start, end) {

var start = document.getElementById("start").value;
var end = document.getElementById("end").value;

document.getElementById("start").onchange = function() {diff(start,end)};
document.getElementById("end").onchange = function() {diff(start,end)};





    start = document.getElementById("start").value; //to update time value in each input bar
    end = document.getElementById("end").value; //to update time value in each input bar
    
    start = start.split(":");
    end = end.split(":");
    var startDate = new Date(0, 0, 0, start[0], start[1], 0);
    var endDate = new Date(0, 0, 0, end[0], end[1], 0);
    var diff = endDate.getTime() - startDate.getTime();
    var hours = Math.floor(diff / 1000 / 60 / 60);
    diff -= hours * 1000 * 60 * 60;
    var minutes = Math.floor(diff / 1000 / 60);

    return (hours < 9 ? "0" : "") + hours + ":" + (minutes < 9 ? "0" : "") + minutes;
}






setInterval(function(){document.getElementById("difference").value = diff(start, end);}, 1000 + "(heure)"); 






function delay(end, heure_arrive) {
    start = document.getElementById("end").value; //to update time value in each input bar
    end = document.getElementById("heure_arrive").value; //to update time value in each input bar
    


document.getElementById("end").onchange = function() {delay(end,heure_arrive)};
document.getElementById("heure_arrive").onchange = function() {delay(end,heure_arrive)};





    start = start.split(":");
    end = end.split(":");
    var startDate = new Date(0, 0, 0, start[0], start[1], 0);
    var endDate = new Date(0, 0, 0, end[0], end[1], 0);
    var diff = endDate.getTime() - startDate.getTime();
    var hours = Math.floor(diff / 1000 / 60 / 60);
    diff -= hours * 1000 * 60 * 60;
    var minutes = Math.floor(diff / 1000 / 60);

    return (hours < 9 ? "0" : "") + hours + ":" + (minutes < 9 ? "0" : "") + minutes;
}



setInterval(function(){document.getElementById("duree_mission").value = delay(end, heure_arrive);}, 1000); 



//setInterval(function(){document.getElementById("duree_mission").value = dif(end, heure_arrive);}, 1000 + "(heure)"); 






//document.getElementById("diff").disabled = true;//to update time every second (1000 is 1 sec interval and function encasing original code you had down here is because setInterval only reads functions) You can change how fast the time updates by lowering the time interval



 


// Get all buttons with class="btn" inside the container


// Loop through the buttons and add the active class to the current/clicked button
/*for (var i = 0; i < items.length; i++) {
  items[i].addEventListener("click", function() {
    var current = document.getElementsByClassName("active");
    current[0].className = current[0].className.replace(" active", "");
    this.className += " active";
  });
}*/




document.querySelectorAll(".nav-item").forEach((ele) =>
  ele.addEventListener("click", function (event) {
    event.preventDefault();
    document
      .querySelectorAll(".nav-item")
      .forEach((ele) => ele.classList.remove("active"));

    this.classList.add("active")
  })
);






    function load_consult() {
    // document.getElementsByClassName('container').innerHTML='<object type="text/html" data="consult_tournee.php" ></object>';

document.getElementById('container').innerHTML = '<object type="text/html" data="consult_tournee.php" ></object>';


}

  function load_update() {
    // document.getElementsByClassName('container').innerHTML='<object type="text/html" data="consult_tournee.php" ></object>';

document.getElementById('container').innerHTML = '<object type="text/html" data="update_tournee.php" ></object>';


}

  function load_delete() {
    // document.getElementsByClassName('container').innerHTML='<object type="text/html" data="consult_tournee.php" ></object>';

document.getElementById('container').innerHTML = '<object type="text/html" data="delete_tournee.php" ></object>';


}





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

  









//set date de la tournee == date yesterday 

document.getElementById('date_tournee').valueAsDate = new Date(new Date().setDate(new Date().getDate()-1));




/*function getYesterdaysDate() {
    var date = new Date();
    date.setDate(date.getDate()-1);
    return date.getDate() + '/' + (date.getMonth()+1) + '/' + date.getFullYear();
}*/








</script>
    </tr>
</table>

<table>
	<tr>
        <td>
            <label>Observation : </label>
        </td>
        <td  style="padding-left:10px;">
        	<textarea name="observation"  class="form-control textarea1"></textarea>      
        </td>
    </tr>
</table>








<p>
<input type="submit" name="Submit" id="Submit" value="Enregistrer" class="btn btn-success" >
</p>




</form>
</fieldset>
</div>



</body>
</html>