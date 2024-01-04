<!DOCTYPE html>
<html>
<head>
	  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

 

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

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


textarea {
  width: 170px;
  height: 70px;
} 


td { vertical-align: top; }

.middle{

	vertical-align: top;

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

body{

    /*background: url(../backimage.jpg) no-repeat center center fixed;*/

}


#container{



}

#mylegend{
	float:left;
}

.container{
	

}




	</style>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="js/bootstrap.min.js">

<title>Suivi des tournées par GPS</title>

</head>



<body>




<div class="topnav"> 
	 <span class="closebtn" id="MyElement">&times;</span>
        <span id="menu">
  <a id="add" href="#add_tournee" class="nav-item"> <i class="fa fa-plus" aria-hidden="true"  > Ajouter tournée</i></a>
  <a id="consult" href="#consult_tournee" class="nav-item"><i class="fa fa-eye" aria-hidden="true" >Consulter tournée</i></a>
  <a id="update" href="#update_tournee" class="nav-item"><i class="fa fa-edit" aria-hidden="true" >Modifier tournée</i></a>
  <a id="delete" href="#delete_tournee" class="nav-item active"><i class="fa fa-trash" aria-hidden="true" >Supprimer tournée</i></a>
  <a href="javascript:void(0);" class="icon" onclick="myFunction()">
    <i class="fa fa-bars"></i>
  </a>
</span>

</div>

 <script>


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


var myText = "Tu as cliqué sur un item mettre à jour tournée !";
    //alert (myText);
window.location.replace('update_tournee.php');

        });

          document.getElementsByClassName('nav-item')[3]
        .addEventListener('click', function (event) {


var myText = "Tu as cliqué sur un item supprimer tournée !";
    //alert (myText);
   window.location.replace('delete_tournee.php');


        });




 	</script>




<script type="text/javascript">
	
</script>
</body>
</html>