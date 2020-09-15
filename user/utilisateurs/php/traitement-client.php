<?php

require_once '../../assets/config/session-verification.php';
require '../../../configuration/config.php';
require_once '../../../url.php';

   if(isset($_POST['action'])) {

    if ($_POST['action']=='clientslist') {

        $req="select * from client";
        if(countdata($req)==false) {
            ?>

            <table class="table table-dark mb-0">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Nom </th>
                    <th>Email</th>
                    <th>Date d'inscription</th>
                    <th>ICE</th>
                    <th>RS</th>
                    <th>État du compte</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>
                        aucun client existant
                    </td>
                </tr>

                </tbody>
            </table>
            <?php
        }else{
            ?>
            <table class="table table-dark mb-0">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Nom </th>
                    <th>Email</th>
                    <th>Date d'inscription</th>
                    <th>ICE</th>
                    <th>RS</th>
                    <th>État du compte</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                <?php
                $data=selectalldata($req);
                foreach ($data as $item):
                    ?>
                    <tr>
                        <th scope="row"><?=$item->id_client?></th>
                        <td><?=$item->nomPrenom?></td>
                        <td><?=$item->email?></td>
                        <td><?=$item->date_inscription?></td>
                        <td><?=$item->ICE?></td>
                        <td><?=$item->RS?></td>
                        <td
                           <?php
                           if($item->etat_compte=='Compte validé'){
                               echo 'style="color: green;"';
                           }elseif ($item->etat_compte=='Compte suspendue'){
                               echo 'style="color: red;"';

                           }else{
                               echo 'style="color: orange;"';
                           }
                           ?>
                        ><?=$item->etat_compte?></td>

                        <td>
                            <?php
                            if ($item->etat_compte=='Compte suspendue'){?>
                                <a href="#" onclick="mettreComptedispo('<?=$item->id_client?>')" title="Mettre ce compte à disposition"><i class="mdi mdi-check green"></i></a>
                          <?php
                            }else{?>
                                <a href="#" onclick="suspendreCompte('<?=$item->id_client?>')" title="Suspendre ce compte"><i class="mdi mdi-close red"></i></a>
                           <?php }
                            ?>
                            <a href="#" onclick="modifycustmer('<?=$item->id_client?>','<?=$item->nomPrenom?>','<?=$item->tele?>','<?=$item->email?>','<?=$item->adresse?>','<?=$item->ICE?>','<?=$item->RS?>','<?=$item->etat_compte?>')" data-toggle="modal" data-target="#modalmodifyteam"><i class="mdi mdi-pencil"></i></a>
                            <a href="#" onclick="deletecustmer('<?=$item->id_client?>')" data-toggle="modal" data-target="modalsuppteam"><i class="mdi mdi-trash-can"></i></a>
                        </td>
                    </tr>

                <?php
                endforeach;
                ?>
                </tbody>
            </table>

            <?php
        }
    }
    elseif ($_POST['action']=='deletcustmer'){
        $idclt=$_POST['idclt'];

        if(deletedata("delete from client where id_client='$idclt'")){
            deletedata("delete from grp_client where client='$idclt'");
            echo 'good job';
        }

    }
    elseif ($_POST['action']=='suspendreclient'){
        $idclt=$_POST['idclt'];
        $datatoupdate= array(
                "suspendue"=>'Compte suspendue',
            "idclient"=>$idclt
        );

        if(updatedata("update client set etat_compte=:suspendue where id_client=:idclient",$datatoupdate)){

            echo 'good job';
        }

    }
    elseif ($_POST['action']=='mettreeclientadispo'){
        $idclt=$_POST['idclt'];
        $datatoupdate= array(
                "suspendue"=>'Compte non validé',
            "idclient"=>$idclt
        );

        if(updatedata("update client set etat_compte=:suspendue where id_client=:idclient",$datatoupdate)){

            echo 'good job';
        }

    }
    elseif ($_POST['action']=='grpsduclientx'){
        $client=$_POST['clit'];
        $mareq="select distinct * from grp_client where client='$client'";

        if(countdata($mareq)!=false) {
            ?>
            <label class="col-md-3">Groupes du Clients : </label>

            <?php
            $mydata = selectalldata($mareq);
            foreach ($mydata as $myrow):

                $req3 = "select * from groupe where id_groupe='$myrow->groupe'";
                $datactg3 = selectonedata($req3);
                ?>
                <input type="checkbox" name="grpsclt1[]" value="<?= $myrow->groupe ?>" checked>
                <span><?= $datactg3['groupe'] ?></span>
            <?php
            endforeach;
        }
        ?>

<?php
    }
}


   if(isset($_POST['custmername'])){
    $name=trim(htmlspecialchars($_POST['custmername'],ENT_QUOTES));
    $tel=trim(htmlspecialchars($_POST['custmerphone'],ENT_QUOTES));
    $mail=trim(htmlspecialchars($_POST['custmermail'],ENT_QUOTES));
    $adress=trim(htmlspecialchars($_POST['custmeradress'],ENT_QUOTES));
    $ice=trim(htmlspecialchars($_POST['custmerice'],ENT_QUOTES));
    $rs=trim(htmlspecialchars($_POST['custmerrs'],ENT_QUOTES));
    $hispassword=md5($_POST['custmermp']);

   if(countdata("select * from client where email='$mail'")==false){

       $datattoinsert=array($name, $tel, $mail, $adress, $hispassword, date('d-m-Y'), $ice, $rs);

      if( insertdata("insert into client (nomPrenom, tele, email, adresse, mot_passe, date_inscription, ICE, RS) values (?,?,?,?,?,?,?,?)",$datattoinsert)){

          $mydata=selectonedata("select id_client from client where email='$mail'");
          foreach($_POST['groupesclt'] as $check) {
              $querycatg="insert into grp_client (client, groupe) values (?,?)";
              $catgtoinsert=array($mydata['id_client'],$check);
              insertdata($querycatg,$catgtoinsert);
          }

      }else{
          echo "erreur";
      }

   } else{
       echo 'ce compte client existe déjà';
   }
}


   if(isset($_POST['custmername_modif'])){
    $name=trim(htmlspecialchars($_POST['custmername_modif'],ENT_QUOTES));
    $tel=trim(htmlspecialchars($_POST['custmerphone'],ENT_QUOTES));
    $mail=trim(htmlspecialchars($_POST['custmermail'],ENT_QUOTES));
    $adress=trim(htmlspecialchars($_POST['custmeradress'],ENT_QUOTES));
    $ice=trim(htmlspecialchars($_POST['custmerice'],ENT_QUOTES));
    $rs=trim(htmlspecialchars($_POST['custmerrs'],ENT_QUOTES));
    $hispassword=md5($_POST['custmermp']);
    $idclt=$_POST['idcustmer'];

   if(countdata("select * from client where email='$mail' and id_client!='$idclt'")==false){

       $datattoupdate=array(
           "newname"=>$name,
           "newtel"=>$tel,
           "newmail"=> $mail,
           "newadress"=>$adress,
           "newmp"=>$hispassword,
           "newice"=>$ice,
           "newrs"=> $rs,
           "idclt"=>$idclt);

      if( insertdata("update client set nomPrenom=:newname, tele=:newtel, email=:newmail, adresse=:newadress, mot_passe=:newmp,ICE=:newice, RS=:newrs where id_client=:idclt",$datattoupdate)){

          deletedata("delete from grp_client where client='$idclt'");
          foreach($_POST['groupesclt'] as $check) {
              $querycatg="insert into grp_client (client, groupe) values (?,?)";
              $catgtoinsert=array($idclt,$check);
              insertdata($querycatg,$catgtoinsert);
          }
         foreach($_POST['grpsclt1'] as $check) {
              $querycatg="insert into grp_client (client, groupe) values (?,?)";
              $catgtoinsert=array($idclt,$check);
             insertdata($querycatg,$catgtoinsert);
         }

      }else{
          echo "erreur";
      }

   } else{
       echo 'ce compte client existe déjà';
   }
}


?>
