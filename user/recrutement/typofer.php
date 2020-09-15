<?php
require_once '../assets/config/session-verification.php';
require '../configuration/config.php';
require_once '../../url.php';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8" />
    <title>LM Finance : Gestion des catégories</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />

    <?php
    require_once '../header.php';
    ?>
    <!-- ============================================================== -->
    <!-- Start Page Content here -->
    <!-- ============================================================== -->

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
                                    <li class="breadcrumb-item"><a href="<?=$url?>">myMarket</a></li>
                                    <li class="breadcrumb-item active">Liste des catégories</li>
                                </ol>
                            </div>
                            <h4 class="page-title">Liste des catégories</h4>
                        </div>
                    </div>
                </div>
                <!-- end page title -->

                <div class="row">
                    <div class="col-lg-12">

                        <div class="card-box">
                            <h4 class="header-title">Nouvelle catégorie <i class="fa fa-angle-down" data-toggle="collapse" data-target="#ajouterCateg"></i></h4>
                            <p class="sub-header">
                            </p>

                            <div id="ajouterCateg" class="table-responsive collapse">
                                <!-- Vertical Steps Example -->
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="card-box">

                                            <form id="ajoutercateg" enctype="multipart/form-data">
                                                <div class="form-group flex" >
                                                    <label class="col-md-3">Catégorie</label>
                                                    <input name="categorienom" id="categorie_nom" type="text" required="required" class="form-control col-md-6" placeholder="Nom du catégorie"/>
                                                </div>
                                                <div id="retour"></div>
                                            <button class="btn btn-primary  btn-lg pull-right" type="submit" >Ajouter</button>
                                            </form>

                                        </div> <!-- end card-box -->
                                    </div> <!-- end col -->
                                </div><!-- End row -->

                            </div>
                        </div>
                        <div id="listecategories" class="card-box">

                        </div>
                    </div>
                    <!-- end col -->

                </div>
                <!-- end row -->
                <!--  Modal content for the above example -->
                <div id="bs-example-modal-lg" class="modal fade " tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="myLargeModalLabel">Modification de la catégorie</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            </div>
                            <div class="modal-body">
                                <form id="modifiercateg" enctype="multipart/form-data">
                                    <input type="hidden" id="categ" name="idcateg">
                                    <div class="form-group" style="display: flex">
                                        <label class="col-md-3">Catégorie</label>
                                        <input name="categorienommodif" id="categorie_nom_modif" type="text" required="required" class="form-control col-md-6" placeholder="Nom du catégorie"/>
                                    </div>

                                    <div id="retour_modif"></div>
                                    <button class="btn btn-primary nextBtn btn-lg pull-right" type="submit" >Modifier</button>
                                </form>

                            </div>
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->

                <!-- Modal HTML -->
                <div id="modalsuppCatg" class="modal fade">
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
                                <p>Voulez-vous vraiment supprimer cette catégorie? </p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-info" data-dismiss="modal">Annuler</button>
                                <button type="button" id="validesupp" class="btn btn-danger">Supprimer</button>
                            </div>
                        </div>
                    </div>
                </div>

            </div> <!-- container-fluid -->

        </div> <!-- content -->

        <?php
        require_once '../footer.php';
        ?>
