<?php
include('includes/cookie.php');
requis('oui','','events');
$url = 'https://visio.fcpo.agency/';
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
        <title>Digitaldata - Authentification</title>
        <meta content="Admin Dashboard" name="description" />
        <meta content="ThemeDesign" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />

        <link rel="shortcut icon" href="assets/images/favicon.ico">

         <!-- Alertify css -->
         <link href="assets/plugins/alertify/css/alertify.css" rel="stylesheet" type="text/css">
        <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
        <link href="assets/css/icons.css" rel="stylesheet" type="text/css">
        <link href="assets/css/style.css" rel="stylesheet" type="text/css">
        <script src="assets/js/jquery.min.js"></script>
        <script type="text/javascript" src="javascript/jquery.cookie.js"></script>

        <script>

            $('document').ready(function(){

                var go = 0;var done = 0;var stored= ''; var c = [];
                //validation form de Login
                $(document).on('submit', '#connexion', function() {
                    //spinner loading start
                    var iduser ="";

                    var  rem = '';
                    //end spinner loading
                    if($('input[name="fremember"]:checked').length > 0){rem  = '1';}else{rem = '0';}
                    //encapsulation de donne on object js
                    var dataPost = {'email' :  $("#email").val(),'pass' :  $("#pass").val()};var dataContact = JSON.stringify(dataPost);

                    //ajax request start

                    window.setTimeout(function() {
                        $('#jer').html('');
                        $('#jer').append('<h4 class="alert-heading">Erreur:</h4><p>Veuillez corriger les erreurs suivantes:</p><hr>');
                        $('#jer').hide();
                        $('#jsuc').hide();

                        $.ajax({
                            type:'POST',
                            url:'includes/json/loginjs.php',
                            data: {datas : dataContact},
                            dataType: 'json',
                            async: false,
                            success:function(data){
                                $.each(data, function(key, value){
                                    if(key == 'suc' ){ suc=value;}
                                    if(key == 'iduser' ){ iduser=value;}
                                    if(key == 'role' ){ usertype=value;}
                                    if(key == 'err' ){ err=value;}
                                    if(key == 'er' ){ er=value;}
                                });

                                //cas d'absence d'erreurs de validation de champs ou autres

                                if(er == '0'){
                                    if(suc=='1'){

                                        // enregistrer les cookies de login

                                        if(rem == '1'){
                                            //garder la session pour 7 jours
                                            $.cookie('iduser', iduser, { expires: 7, path: '/' });
                                            $.cookie('email', $("#email").val(), { expires: 7, path: '/' });
                                            $.cookie('pass', $("#pass").val(), { expires: 7, path: '/' });
                                            $.cookie('usertype', usertype, { expires: 7, path: '/' });
                                        }
                                        else{
                                            //garder la session pour 1 jour
                                            $.cookie('iduser', iduser, { expires: 1, path: '/' });
                                            $.cookie('email', $("#email").val(), { expires: 1, path: '/' });
                                            $.cookie('pass', $("#pass").val(), { expires: 1, path: '/' });
                                            $.cookie('usertype', usertype, { expires: 1, path: '/' });
                                        }
                                        $('#jsuc').show(1000);
                                        window.setTimeout(function() {
                                            if(usertype=='admin'){
                                            window.location.replace("events");}
                                            else{window.location.replace("reserver");}
                                        },2e3);
                                    }
                                }
                                //cas d'erreur de validation de champs ou autres

                                else{

                                    $('#jer').append(err);
                                    $('#jer').show(1000) ;
                                }
                            },
                            error: function(data) { console.log(data);
                            }
                        });
                        },1000);
                    return false;
                });





            }) ;
        </script>
    </head>


    <body class="fixed-left">

        <!-- Loader -->
        <div id="preloader"><div id="status"><div class="spinner"></div></div></div>

        <!-- Begin page -->
        <div id="wrapper ">

            <!-- ========== Left Sidebar Start ========== -->

            <!-- Left Sidebar End -->

            <!-- Start right Content here -->

            <div class="content-page p-5 m-1">
                <!-- Start content -->


                    <!-- Top Bar Start -->


                    <?php include('includes/topbar.php'); ?>


                    <!-- Top Bar End -->

                    <div class="page-content-wrapper mt-5 ">

                        <div class="container-fluid">


                            <!-- end row -->
                            <div class="row w-100 mx-auto">
                                <div class="col-12 col-md-8 col-lg-8 col-xl-6 mx-auto px-0">


                                <div class="alert alert-danger w-100"  style="display:none;" role="alert" id="jer" >

                                    <h4 class="alert-heading">Erreur:</h4>

                                    <p>Veuillez corriger les erreurs suivantes:</p>

                                    <hr>

                                </div>
                                </div>



                            </div>

                                <div class="col-12 col-md-8 col-lg-8 col-xl-6 mx-auto px-0">
                                    <form id="connexion" action="#" >

                                        <div class="card bg-light" style="border:none;border-radius:9px;min-height:320px;">



                                            <div class="card-header pb-0 text-center bg-primary pt-2"> <h6 class="card-title text-light w-100 px-0">Authentification </h6> </div>

                                            <div class="card-body px-4 text-muted " >



                                                <div class="form-group">

                                                    <input type="email" class="form-control" id="email" style="border-radius:7px;background: rgba(0,0,0,.03);border: 1px solid rgba(0,0,0,.125);" placeholder="Entrez votre adresse email">

                                                </div>

                                                <div class="form-group">

                                                    <input type="password" class="form-control mb-0" style="border-radius:7px;background: rgba(0,0,0,.03);border: 1px solid rgba(0,0,0,.125);" id="pass" placeholder="Entrez votre mot de passe">

                                                </div>

                                                <div class="custom-control custom-checkbox">

                                                    <input type="checkbox" class="custom-control-input" name="fremember" id="customCheck2">

                                                    <label class="custom-control-label" for="customCheck2">Se souvenir de moi?</label>

                                                </div>

                                                <button type="submit" class="btn btn-primary d-block mx-auto mt-3" id="cge">Se connecter</button>

                                            </div>

                                        </div>

                                    </form>

                                </div> <!-- end col -->
                            </div> <!-- end row -->
            
                        </div><!-- container fluid -->

                    </div> <!-- Page content Wrapper -->

               <!-- content -->

<?php  include('includes/footer.php'); ?>

            </div>
            <!-- End Right content here -->

        </div>
        <!-- END wrapper -->

        <!-- jQuery  -->

        <script src="assets/js/bootstrap.bundle.min.js"></script>
        <script src="assets/js/modernizr.min.js"></script>
        <script src="assets/js/detect.js"></script>
        <script src="assets/js/fastclick.js"></script>
        <script src="assets/js/jquery.slimscroll.js"></script>
        <script src="assets/js/jquery.blockUI.js"></script>
        <script src="assets/js/waves.js"></script>
        <script src="assets/js/jquery.nicescroll.js"></script>
        <script src="assets/js/jquery.scrollTo.min.js"></script>

        <!-- Alertify js -->
        <script src="assets/plugins/alertify/js/alertify.js"></script>
        <script src="assets/pages/alertify-init.js"></script>

        <!-- App js -->
        <script src="assets/js/app.js"></script>

    </body>
</html>