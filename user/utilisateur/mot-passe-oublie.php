<?php

require '../assets/config/config.php';
require_once '../../url.php';

if(isset($_POST['action'])){
    if($_POST['action']=='demandemodifmp'){

        $usermail=$_POST['email'];

        $authen= "select * from ps_employee where email='$usermail'";
        $nbr=countdata($authen);

        if($nbr==false){

            echo "Il n'existe aucun compte avec cette adresse email";


        }else{

            $identificateur=selectalldata($authen);

            $email = $_POST['email'];
            $req = "select * from ps_employee where email='$email'";
            $ident = selectalldata($req);

            foreach ($ident as $row):
                $result = $row->id_employee;
//            if($row->profil=='admin'){

                $lien = $url."admin/utilisateur/modif-mot-passe-oublier.php?id=".$result."&mail=".$email;

//            }elseif ($row->profil=='client'){
//
//                $lien = $url."modifier-mot-de-passe/".$result;
//            }

                $to =$_POST['email'];
                $from ="admin@admin.ma";
                $message = "&nbsp;&nbsp;&nbsp;&nbsp;<strong>Nom: </strong>".$row->lastname;
                $message .= "&nbsp;&nbsp;&nbsp;<strong> </strong>".$row->firstname."<br />";
                $message .= "&nbsp;&nbsp;&nbsp;&nbsp; <strong>Email: </strong>".$_POST['email']."<br /><br />";
                $message .= "&nbsp;&nbsp;&nbsp;&nbsp; Il semble que vous avez oublié votre mot de passe d'authentification pour l'accès à votre site d'administration. <br />";
                $message .= "&nbsp;&nbsp;&nbsp;&nbsp; Nous vous invitons à rejoindre le lien ci-dessus pour pouvoir modifier votre mot de passe :<br />";
                $message .= $lien;
                $subject = 'Récupération de mot de passe';
                $headers = "From: ".$from."\n";
                $headers .= "MIME-Version: 1.0" . "\r\n";
                $headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";

                $send =	mail($to,$subject,$message,$headers);

                if($send){
                    echo 'Veuillez vérifier votre adresse email';
                }

                break;
            endforeach;
        }


    }elseif ($_POST['action']=='modifiermp'){
        $newmp=md5($_POST['newmp']);
        $edituser=$_POST['useredit'];

        $datattoupdate=array(
            "mot_passe"=>$newmp,
            "useredit"=>$edituser
        );
        $sqledit = "update ps_employee set passwd=:mot_passe where id_employee=:useredit";

        $req = updatedata($sqledit, $datattoupdate) ;
        if($req){
            echo "Votre mot de passe a été modifier avec succès.";
        }else{
            echo 'erreur';
        }


    }
}



?>
