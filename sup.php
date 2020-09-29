<?php
include('includes/config2.php');
$idpack=$_GET["id"] ?? "";
$nom = $_POST['nom'] ?? "";
$prenom = $_POST['prenom'] ?? "";
$sexe = $_POST['sexe'] ?? "";
$taille = $_POST['taille'] ?? "";
$poids = $_POST['poids'] ?? "";
$tel = $_POST['tel'] ?? "";
$naissance =$_POST['birthday'] ?? "";
$typeco = "3";
$email = $_POST['email'] ?? "";
$pa= $_POST['pass'] ?? "";
$pass=md5($pa);
$role="client";
$adresse="";
if(!empty($nom) ){
    $sql = "insert into users (pass,nomprenom,adresse,email,role,tel,prenom,sexe,poid,taille,naissance,niveauCoach) values ('$pass','$nom','$adresse','$email','$role','$tel','$prenom','$sexe','$poids','$taille','$naissance','$typeco')";
    $req = mysqli_query($connect, $sql);
     
     }
     
 if($idpack=="1"){
         echo "<script type='text/javascript'>window.top.location='login.php?id=$idpack';</script>";}
         else{echo "<script type='text/javascript'>window.top.location='login.php';</script>"; exit;}
     ?>