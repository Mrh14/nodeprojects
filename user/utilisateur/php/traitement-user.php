<?php

require '../../configuration/config.php';
require '../../assets/config/session-verification.php';
require_once '../../../url.php';


        if(isset($_POST['userName'])){

            $newname=trim(htmlspecialchars($_POST['userName'],ENT_QUOTES));
            $newlastname=trim(htmlspecialchars($_POST['userLastName'],ENT_QUOTES));
            $newmail=trim($_POST['email']);
            $newphone=$_POST['phone'];
            $newprofil=$_POST['profil'];
            $newpassword=md5($_POST['paswrd']);

            if(countdata("select * from ps_employee where email='$newmail'")==false){
                $datatoinsert=array($newname,$newlastname,$newmail,$newphone,'',date('d-m-Y'),$newprofil, $newmail, $newpassword,1);
                insertdata("insert into ps_employee (nom, prenom, mail, telef, adresse, date_creation_compte, profil, login, mot_passe,confirme) values (?,?,?,?,?,?,?,?,?,?)",$datatoinsert);

            }else{
                echo 'Il existe déjà un compte avec cet adresse email';
            }


        }


if(isset($_POST['userNameEdit'])){

    $newid=$_POST['userIdEdit'];
    $newname=trim(htmlspecialchars($_POST['userNameEdit'],ENT_QUOTES));
    $newlastname=trim(htmlspecialchars($_POST['userLastNameedit'],ENT_QUOTES));
    $newmail=trim($_POST['emailedit']);
    $newphone=$_POST['phoneedit'];
    $newprofil=$_POST['profiledit'];
    $newpassword=md5($_POST['paswrdedit']);

    if(countdata("select * from utilisateur where mail='$newmail' and id_user!='$newid'")==false){

        $datatoupdate=array(
            "id"=>$newid,
            "namo"=>$newname,
            "lastname"=>$newlastname,
            "mail"=>$newmail,
            "phone"=>$newphone,
            "profil"=>$newprofil,
            "login"=>$newmail,
            "password"=>$newpassword
        );
        updatedata("update utilisateur set nom=:namo, prenom=:lastname, mail=:mail, telef=:phone, profil=:profil, login=:login, mot_passe=:password where id_user=:id",$datatoupdate);

    }else{
        echo 'Il existe déjà un compte avec cet adresse email';
    }


}
        if(isset($_POST['action'])){
            if($_POST['action']=='afficheruser'){?>
                                    <table class="table mb-0">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Utilisateur</th>
                                        <th>Email</th>
                                        <th>Profil</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $query1="select * from utilisateur where profil!='client' and id_user!='$user'";
                                    if (countdata($query1)==false){
                                        echo '<tr><td>aucun utilisateur ajouté</td></tr>';
                                    }else {
                                        $data1 = selectalldata($query1);
                                        foreach ($data1 as $row1):
                                            ?>
                                            <tr>
                                                <th scope="row"><?= $row1->id_user ?></th>
                                                <td><?= $row1->nom ?> <?= $row1->prenom ?></td>
                                                <td><?= $row1->mail ?></td>
                                                <td><?= $row1->profil ?></td>
                                                <td>
                                                    <i class="fa fa-pen" data-toggle="modal" data-target="#myModal" onclick="modify('<?= $row1->id_user ?>','<?= $row1->nom ?>','<?= $row1->prenom ?>','<?= $row1->mail ?>','<?= $row1->telef ?>','<?= $row1->profil ?>')"></i> &nbsp
                                                    <i class="fa fa-trash" data-toggle="modal" data-target="#bs-example-modal-center" onclick="delet('<?= $row1->id_user ?>')"></i>&nbsp
                                                </td>
                                            </tr>
                                        <?php
                                        endforeach;
                                    }
                                    ?>
                                    </tbody>
                                </table>
<?php
            }elseif($_POST['action']=='listeclients'){
                ?>
                <table class="table mb-0">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Client</th>
                        <th>Email</th>
                        <th>Confirmation</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $query1="select * from utilisateur where profil='client'";
                    if (countdata($query1)==false){
                        echo '<tr><td>aucun client</td></tr>';
                    }else {
                        $data1 = selectalldata($query1);
                        foreach ($data1 as $row1):
                            ?>
                            <tr>
                                <th scope="row"><?= $row1->id_user ?></th>
                                <td><?= $row1->nom ?> <?= $row1->prenom ?></td>
                                <td><?= $row1->mail ?></td>
                                <td class="<?php
                                if ($row1->confirme == 0) {
                                    echo 'red';
                                } else {
                                    echo 'green';
                                }
                                ?>"><?php
                                    if ($row1->confirme == 0) {
                                        echo 'compte non validé';
                                    } else {
                                        echo 'validé';
                                    }
                                    ?></td>
                                <td>
                                    <i class="fa fa-pen" data-toggle="modal" data-target="#myModal" onclick="modify('<?= $row1->id_user ?>','<?= $row1->nom ?>','<?= $row1->prenom ?>','<?= $row1->mail ?>','<?= $row1->telef ?>','<?= $row1->profil ?>')"></i> &nbsp
                                    <i class="fa fa-trash" data-toggle="modal" data-target="#bs-example-modal-center" onclick="delet('<?= $row1->id_user ?>')"></i>&nbsp
                                    <i class="icon icon-envelope-open" data-toggle="modal" data-target="#modalmsg" onclick="sendmsg('<?= $row1->mail ?>')"></i>
                                </td>
                            </tr>
                        <?php
                        endforeach;
                    }
                    ?>




                    </tbody>
                </table>
                <?php
            }elseif($_POST['action']=='supprimer') {
                $iduser=$_POST['id'];

                deletedata("delete from ps_employee where id_employee='$iduser'");

            }elseif($_POST['action']=='sendmsg') {
                $mailclt=$_POST['mail'];


                $from = "support@mymarket.ma";

                $to = $mailclt;
                $date = new DateTime();

                $email_subject = "myMarket Hypermarché en ligne le ".$date->format('Y-m-d');
                $message =
                    "\nSujet	  :   ".$_POST['sujet'].
                    "\nMessage:\n".htmlspecialchars($_POST['msg']);

                $headers = "From:" . $from;

                if(mail($to,$email_subject,$message, $headers)){
                    echo 'Message Envoyé';
                }else{
                    echo 'Erreur de connexion';
                }

            }
        }

?>
