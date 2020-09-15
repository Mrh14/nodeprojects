<?php

require '../assets/config/config.php';
require_once '../../url.php';

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8" />
    <title>myMarket : Modification du mot de passe</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="Coderthemes" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="<?=$url?>admin/assets/images/favicon.ico">

    <!-- App css -->
    <link href="<?=$url?>admin/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="<?=$url?>admin/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <link href="<?=$url?>admin/assets/css/app.min.css" rel="stylesheet" type="text/css" />

</head>

<body class="authentication-bg authentication-bg-pattern d-flex align-items-center">

<div class="home-btn d-none d-sm-block">
    <a href="<?=$url?>admin"><i class="fas fa-home h2 text-white"></i></a>
</div>

<div class="account-pages w-100 mt-5 mb-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6 col-xl-5">
                <div class="card">

                    <div class="card-body p-4">

                        <div class="text-center mb-4">
                            <a href="<?=$url?>admin">
                                <span><img src="<?=$url?>admin/assets/images/my-market-logo1.png" alt="" height="50"></span>
                            </a>
                            <h2 class="text-muted mt-3">Modification mot de passe</h2>
                        </div>

                                <form id="modifmp" role="form" class="parsley-examples" novalidate="">
                                    <div class="form-group row">
                                        <label for="hori-pass1" class="col-sm-4 col-form-label">Email :</label>
                                        <div class="col-sm-7">
                                            <?php
                                            if (isset($_GET['id'])) {
                                                $edituser = intval($_GET['id']);
                                            ?>
                                            <input id="usertoupd" type="hidden" value="<?=$edituser?>" class="form-control">
                                            <input  type="email" value="<?=$_GET['mail']?>" class="form-control" disabled>
                                            <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="hori-pass1" class="col-sm-4 col-form-label">Nouveau mot de passe<span class="text-danger">*</span></label>
                                        <div class="col-sm-7">
                                            <input id="hori-pass1" type="password" placeholder="Mot de passe" required="" class="form-control">
                                        </div>
                                        <div id="erreurmpm"></div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="hori-pass2" class="col-sm-4 col-form-label">Confirmation du mot de passe
                                            <span class="text-danger">*</span></label>
                                        <div class="col-sm-7">
                                            <input  type="password" required="" placeholder="Mot de passe" class="form-control" id="hori-pass2">
                                        </div>
                                    </div>

                                    <div id="erreur"></div>
                                    <div class="form-group row mb-0">
                                        <div class="col-sm-8 offset-sm-4">
                                            <button type="submit" class="btn btn-primary waves-effect waves-light mr-1" id="modifiermp">
                                                Modifier
                                            </button>
                                            <button type="reset" class="btn btn-light waves-effect">
                                                Annuler
                                            </button>
                                        </div>
                                    </div>
                                </form>
                        <!-- end row -->

                    </div> <!-- end card-body -->
                </div>
                <!-- end card -->

            </div> <!-- end col -->
        </div>
        <!-- end row -->
    </div>
    <!-- end container -->
</div>
<!-- end page -->

<!-- Vendor js -->
<script src="<?=$url?>admin/assets/js/vendor.min.js"></script>

<!-- App js -->
<script src="<?=$url?>admin/assets/js/app.min.js"></script>
<script src="<?=$url?>admin/assets/js/script.js"></script>


</body>
</html>
