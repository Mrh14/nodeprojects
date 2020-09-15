<?php

include('config.php');

$suc ='1';

$er='0';

$err='';

$obj = json_decode($_POST["datas"]);



$email=trim(strip_tags($obj->email));
$objet=trim(strip_tags($obj->subject));
$nom=trim(strip_tags($obj->name));
$tel=trim(strip_tags($obj->phone));
$message=trim(strip_tags($obj->comment));







//$req2=$bdd->prepare('select * from users where email=?');

//$req2->execute(array($email));

//$row=$req2->rowcount();



if(strlen($tel)< 2 or  strlen($tel)< 2 or  strlen($nom) < 2 ){

    if( $nom=="" or $email =="" or $tel == ""  or $message == ""  or $objet == ""){

        $err .= '<p>* Veuillez remplir tous les champs du formulaire</p><br />';

        $er = '1';

    }



    if(strlen($nom) < 2 ){$err .= '<p>* Le Nom doit contenir au moi 2 caracteres</p><br />';}
    if(strlen($tel)< 2  ){  $err .='<p>* Le numèro de telephone n\'est pas valide</p><br />';}
    if(strlen($message)< 2  ){  $err .='<p>* Le message  est trés court</p><br />';}
    if(strlen($objet)< 2  ){  $err .='<p>* L\'objet  est trés court</p><br />';}
    if(strlen($email)< 2  ){  $err .='<p>* ecrivez un email correct</p><br />';}



    $er = '1';



}







if((!strstr($email , "@")) || (!strstr($email , ".")))

{

    $err .= '<p>* l\'email entré n\'est pas correct</p><br />';

    $er='1';



}



if($er == '0'){

    $req1=$bdd->prepare('insert into contact(cnom,cemail,ctel,cmessage,cobjet) values(?,?,?,?,?)');

    $req1->execute(array($nom,$email,$tel,$message,$objet));

}









echo json_encode(array('suc' =>  (string)$suc,'err' =>  (string)$err ,'er' =>  (string)$er  ));









?>