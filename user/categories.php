<?php

include('includes/cookie.php');
requisadmin('non','','login');
include('includes/json/getdatas.php');
if(isset($_GET['del']) and $_GET['del']!='' ){
    include('includes/json/config.php');
    $del = intval($_GET['del']);
//liste des categories
    $reqz=$bdd->prepare('delete from categories where id_cat=?');
    $reqz->execute(array($del));;
///
//liste des categories
    $reqz=$bdd->prepare('select * from categories');
    $reqz->execute();
    $resultzz = $reqz->fetchAll(\PDO::FETCH_ASSOC);
///

}else{
    include('includes/json/cgetdatas.php');
}




?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
        <title>Digitaldata - Formations</title>
        <meta content="Admin Dashboard" name="description" />
        <meta content="ThemeDesign" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <script src="assets/js/jquery.min.js"></script>
        <link rel="shortcut icon" href="assets/images/favicon.ico">

        <!-- Dropzone css -->
        <link href="assets/plugins/dropzone/dist/dropzone.css" rel="stylesheet" type="text/css">

        <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
        <link href="assets/css/icons.css" rel="stylesheet" type="text/css">
        <link href="assets/css/style.css" rel="stylesheet" type="text/css">

    </head>


    <body class="fixed-left">
    <script>
        //poster la mission
        $('document').ready(function(){


            //// modifier la categorie
            $(document).on('click', '#dalf', function() {
                var idc = $(this).data('id');
                window.setTimeout(function() {
                    window.location.replace("nouvcat.php?edit="+ idc);
                },500);
            });



            //// supprimer la categorie
            $(document).on('click', '#dell', function() {
                var idc = $(this).data('id');
                window.setTimeout(function() {
                    window.location.replace("categories.php?del="+ idc);
                },500);
            });

            //formation de validation des champs
            function checkinv(champ){var g= 0;
                if($(champ).val().length >= 2){ g= 0; $(champ).removeClass('is-invalid'); $(champ).addClass('is-valid');}
                else{ g= 1; $(champ).removeClass('is-valid'); $(champ).addClass('is-invalid');}
                c.push(g);
                return g;
            }
            $('#datatable').DataTable({"order" : [[0,"desc"]]});

        });
    </script>
        <!-- Loader -->
        <div id="preloader"><div id="status"><div class="spinner"></div></div></div>

        <!-- Begin page -->
        <div id="wrapper">


            <?php  include('includes/sidebar.php'); ?>
            <!-- Start right Content here -->

            <div class="content-page">
                <!-- Start content -->
                <div class="content">

                    <!-- Top Bar Start -->
                    <?php  include('includes/topbar.php'); ?>

                    <!-- Top Bar End -->

                    <div class="page-content-wrapper"  >

                        <div class="container-fluid">

                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="float-right page-breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="./">Accueil</a></li>
                                            <li class="breadcrumb-item active"><a href="categories">Categories</a></li>
                                        </ol>
                                    </div>
                                    <h5 class="page-title">Listes des Catégories</h5>
                                </div>
                            </div>
                            <!-- end row -->

                            <div class="row" >
                                <div class="col-12">
                                    <div class="card m-b-30">
                                        <div class="card-body" >


                                            <div class="m-b-30 overflow-auto" id="fort">
                                                <a href="nouvcategorie"><button type="button" class="btn btn-primary btn-sm mb-2" id="ajout" ><b>+</b>Ajouter</button><a/>
                                                <table class="table table-bordered" id="datatable" aria-describedby="datatable_info" role="grid">
                                                    <thead>
                                                    <tr><th scope="col">#</th><th scope="col">Déscription Categorie</th><th scope="col">Action</th>
                                                    </tr></thead>
                                                    <tbody id="tb1">
                                                    <?php $newtabx= array(); foreach($resultzz as $key => $value) {$newtabx[$key] = $value;$newtab2= array();
                                                        foreach ($newtabx[$key] as $key2 => $value2) {
                                                            $newtab2[$key2] = $value2;
                                                        }
                                                        echo  ' <tr data-id="'.$newtab2['id_cat'].'" role="row"><td>'.$newtab2['id_cat'].'</td><td>'.utf8_encode($newtab2['categorie']).'</td><td>' ;
                                                        echo '<form action="nouvcat.php?edit='.$newtab2['id_cat'].'" id="del3" method="post"><button type="button" class="btn btn-warning btn-sm" id="dalf" data-id="'.$newtabx[$key]['id_cat'].'">Modifier</button></form>
                                                        <form action="categories.php" id="del1" method="post"><button type="button" class="btn btn-danger btn-sm" id="dell" data-id="'.$newtabx[$key]['id_cat'].'">Supprimer</button></form>
                                                        </td></tr>';
                                                    } ?>
                                                    </tbody>
                                                </table>


                                            </div>
            

                                        </div>
                                    </div>
                                </div> <!-- end col -->
                            </div> <!-- end row -->
            
                        </div><!-- container fluid -->

                    </div> <!-- Page content Wrapper -->

                </div> <!-- content -->

                <?php  include('includes/footer.php'); ?>

            </div>
            <!-- End Right content here -->

        </div>
        <!-- END wrapper -->



        <script src="assets/js/bootstrap.bundle.min.js"></script>
        <script src="assets/js/modernizr.min.js"></script>
        <script src="assets/js/detect.js"></script>
        <script src="assets/js/fastclick.js"></script>
        <script src="assets/js/jquery.slimscroll.js"></script>
        <script src="assets/js/jquery.blockUI.js"></script>
        <script src="assets/js/waves.js"></script>
        <script src="assets/js/jquery.nicescroll.js"></script>
        <script src="assets/js/jquery.scrollTo.min.js"></script>

        <!--Wysiwig js-->
        <script src="assets/plugins/tinymce/tinymce.min.js"></script>
        <!-- Dropzone js -->
        <script src="assets/plugins/dropzone/dist/dropzone.js"></script>

        <!-- App js -->
        <script src="assets/js/app.js"></script>


    </body>
</html>