<?php

    require_once '../../assets/config/session-verification.php';
    require '../../configuration/config.php';
    require_once '../../../url.php';

    if(isset($_POST['action'])){
        if($_POST['action']=='listedescategories'){?>
            <h4 class="header-title">Liste des catégories</h4>
            <p class="sub-header">

            </p>

         <?php   $query="select * from categories order by id_cat desc ";
            $rows=countdata("select count(*) from categories order by id_cat desc");
            if($rows==0){?>
            <div  class="table-responsive">
                <table class="table mb-0">
                    <thead class="thead-light">
                    <tr>
                        <th>ID</th>
                        <th>Catégorie</th>
                        <th>Nombre des articles</th>
                        <th>Afficher</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <th>aucune catégorie ajoutée</th>

                    </tr>

                    </tbody>
                </table>
            </div>
        <?php    }else{?>
                <div  class="table-responsive">
                <table class="table mb-0">
                    <thead class="thead-light">
                    <tr>
                        <th>ID</th>
                        <th>Catégorie</th>
                        <th>Nombre des articles</th>
                        <th>Afficher</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $data=selectalldata($query);
                    foreach ($data as $row):
                    ?>
                    <tr>
                        <th><?=$row->id_cat?></th>
                        <td>
                                <?=$row->libelle?>
                        </td>
                        <td>
                            <?php $nbrarticle= countdata("select count(*) from article where categorie='$row->id_cat'");
                            echo $nbrarticle;?>
                        </td>
                        <td><?php
                            if($row->etat==0){?>
                                <i class=" mdi mdi-eye-off-outline" style="color: red; font-size: 20px" onclick="afficherCatg(<?=$row->id_cat?>,0)" title="afficher les articles de cette catégorie"></i>
                           <?php }else{?>
                        <i class=" mdi mdi-eye-outline" style="color: green; font-size: 20px" onclick="afficherCatg(<?=$row->id_cat?>,1)" title="archiver les articles de cette catégorie"></i>
                    <?php }?></td>
                        <td>
                            <a href="#" data-toggle="modal" data-target="#bs-example-modal-lg" onclick="modify('<?=$row->id_cat?>','<?=$row->libelle?>')"><i class="mdi mdi-grease-pencil" style="font-size: 20px" data-toggle="tooltip" data-placement="bottom" title="Modifier"></i></a>

                            <?php
                            if ($nbrarticle==0) {
                                ?>
                                <a href="#" data-toggle="modal" data-target="#modalsuppCatg"
                                   onclick="supprimerCateg('<?= $row->id_cat ?>')">
                                    <i class="mdi mdi-trash-can-outline" style="font-size: 20px" data-toggle="tooltip"
                                       data-placement="bottom" title="Supprimer"></i>
                                </a>
                                <?php
                            }
                                ?>
                        </td>

                    </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
                </div>
         <?php   }
        }
        elseif($_POST['action']=='affichage_article_categ') {
            $id=$_POST['id'];
            $param=$_POST['param'];

            if($param==1){

                $archifage=1;
                $archv=0;
            }else{
                $archifage=0;
                $archv=1;


            }

            updatedata("update article set archive=:archiv where categorie=:idcateg",array("archiv"=>$archifage, "idcateg"=>$id));
            updatedata("update categories set etat=:archiv where id_cat=:idcateg",array("archiv"=>$archv, "idcateg"=>$id));
        }

        elseif ($_POST['action']=='supprimerunecatg'){
            $id=$_POST['id'];
           if(deletedata("delete from categories where id_cat='$id'")){
               echo'categorie supprimée';

           }else{
               echo'erreur';
           }


        }
    }







            if(isset($_POST['categorienom'])){

                $nomcategorie=ltrim(htmlspecialchars($_POST['categorienom'],ENT_QUOTES));


                $req="select count(*) from categories where libelle='$nomcategorie'";
                if(countdata($req)=="0"){

                $query="insert into categories (libelle) values(?) ";
                $categtoinsert=array($nomcategorie);

                    insertdata($query,$categtoinsert);

                }else{
                    echo "Cette catégorie existe déjà";
                }
            }



            if(isset($_POST['categorienommodif'])){

                $nomcategorie=ltrim(htmlspecialchars($_POST['categorienommodif'],ENT_QUOTES));
                $id=$_POST['idcateg'];




                $req="select count(*) from categories where libelle='$nomcategorie' and id_cat!='$id'";
                if(countdata($req)==0){

                    $query="update categories set libelle=:newcateg where id_cat=:idcateg";


                    $categtoupdate=array(
                            "idcateg"=>$id,
                            "newcateg"=>$nomcategorie,
                    );


                   updatedata($query,$categtoupdate);


                }else{
                    echo "Cette catégorie existe déjà";
                }
            }
        ?>
