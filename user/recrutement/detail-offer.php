<?php
require_once '../assets/config/session-verification.php';
require '../configuration/config.php';
require_once '../../url.php';

 $id=$_GET['ida'];

 $data=selectonedata("select * from article where id_article='$id'");

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8" />
    <title>LM Finance : Détail de l'article </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />

    <?php
    require_once '../header.php';
    ?>

    <div class="content-page">
        <div class="content">

            <!-- Start Content-->
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box">
                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="<?=$url?>">LM Finance</a></li>
                                    <li class="breadcrumb-item"><a href="<?=$url?>admin/actualites/articles.php">Liste des articles</a></li>
                                </ol>

                            </div>
                            <h4 class="page-title">Modification de l'article :<?=$data['id_article']?> -- <?=$data['titre']?></h4>

                        </div>
                    </div>
                </div>
                <!-- end page title -->



                <div  class="row ">
                    <div class="col-lg-12">
                        <div class="card-box mybox">
                            <form action="traitements/traiter-article.php" method="post" enctype="multipart/form-data" >
                                <input type="hidden" id="id_article" name="id_article" value="<?=$data['id_article']?>">
                                <input type="hidden" id="auteur_article" name="auteur_article" value="<?=$data['auteur']?>">
                                <input type="hidden" id="min_article" name="min_article" value="<?=$data['image_min']?>">
                                <input type="hidden" id="cont_article" name="cont_article" value="<?=$data['image_contenu']?>">


                                <div class="bord-sec">
                                    <div class="form-group" style="float: right">
                                        <label class="">Date de publication: </label>
                                        <span><?=$data['date_pub']?></span>
                                        <br>
                                        <label class="">Date du dernière modification: </label>
                                        <span><?=$data['date_pub']?></span>
                                        <br>
                                        <label class="">Auteur: </label>
                                        <span><?php
                                            $auteurArt=$data['auteur'];
                                            $auteur=selectonedata("select * from utilisateur where id_user='$auteurArt'");
                                            echo $auteur['nomComplet'];
                                            ?></span>
                                    </div>

                                    <div class="form-group flex">
                                        <label class="col-md-3">Titre de l'article</label>
                                        <input name="titre_article_modif" id="titre_article_modif" type="text" required="required" class="form-control col-md-6" value="<?=$data['titre']?>"/>
                                    </div>
                                    <div class="form-group flex">
                                        <label class="col-md-3">Catégorie de l'article</label>
                                        <select name="categ_article" id="categ_article" class="form-control col-md-6" >

                                            <?php
                                            $categofaarticle=$data['categorie'];
                                            $mycateg=selectonedata("select * from categories where id_cat='$categofaarticle' ");
                                            ?>

                                            <option value="<?=$data['categorie']?>" selected><?=$mycateg['libelle']?></option>

                                            <?php
                                            $categs=selectalldata("select * from categories where etat='1' and id_cat!='$categofaarticle'");
                                            foreach ($categs as $categArticle):
                                            ?>
                                            <option value="<?=$categArticle->id_cat?>"><?=$categArticle->libelle?></option>
                                            <?php
                                            endforeach;
                                            ?>
                                            <option value="0"></option>

                                        </select>

                                  </div>
                                </div>

                                <div class="nothing"></div>


                                <div class="bord-sec flex">
                                    <div class="form-group col-md-6 ">
                                        <label class="">Image miniature de l'article :</label>
                                        <figure class="edit-profile-photo col-md-6">
                                            <figcaption>
                                                <input id="uploadimgp" class="btn btn-dark" type="file" name="txtimgp" style=" display:none"  onchange="imagecatgp(this);">
                                                <a href="" id="upload_linkp" class="btn btn-dark">Ajouter une image</a>​
                                            </figcaption>
                                            <img src="<?=$url?>assets/images/blog/min/<?=$data['image_min']?>"  id="imgp"  class="img-fluid wd-500 wd-xs-500" alt="" style="height: 240px;margin-top: 28px">
                                        </figure>
                                        <p class="red">Votre image de miniature doit être de dimension 361x230 px</p>
                                        <div id="erreurimgp"></div>
                                    </div>
                                    <div class="form-group col-md-6" style="display: block">
                                        <label class="col-md-3">Résumé de l'article :</label> <br>
                                        <textarea name="resume_article" id="resume_article" cols="80" rows="10" required><?=$data['resume']?></textarea>

                                    </div>
                                </div>

                                <div class="nothing"></div>


                                <div class="bord-sec">
                                    <div class="form-group col-md-12">
                                        <label class="">Image de mise en avance de l'article :</label>
                                        <figure class="edit-profile-photo">
                                            <figcaption>
                                                <input id="uploadimgm" class="btn btn-dark" type="file" name="txtimg" style=" display:none"  onchange="imagemiseenavant(this);">
                                                <a href="" id="upload_linkm" class="btn btn-dark">Ajouter une image</a>​
                                            </figcaption>
                                            <img src="<?=$url?>assets/images/blog/contenu/<?=$data['image_contenu']?>"  id="imgm"  class="img-fluid wd-500 wd-xs-500" alt="" style="height: 240px;margin-top: 28px">
                                        </figure>
                                        <p class="red">Votre image de mise en avance doit être de dimension 1700x800 px</p>
                                    </div>
                                    <div class="form-group col-md-12" style="display: block">
                                        <label class="col-md-3">Contenu de l'article :</label> <br>
                                        <textarea name="editor1" id="contenu_article"><?=$data['contenu']?></textarea>

                                    </div>


                                    <br>
                                    <div style="height: 66px">
<!--                                        <input type="reset" class="btn btn-dark btn-lg pull-right" value="Annuler">-->
                                        <input type="submit" class="btn btn-primary btn-lg pull-right" value="Valider">

                                    </div>

                                </div>



                            </form>
                        </div>
                    </div>
                </div>



            </div> <!-- container-fluid -->

        </div> <!-- content -->
    </div>

    <?php
    require_once '../footer.php';
    ?>
