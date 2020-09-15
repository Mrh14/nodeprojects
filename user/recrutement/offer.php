<?php
require_once '../assets/config/session-verification.php';
require '../configuration/config.php';
require_once '../../url.php';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8" />
    <title>LM Finance : Getion des articles</title>
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
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Liste des articles</a></li>
                                </ol>

                            </div>
                            <h4 class="page-title">Liste des articles</h4>

                        </div>
                    </div>
                </div>
                <!-- end page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="card-box">
                            <div class="container">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6" style="margin-top: 20px">
                                        <div class="card border-danger">
                                            <div class="card-body bg-success text-white">
                                                <div class="row" onclick="articles()">
                                                    <div class="col-3">
                                                        <i class="fa fa-file fa-4x"></i>
                                                    </div>
                                                    <div class="col-9 text-right">
                                                        <h2 class="nbrArt" onchange="nbrearticles(this)"></h2>
                                                        <h4>Articles </h4>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6" style="margin-top: 20px">
                                        <div class="card border-info">
                                            <div class="card-body bg-warning text-white">
                                                <div class="row" onclick="listesdesarchive()">
                                                    <div class="col-3">
                                                        <i class="fa fa-file-archive fa-4x"></i>
                                                    </div>
                                                    <div class="col-9 text-right">
                                                        <h2 class="nbrArtAv" onchange="nbrearticlesarchives(this)"></h2>
                                                        <h4> Articles archivés</h4>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- end row -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box">
                            <a href="#" class="btn btn-primary" style="float: right" data-toggle="collapse" data-target="#newpost"><i class="fa fa-plus"></i>Nouvel article</a>
                        </div>
                    </div>
                </div>

                <div id="newpost" class="row collapse">
                    <div class="col-lg-12">
                     <div class="card-box">
                        <form id="addnewpost"  enctype="multipart/form-data " >

                            <div class="bord-sec">
                                <div class="form-group  flex">
                                    <label class="col-md-3">Titre de l'article</label>
                                    <input name="titre_article" id="titre_article" type="text" required="required" class="form-control col-md-6" placeholder=""/>
                                </div>
                                <div class="form-group flex">
                                    <label class="col-md-3">Catégorie de l'article</label>
                                    <select name="categ_article" id="categ_article" class="form-control col-md-6" >
                                        <option value="0">catégorie de l'article</option>

                                        <?php
                                        $categs=selectalldata("select * from categories where etat='1'");
                                        foreach ($categs as $categArticle):
                                        ?>
                                        <option value="<?=$categArticle->id_cat?>"><?=$categArticle->libelle?></option>
                                        <?php
                                        endforeach;
                                        ?>
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
                                        <img src="<?=$url?>user/assets/images/img12.jpg"  id="imgp"  class="img-fluid wd-500 wd-xs-500" alt="" style="height: 240px;margin-top: 28px">
                                    </figure>
                                    <p class="red">Votre image de miniature doit être de dimension 361x230 px</p>
                                    <div id="erreurimgp"></div>
                                </div>
                                <div class="form-group col-md-6" style="display: block">
                                    <label class="col-md-3">Résumé de l'article :</label> <br>
                                    <textarea name="resume_article" id="resume_article" cols="80" rows="10" required></textarea>

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
                                        <img src="<?=$url?>admin/assets/images/img-avatar.png"  id="imgm"  class="img-fluid wd-500 wd-xs-500" alt="" style="height: 240px;margin-top: 28px">
                                    </figure>
                                    <p class="red">Votre image de mise en avance doit être de dimension 1700x800 px</p>
                                </div>
                                <div class="form-group col-md-12" style="display: block">
                                    <label class="col-md-3">Contenu de l'article :</label> <br>
                                    <textarea name="editooor1" id="summernote-editor"></textarea>

                                </div>


                                <br>
                                <div style="height: 66px">
                                    <input type="reset" class="btn btn-dark btn-lg pull-right" value="Annuler">
                                    <input type="submit" class="btn btn-primary btn-lg pull-right" value="Ajouter">

                                </div>

                            </div>


                        </form>
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="col-12">
                        <div class="card-box">

                            <div id="listeproduits" class="responsive-table-plugin">
                            </div>

                        </div> <!-- end card-box -->
                    </div> <!-- end col -->
                </div>
                <!-- end row -->
                <div id="modalsuppProduit" class="modal fade">
                    <div class="modal-dialog modal-confirm">
                        <div class="modal-content">
                            <div class="modal-header">
                                <div class="icon-box">
                                    <i class="fas fa-exclamation"></i>
                                </div>
                                <h4 class="modal-title">Êtes vous sûre?</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            </div>
                            <div class="modal-body">
                                <p>Voulez-vous vraiment supprimer cet article? </p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-info" data-dismiss="modal">Annuler</button>
                                <button type="button" id="validesuppArt" class="btn btn-danger">Supprimer</button>
                            </div>
                        </div>
                    </div>
                </div>


                <div id="notif" class="modal fadeInUp">
                    <div class="modal-dialog modal-confirm">
                        <div class="modal-content">
                    <div class="">
                        <i class="fa fa-exclamation-circle orange fa-2x"></i>
                        <p id="contenu_notif"></p>
                    </div>
                        </div>
                    </div>
                </div>
            </div> <!-- container-fluid -->

        </div> <!-- content -->
    </div>

<?php
require_once '../footer.php';
?>
