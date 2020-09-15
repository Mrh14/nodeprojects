<?php
require_once '../assets/config/session-verification.php';
require '../configuration/config.php';
require_once '../../url.php';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8" />
    <title>LM Finance : Gestion des avis</title>
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
                                    <li class="breadcrumb-item"><a href="<?=$url?>">LM Finance</a></li>
                                    <li class="breadcrumb-item active" onclick="avis()">Liste des avis</li>
                                </ol>
                            </div>
                            <h4 class="page-title">Liste des Avis</h4>
                        </div>
                    </div>
                </div>
                <!-- end page title -->



                <div class="row">
                    <div class="col-12">
                        <div class="card-box">
                            <div class="container">
                                <div class="row">
                                    <div class="col-lg-4 col-md-4" style="margin-top: 20px">
                                        <div class="card border-danger">
                                            <div class="card-body bg-success text-white">
                                                <div class="row" onclick="listesdesavis('validé')">
                                                    <div class="col-3">
                                                        <i class="fa fa-thumbs-up fa-4x"></i>
                                                    </div>
                                                    <div class="col-9 text-right">
                                                        <h2 class="nbravisv" onchange="calculeavisvalide(this)"> </h2>
                                                        <h4>  Avis validés</h4>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4" style="margin-top: 20px">
                                        <div class="card border-info">
                                            <div class="card-body bg-warning text-white">
                                                <div class="row" onclick="listesdesavis('en attente')">
                                                    <div class="col-3">
                                                        <i class="fa fa-exclamation-circle fa-4x"></i>
                                                    </div>
                                                    <div class="col-9 text-right">
                                                        <h2 class="nbravis" onchange="calculeavisenattente(this)"> </h2>
                                                        <h4> Avis en attente</h4>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4" style="margin-top: 20px">
                                        <div class="card border-info">
                                            <div class="card-body bg-danger text-white">
                                                <div class="row" onclick="listesdesavis('non valide')">
                                                    <div class="col-3">
                                                        <i class="fa fa-thumbs-down fa-4x"></i>
                                                    </div>
                                                    <div class="col-9 text-right">
                                                        <h2 class="nbraviss" onchange="calculeavis(this)"> </h2>
                                                        <h4> Avis non valides</h4>
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

                <div class="row">
                    <div id="liste_des_avis" class="col-lg-12"></div>
                    <!-- end col -->

                </div>
                <!-- end row -->


                <!-- Modal HTML -->
                <div id="modalmodifycustmer" class="modal fade">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4>Modification du client</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            </div>
                            <form id="editicustmer" enctype="multipart/form-data">
                                <div class="modal-body">
                                    <input type="hidden" id="idcustmer" name="idcustmer">
                                    <div class="form-group" style="display: flex">
                                        <label class="col-md-3">Nom Complet</label>
                                        <input name="custmername_modif" id="custmername_modify" type="text" required="required" class="form-control col-md-6"/>
                                    </div>
                                    <div class="form-group" style="display: flex">
                                        <label class="col-md-3">Téléphone</label>
                                        <input name="custmerphone" id="custmerphone_modify" type="tel"  class="form-control col-md-6"/>
                                    </div>
                                    <div class="form-group" style="display: flex">
                                        <label class="col-md-3">Email</label>
                                        <input name="custmermail" id="custmermail_modify" type="email" required="required" class="form-control col-md-6"/>
                                    </div>
                                    <div class="form-group" style="display: flex">
                                        <label class="col-md-3">Adresse</label>
                                        <textarea name="custmeradress" id="custmeradress_modify"  class="form-control col-md-6"></textarea>
                                    </div>
                                    <div class="form-group" style="display: flex">
                                        <label class="col-md-3">ICE</label>
                                        <input name="custmerice" id="custmerice_modify" type="text" class="form-control col-md-6"/>
                                    </div>
                                    <div class="form-group" style="display: flex">
                                        <label class="col-md-3">RS</label>
                                        <input name="custmerrs" id="custmerrs_modify" type="text" class="form-control col-md-6"/>
                                    </div>
                                    <div class="form-group" style="display: flex">
                                        <label class="col-md-3">Nouveau mot de passe</label>
                                        <input name="custmermp" id="custmermp_modify" type="password" class="form-control col-md-6"/>
                                    </div>
                                    <div id="grpsclient" class="form-group"></div>

                                    <div class="form-group" style="display: flex">
                                        <label class="col-md-3">Groupes Client</label>

                                        <select id="groupeclt_modify" data-placeholder="affecter le client à un groupe ..." name="groupesclt[]" multiple class="chosen-select">

                                            <?php
                                            $req="select * from groupe";
                                            $datactg=selectalldata($req);
                                            foreach ($datactg as $row):
                                                ?>
                                                <option value="<?=$row->id_groupe?>"><?=$row->groupe?></option>

                                            <?php endforeach;
                                            ?>
                                        </select>
                                    </div>

                                </div>
                                <div class="modal-footer">
                                    <button class="btn btn-primary nextBtn btn-lg pull-right" type="submit" >Valider</button>
                                    <button class="btn btn-dark nextBtn btn-lg pull-right" data-dismiss="modal" >Annuler</button>

                                </div>


                            </form>
                        </div>
                    </div>
                </div>
                <!-- Modal HTML -->
                <div id="modalsuppcustmer" class="modal fade">
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
                                <p>Voulez-vous vraiment supprimer ce client? </p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-info" data-dismiss="modal">Annuler</button>
                                <button type="button" id="validesuppcustmer" class="btn btn-danger">Supprimer</button>
                            </div>
                        </div>
                    </div>
                </div>

            </div> <!-- container-fluid -->

        </div> <!-- content -->

        <?php
        require_once '../footer.php';
        ?>
