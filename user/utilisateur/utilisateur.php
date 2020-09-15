<?php
require_once '../assets/config/session-verification.php';
require '../configuration/config.php';
require_once '../../url.php';
?> 
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8" />
    <title>myMarket : Gestion des utilisateurs</title>
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
                                    <li class="breadcrumb-item active">Liste des utilisateurs</li>
                                </ol>
                            </div>
                            <h4 class="page-title">Liste des utilisateurs</h4>
                        </div>
                    </div>
                </div>
                <!-- end page title -->

                <div class="row">
                    <div class="col-lg-8">

                        <div class="card-box">
                            <h4 class="header-title">Liste des clients <i class="fa fa-angle-down" data-toggle="collapse" data-target="#listeclients"></i></h4>
                            <p class="sub-header">
                            </p>

                            <div id="listeclients" class="table-responsive collapse">
                            </div>
                        </div>
                        <div class="card-box">
                            <h4 class="header-title">Liste des administrateurs</h4>
                            <p class="sub-header">

                            </p>

                            <div id="listeuser" class="table-responsive">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">

                        <div class="card-box">
                            <h4 class="header-title">Nouvel utilisateur</h4>
                            <p class="sub-header">

                            </p>

                            <form id="newuser" class="parsley-examples">
                                <div class="form-group">
                                    <label for="userName">Nom<span class="text-danger">*</span></label>
                                    <input type="text" name="userName" parsley-trigger="change" required
                                           placeholder="Nom d'utilisateur" class="form-control" id="userName">
                                </div>
                                <div class="form-group">
                                    <label for="userLastName">Prénom<span class="text-danger">*</span></label>
                                    <input type="text" name="userLastName" parsley-trigger="change" required
                                           placeholder="prénom d'utilisateur" class="form-control" id="userLastName">
                                </div>
                                <div class="form-group">
                                    <label for="emailAddress">Email<span class="text-danger">*</span></label>
                                    <input type="email" name="email" parsley-trigger="change" required
                                           placeholder="Email d'utilisateur" class="form-control" id="emailAddress">
                                </div>
                                <div class="form-group">
                                    <label for="phone">Téléphone</label>
                                    <input type="tel" name="phone" parsley-trigger="change"
                                           placeholder="Numéro du téléphone" class="form-control" id="phoneuser">
                                </div>
                                <div class="form-group">
                                    <label for="profil">Profil<span class="text-danger">*</span></label>
                                    <select required id="inputState" class="form-control" name="profil" >
                                        <option value="" >profil</option>
                                        <option value="admin" >Admin</option>
                                        <option value="gestionnaire">Gestionnaire</option>
                                        <option value="client">Client</option>

                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="pass1">Mot de passe<span class="text-danger">*</span></label>
                                    <input id="pass1" type="password" placeholder="Mot de passe" required
                                           name="paswrd" class="form-control">
                                </div>
                                <div id="erreurmpm"></div>
                                <div class="form-group">
                                    <label for="passWord2">Confirmation du mot de passe<span class="text-danger">*</span></label>
                                    <input  type="password" required  placeholder="Mot de passe" class="form-control" id="passWord2">
                                </div>
                                <div id="error"></div>
                                <div class="form-group text-right mb-0">
                                    <button class="btn btn-primary waves-effect waves-light mr-1" id="adduser" type="submit">
                                        Ajouter
                                    </button>
                                    <button type="reset" class="btn btn-light waves-effect">
                                        Annuler
                                    </button>
                                </div>

                            </form>
                        </div> <!-- end card-box -->
                    </div>
                    <!-- end col -->

                </div>
                <!-- end row -->


                <!-- sample modal content -->
                <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="myModalLabel">Modification d'utilisateur</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            </div>
                            <div class="modal-body">

                                <form id="modifyuser" class="parsley-examples">
                                    <input type="hidden" name="userIdEdit" parsley-trigger="change" required class="form-control" id="edituserID">
                                    <div class="form-group">
                                        <label for="userName">Nom<span class="text-danger">*</span></label>
                                        <input type="text" name="userNameEdit" parsley-trigger="change" required class="form-control" id="edituserName">
                                    </div>
                                    <div class="form-group">
                                        <label for="userLastNameEdit">Prénom<span class="text-danger">*</span></label>
                                        <input type="text" name="userLastNameedit" parsley-trigger="change" required class="form-control" id="edituserLastName">
                                    </div>
                                    <div class="form-group">
                                        <label for="emailAddress">Adresse Email<span class="text-danger">*</span></label>
                                        <input type="email" name="emailedit" parsley-trigger="change" required class="form-control" id="editemailAddress">
                                    </div>
                                    <div class="form-group">
                                        <label for="phone">Téléphone</label>
                                        <input type="tel" name="phoneedit" parsley-trigger="change" class="form-control" id="editphoneuser">
                                    </div>
                                    <div class="form-group">
                                        <label for="profil">Profil<span class="text-danger">*</span></label>
                                        <select required id="editinputState" class="form-control" name="profiledit" >
                                            <option value="admin" >Admin</option>
                                            <option value="gestionnaire">Gestionnaire</option>
                                            <option value="client">Client</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="pass1">Nouveau mot de passe<span class="text-danger">*</span></label>
                                        <input id="editpass1" type="password" placeholder="Mot de passe" required
                                               name="paswrdedit" class="form-control">
                                    </div>
                                    <div id="erreurmpmedit"></div>
                                    <div class="form-group">
                                        <label for="passWord2">Confirmation du mot de passe<span class="text-danger">*</span></label>
                                        <input  type="password" required  placeholder="Mot de passe" class="form-control" id="editpassWord2">
                                    </div>
                                    <div id="erroredit"></div>
                                    <div class="form-group text-right mb-0">
                                        <button class="btn btn-primary waves-effect waves-light mr-1" id="edituser" type="submit">
                                            Valider
                                        </button>
                                        <button type="reset" class="btn btn-light waves-effect" data-dismiss="modal">
                                            Annuler
                                        </button>
                                    </div>

                                </form>
                            </div>

                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->


                <div id="modalmsg" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="myModalLabel">Contacter Client</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            </div>
                            <div class="modal-body">

                                <form id="contactuser" class="parsley-examples">

                                    <div class="form-group">
                                        <label for="emailAddress">À</label>
                                        <input type="email" name="emailtosend" parsley-trigger="change" required class="form-control" id="mailclient" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label for="sujet">Sujet</label>
                                        <input type="text" name="subjecttosend" parsley-trigger="change" class="form-control" id="sujettosend" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="messagetosend">Message<span class="text-danger">*</span></label>

                                        <textarea class="form-control" id="example-textarea" rows="5" required></textarea>
                                    </div>
                                    <div id="recall"></div>
                                    <div class="form-group text-right mb-0">
                                        <button class="btn btn-primary waves-effect waves-light mr-1" type="submit">
                                            Envoyer
                                        </button>
                                        <button type="reset" class="btn btn-light waves-effect" data-dismiss="modal">
                                            Annuler
                                        </button>
                                    </div>

                                </form>
                            </div>

                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->



                <div id="bs-example-modal-center" class="modal fade " tabindex="-1" role="dialog" aria-labelledby="myCenterModalLabel" aria-hidden="true" style="display: none;">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="myCenterModalLabel">Suppression d'utilisateur</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            </div>
                            <form id="deleteuser" class="parsley-examples">

                            <div class="modal-body">
                                <form id="deleteuser" class="parsley-examples">
                                    <div class="form-group text-center mb-0">
                                        Êtes vous sûr de vouloir supprimer cet utilisateur?
                                    </div>
                            </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary waves-effect waves-light">Supprimer</button>
                                    <button type="reset" class="btn btn-light waves-effect" data-dismiss="modal">Annuler</button>
                                </div>
                            </form>
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->

            </div> <!-- container-fluid -->

        </div> <!-- content -->

     <?php
        require_once '../footer.php';
        ?>
