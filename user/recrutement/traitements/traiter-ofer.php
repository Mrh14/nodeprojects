<?php

require_once '../../assets/config/session-verification.php';
require '../../configuration/config.php';
require_once '../../../url.php';


    if(isset($_POST['action'])){

        if($_POST['action']=='listedesarticles'){


            $queryy="select * from article where archive='0' order by date_pub desc ";

            if(countdata("select count(*) from article")==0){?>
                <div class="table-rep-plugin">
                    <div class="table-responsive" data-pattern="priority-columns">
                        <table id="tech-companies-1" class="table table-striped">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Article</th>
                                <th data-priority="1">Auteur</th>
                                <th data-priority="3">Catégorie</th>
                                <th data-priority="1">Date de publication</th>
                                <th data-priority="6">Action</th>

                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <th>Aucun article ajouté</th>

                            </tr>


                            </tbody>
                        </table>
                    </div>

                </div>
            <?php
            }else{
                ?>
                <div class="table-rep-plugin">
                    <div class="table-responsive" data-pattern="priority-columns">
                        <table id="tech-companies-1" class="table table-striped">
                            <thead>

                            <tr>
                                <th>ID</th>
                                <th>Article</th>
                                <th data-priority="1">Auteur</th>
                                <th data-priority="3">Catégorie</th>
                                <th data-priority="1">Date de publication</th>
                                <th data-priority="6">Action</th>
                            </tr>

                            </thead>
                            <tbody>
                <?php
                $datap=selectalldata($queryy);
                foreach ($datap as $rowp):
                    ?>
                            <tr>
                                <th><?=$rowp->id_article?></th>
                                <td>
                                    <a href="<?=$url?>admin/actualites/detail-art.php?ida=<?=$rowp->id_article?>">
                                        <img src="<?=$url?>assets/imgages/blog/min/<?=$rowp->image_min?>" alt="" style=" height: 30px"> &nbsp;<?=$rowp->titre?></a></td>
                                <td><?php
                                    $reqa=selectonedata("select nomComplet from utilisateur where id_user='$rowp->auteur'");

                                 echo $reqa['nomComplet']; ?></td>
                                <td><?php
                                    $req=selectonedata("select libelle from categories where id_cat='$rowp->categorie'");

                                    echo $req['libelle'];
                                    ?></td>


                                <td><?=$rowp->date_pub?></td>
                                <td>
                                    <a href="<?=$url?>admin/actualites/detail-art.php?ida=<?=$rowp->id_article?>">
                                        <i class="mdi mdi-pencil-outline" style="font-size: 20px" data-toggle="tooltip" data-placement="bottom" title="Modifier"></i>
                                    </a>
                                    <a href="#" data-toggle="modal" data-target="#modalsuppProduit" onclick="supprimerart('<?=$rowp->id_article?>','<?=$rowp->image_min?>','<?=$rowp->image_contenu?>')">
                                        <i class="mdi mdi-trash-can-outline" style="font-size: 20px" data-toggle="tooltip" data-placement="bottom" title="Supprimer"></i>
                                    </a>
                                    <a href="#"  onclick="archiverpost('<?=$rowp->id_article?>',0)">
                                        <i class="fa fa-file-archive" style="font-size: 20px" data-toggle="tooltip" data-placement="bottom" title="Archiver"></i>
                                    </a>
                                </td>
                            </tr>

                <?php
                endforeach;
                ?>
                            </tbody>
                        </table>
                    </div>

                </div>

           <?php }
        }
        elseif($_POST['action']=='listedesarticlesarchive'){


            $queryy="select * from article where archive='1' order by date_pub desc ";

            if(countdata("select count(*) from article")==0){?>
                <div class="table-rep-plugin">
                    <div class="table-responsive" data-pattern="priority-columns">
                        <table id="tech-companies-1" class="table table-striped">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Article</th>
                                <th data-priority="1">Auteur</th>
                                <th data-priority="3">Catégorie</th>
                                <th data-priority="1">Date de publication</th>
                                <th data-priority="6">Action</th>

                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <th>Aucun article ajouté</th>

                            </tr>


                            </tbody>
                        </table>
                    </div>

                </div>
            <?php
            }else{
                ?>
                <div class="table-rep-plugin">
                    <div class="table-responsive" data-pattern="priority-columns">
                        <table id="tech-companies-1" class="table table-striped">
                            <thead>

                            <tr>
                                <th>ID</th>
                                <th>Article</th>
                                <th data-priority="1">Auteur</th>
                                <th data-priority="3">Catégorie</th>
                                <th data-priority="1">Date de publication</th>
                                <th data-priority="6">Action</th>
                            </tr>

                            </thead>
                            <tbody>
                <?php
                $datap=selectalldata($queryy);
                foreach ($datap as $rowp):
                    ?>
                            <tr>
                                <th><?=$rowp->id_article?></th>
                                <td>
                                    <a href="<?=$url?>admin/actualites/detail-art.php?ida=<?=$rowp->id_article?>">
                                        <img src="<?=$url?>assets/imgages/blog/min/<?=$rowp->image_min?>" alt="" style=" height: 30px"> &nbsp;<?=$rowp->titre?></a></td>
                                <td><?php
                                    $reqa=selectonedata("select nomComplet from utilisateur where id_user='$rowp->auteur'");

                                 echo $reqa['nomComplet']; ?></td>
                                <td><?php
                                    $req=selectonedata("select libelle from categories where id_cat='$rowp->categorie'");

                                    echo $req['libelle'];
                                    ?></td>


                                <td><?=$rowp->date_pub?></td>
                                <td>
                                    <a href="<?=$url?>admin/actualites/detail-art.php?ida=<?=$rowp->id_article?>">
                                        <i class="mdi mdi-pencil-outline" style="font-size: 20px" data-toggle="tooltip" data-placement="bottom" title="Modifier"></i>
                                    </a>
                                    <a href="#" data-toggle="modal" data-target="#modalsuppProduit" onclick="supprimerart('<?=$rowp->id_article?>','<?=$rowp->image_min?>','<?=$rowp->image_contenu?>')">
                                        <i class="mdi mdi-trash-can-outline" style="font-size: 20px" data-toggle="tooltip" data-placement="bottom" title="Supprimer"></i>
                                    </a>

                                    <a href="#" onclick="archiverpost('<?=$rowp->id_article?>',1)">
                                        <i class="fa fa-box-open" style="font-size: 20px" data-toggle="tooltip" data-placement="bottom" title="Supprimer"></i>
                                    </a>


                                </td>
                            </tr>

                <?php
                endforeach;
                ?>
                            </tbody>
                        </table>
                    </div>

                </div>

           <?php }
        }
        elseif ($_POST['action']=='affichageprod'){

            $idprod=$_POST['id'];
            $afficher=$_POST['affichage'];
            if($afficher==0){

                $arraytoadd=array(
                        "id"=>$idprod,
                    "afficher"=>1
                );
            }else{

                $arraytoadd=array(
                    "id"=>$idprod,
                    "afficher"=>0
                );
            }

            updatedata("update produit set affichage=:afficher where id_produit=:id", $arraytoadd);
        }
        elseif ($_POST['action']=='supprimerarticle'){

            $idart=$_POST['id'];
            $min=$_POST['imgp'];
            $cover=$_POST['imgc'];


            $dirmin = "../../../assets/img/actualite/";
            $dirconten = "../../../assets/img/actualite/";


            if(deletedata("delete from article where id_article='$idart'")){

                unlink($dirmin.$min);
                unlink($dirconten.$cover);


            }

        }
        elseif ($_POST['action']=='archiver'){

            $idart=$_POST['article'];
            $etatart=$_POST['etat'];

            echo $etatart;
            if($etatart==0){
                $archive=1;

            }else{
                $archive=0;

            }
            updatedata("update article set archive=:archive where id_article=:id", array("archive"=>$archive, "id"=>$idart));


        }
        elseif ($_POST['action']=="nbredesarticles"){

            echo   countdata("select count(*) from article where archive='0'");

        } elseif ($_POST['action']=="nbredesarticlesArchiv"){

            echo countdata("select count(*) from article where archive='1'");

        }
    }



    if(isset($_POST['titre_article'])){


        $titre_article=trim(htmlspecialchars_decode($_POST['titre_article'], ENT_QUOTES));


        $auteur_article=(int)$user;


        $resume_article=ltrim(htmlspecialchars_decode($_POST['resume_article'], ENT_QUOTES)) ;


        $contenu_article=ltrim(htmlspecialchars_decode($_POST['editooor1'], ENT_QUOTES));


        $date_pub_article=date("d-m-Y");



        if(!empty($_FILES['txtimg']['name'])){
            $img_contenu_article=time().$_FILES['txtimg']['name'];
        }else{
            $img_contenu_article="";
        }

        if(!empty($_FILES['txtimgp']['name'])){
            $miniature_article=time().$_FILES['txtimgp']['name'];
        }else{
            $miniature_article="";
        }



        if(!empty($_POST['categ_article'])){

            $categorie_article=(int)$_POST['categ_article'];

        }else{
            $categorie_article=0;

        }



        $var1=array('&#039;',' ',',', '<','>','«','»','à','á','À' ,'ä','Ä','ã','å','Å','æ','Æ','Á','â','Ã','ç','Ç','é','É','è','È','ê','Ê','ë','Ë', 'í','Í','ì','Ì','î','Î','ï','Ï','ñ','Ñ','ó','Ó','ò','Ò','ô','Ô','ö','Ö','õ','Õ','ø','Ø','œ','Œ','ú' ,'Ú','ù' ,'Ù' ,'û','Û' ,'ü','Ü','&szlig;','’','&amp;','$','£','§','(',')','{','}','[',']');
        $var2=array('-','-','','','','','','a','a','a','a','a','a','a','a','a','a','a','a','a','c','c','e','e','e','e','e','e','e','e','i','i','i','i','i','i','i','i','n','n','o','o','o','o','o','o','o','o','o','o','o','o','o','o','u','u','u','u','u','u','u','u','-','','-','-','-','-','-','-','-','-','-','-');

        $url_article=strtolower(str_replace($var1,$var2,ltrim(htmlspecialchars($_POST['titre_article'],ENT_QUOTES))));



        $dirmin = "../../../assets/img/actualite/";
        $dirconten = "../../../assets/img/actualite/";


        $imageminlocation=$dirmin.basename($miniature_article);
        $imagecontlocation=$dirconten.basename($img_contenu_article);



        $cont=countdata("select count(*) from article where url='$url_article' and  categorie='$categorie_article'");
        if($cont==0){

            $queryart="insert into article (titre, url, auteur, resume, contenu, date_pub, image_contenu,image_min, categorie) VALUES (?,?,?,?,?,?,?,?,?)";
            $articleoinsert=array($titre_article,
                $url_article,
                $auteur_article,
                $resume_article,
                $contenu_article,
                $date_pub_article,
                $img_contenu_article,
                $miniature_article,
                $categorie_article);

            if(insertdata($queryart,$articleoinsert)) {


                move_uploaded_file($_FILES['txtimgp']['tmp_name'], $imageminlocation);
                move_uploaded_file($_FILES['txtimg']['tmp_name'], $imagecontlocation);

            }

        }else{

            echo '0';
            echo 'error';

        }




    }




    if(isset($_POST['id_article'])){

        $id_article=(int)$_POST['id_article'];

        $titre_article=trim(htmlspecialchars_decode($_POST['titre_article_modif'], ENT_QUOTES));

        $auteur_article=(int)$_POST['auteur_article'];

        $resume_article=ltrim(htmlspecialchars_decode($_POST['resume_article'], ENT_QUOTES)) ;

        $contenu_article=ltrim(htmlspecialchars_decode($_POST['editor1'], ENT_QUOTES));


        $date_modif_article=date("d-m-Y");

        $miniature_article=time().$_FILES['txtimgp']['name'];
        $oldmin=$_POST['min_article'];
        $oldcont=$_POST['cont_article'];


        if(!empty($_FILES['txtimgp']['name'])){
            $miniature_article=time().$_FILES['txtimgp']['name'];
        }else{
            $miniature_article=$oldmin;
        }


        if(!empty($_FILES['txtimg']['name'])){
            $img_contenu_article=time().$_FILES['txtimg']['name'];
        }else{
            $img_contenu_article=$oldcont;
        }



        if(!empty($_POST['categ_article'])){

            $categorie_article=(int)$_POST['categ_article'];

        }else{
            $categorie_article=0;

        }


        $var1=array('&#039;',' ',',', '<','>','«','»','à','á','À' ,'ä','Ä','ã','å','Å','æ','Æ','Á','â','Ã','ç','Ç','é','É','è','È','ê','Ê','ë','Ë', 'í','Í','ì','Ì','î','Î','ï','Ï','ñ','Ñ','ó','Ó','ò','Ò','ô','Ô','ö','Ö','õ','Õ','ø','Ø','œ','Œ','ú' ,'Ú','ù' ,'Ù' ,'û','Û' ,'ü','Ü','&szlig;','’','&amp;','$','£','§','(',')','{','}','[',']');
        $var2=array('-','-','','','','','','a','a','a','a','a','a','a','a','a','a','a','a','a','c','c','e','e','e','e','e','e','e','e','i','i','i','i','i','i','i','i','n','n','o','o','o','o','o','o','o','o','o','o','o','o','o','o','u','u','u','u','u','u','u','u','-','','-','-','-','-','-','-','-','-','-','-');

        $url_article=strtolower(str_replace($var1,$var2,ltrim(htmlspecialchars($_POST['titre_article_modif'],ENT_QUOTES))));



        $dirmin = "../../../assets/img/actualite/";
        $dirconten = "../../../assets/img/actualite/";


        $imageminlocation=$dirmin.basename($miniature_article);
        $imagecontlocation=$dirconten.basename($img_contenu_article);



        $cont=countdata("select count(*) from article where url='$url_article' and categorie='$categorie_article' and id_article!='$id_article'");

        if($cont==0){

            $queryart="update article set titre=:newtitle, url=:newurl, resume=:newresume, contenu=:newcontent, image_contenu=:newimgc, date_modif=:date_modif, image_min=:newimgm, categorie=:newcateg where id_article=:myart";
            $articleoinsert=array(
                       "newtitle"=>$titre_article,
                       "newurl"=>$url_article,
                       "newresume"=>$resume_article,
                       "newcontent"=>$contenu_article,
                       "newimgc"=> $img_contenu_article,
                       "date_modif"=>$date_modif_article,
                       "newimgm"=>$miniature_article,
                       "newcateg"=>$categorie_article,
                       "myart"=>$id_article
                      );

            if(updatedata($queryart,$articleoinsert)) {

              //  unlink($dirmin.$miniature_article);
               // unlink($dirconten.$img_contenu_article);

                move_uploaded_file($_FILES['txtimgp']['tmp_name'], $imageminlocation);
                move_uploaded_file($_FILES['txtimg']['tmp_name'], $imagecontlocation);

                echo '<script>window.location.replace("../articles.php")</script>';

            }

        }else{

            echo '0';

        }

    }









?>
