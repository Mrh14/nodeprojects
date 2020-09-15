<?php
include('includes/cookie.php');
requis("non","login","login");
include('includes/json/getdatas.php');
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
        <title>Visio - Mes Abonnements</title>
        <meta content="Admin Dashboard" name="description" />
        <meta content="ThemeDesign" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />

        <link rel="shortcut icon" href="assets/images/favicon.ico">

         <!-- Alertify css -->
         <link href="assets/plugins/alertify/css/alertify.css" rel="stylesheet" type="text/css">

        <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
        <link href="assets/css/icons.css" rel="stylesheet" type="text/css">
        <link href="assets/css/style.css" rel="stylesheet" type="text/css">
        <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
        <script type="text/javascript" src="javascript/jquery.cookie.js"></script>
        <script src="assets/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
		
				<link href="assets/plugins/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/plugins/datatables/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <!-- Responsive datatable examples -->
        <link href="assets/plugins/datatables/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />
		     <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
        <link href="assets/css/icons.css" rel="stylesheet" type="text/css">
        <link href="assets/css/style.css" rel="stylesheet" type="text/css">
    </head>


    <body class="fixed-left">

        <!-- Loader -->
        <div id="preloader"><div id="status"><div class="spinner"></div></div></div>

        <!-- Begin page -->
        <div id="wrapper">


            <script>

                //poster la mission
                $('document').ready(function(){

                    var go = 0;var done = 0;var stored= ''; var c = [];

                    $(document).on('submit', '#signup', function() {
                        var berr = 0;var fberr=0;c = [];

                        checkinv('#nom'); checkinv('#email'); checkinv('#pass'); checkinv('#tel');

                        for (i = 0; i < c.length; i++) {if(c[i] != 0){	berr = 1;} else{}}




                        //ajax request start
                        if(berr != 1){


                            var dataPost = {
                                'nom' :  $("#nom").val(), 'email' :  $("#email").val(),
                                'pass' :  $("#pass").val(), 'tel' :  $("#tel").val()
                            };
                            var dataContact = JSON.stringify(dataPost);

                            window.setTimeout(function() {
                                $('#jer').html('');
                                $('#jer').append('<h4 class="alert-heading">Erreur:</h4><p>Veuillez corriger les erreurs suivantes:</p><hr>');
                                $('#jer').hide();$('#jsuc').hide();
                                $.ajax({ type:'POST',
                                    url:'includes/json/signupjs.php',
                                    data: {datas : dataContact},
                                    dataType: 'json',
                                    async: false,
                                    success:function(data){

                                        $.each(data, function(key, value){
                                            if(key == 'suc' ){ suc=value;}if(key == 'err' ){ err=value;}if(key == 'er' ){ er=value;}
                                        });
                                        //cas d'absence d'erreurs de validation de champs ou autres
                                        if(er == '0'){
                                            if(suc=='1'){
                                                $('#jsuc').show(1000);
                                                window.setTimeout(function() {
                                                    window.location.replace("login.php");
                                                },2e3);
                                            }
                                        }
                                        //cas d'erreur de validation de champs ou autres
                                        else{
                                            $('#jer').append(err);  $('#jer').show(1000) ;}
                                    }, error: function(data) {  }
                                });
                            },1000);


                        }

                        return false;   });

                    function checkinv(champ){var g= 0;
                        if($(champ).val().length >= 2){ g= 0; $(champ).removeClass('is-invalid'); $(champ).addClass('is-valid');}
                        else{ g= 1; $(champ).removeClass('is-valid'); $(champ).addClass('is-invalid');}
                        c.push(g);
                        return g;
                    }





                    /// click pour supprimmer l'intervention

                    $(document).on('click', '#dell', function() {
                        var idinter =  $(this).data('id');alert(idinter);
                        var dataPost = {
                            'idreservation' :  idinter

                        }; var dataContact = JSON.stringify(dataPost);
                        $.ajax({
                            type:'POST',
                            url:'includes/json/posterjs.php',
                            data: {datav : dataContact},
                            dataType: 'json',
                            async: false,
                            success:function(data){
                                //console.log(data);
                                $.each(data, function(key, value){
                                    if(key == 'suc' ){ suc=value;}
                                    if(key == 'err' ){ err=value;}
                                    if(key == 'er' ){ er=value;}
                                });
                                //cas d'absence d'erreurs de validation de champs ou autres
                                if(er == '0'){
                                    if(suc=='1'){
                                        window.location.replace("reservations");
                                        //$("#tb1").val(dta[0].client);  $("#tb1").val(dta[0].client);
                                        // alert(d);
                                    }
                                } else{alert(err);}
                            },error: function(data) {}
                        }); return false;
                    });


                    $(document).on('click', '#charge', function() {

                        if($.cookie('usertype')) {
                            var idreservation = $(this).data('id');


                            $(this).closest("form").append( '<input type="hidden" value="' + $.cookie('iduser') + '" name="id_client" />' +
                                '<input type="hidden" value="' + idreservation + '" name="idreservation" />');

                            $(this).closest("form").submit();
                        }
                        else{alert('Vous devez être inscrit d\'abord');}

                    });



                    $(document).on('click', '#chargeNew', function() {

                        if($.cookie('usertype')) {
                            var idreservation = $(this).data('id');


                            $(this).closest("form").append( '<input type="hidden" value="' + $.cookie('iduser') + '" name="id_client" />' +
                                '<input type="hidden" value="' + idreservation + '" name="chargeNew" />');

                            $(this).closest("form").submit();
                        }
                        else{alert('Vous devez être inscrit d\'abord');}

                    });


                    /// redirection vers la conference

                    $(document).on('click', '#voir', function() {
                        var idinter =  $(this).data('id');alert(idinter);

                        window.location.replace("http://localhost:3000/"+idinter);
                        //$("#tb1").val(dta[0].client);  $("#tb1").val(dta[0].client);
                        // alert(d);

                    });

                });
            </script>
            <!-- ========== Left Sidebar Start ========== -->
<?php include('includes/sidebar.php'); ?>
            <!-- Left Sidebar End -->

            <!-- Start right Content here -->

            <div class="content-page">
                <!-- Start content -->
                <div class="content">

                    <!-- Top Bar Start -->


                    <?php include('includes/topbar.php');  ?>


                    <!-- Top Bar End -->

                    <div class="page-content-wrapper ">

                        <div class="container-fluid">

                            <div class="row">
                                <!-- Modal success-->

                                <!-- Modal sucess end-->

                                <div class="col-sm-12">
                                    <div class="float-right page-breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="<?=$url ; ?>">Accueil</a></li>
                                            <li class="breadcrumb-item"><a href="abonnements">Mes Abonnements</a></li>

                                        </ol>
                                    </div>
                                    <h5 class="page-title">Mes Abonnements</h5>
                                </div>
                            </div>
                            <!-- end row -->
                           <!-- end row -->


                            <div class="row w-100 d-flex  bd-highlight" >
                                <div class="col-12 bd-highlight">
                                    <div class="card m-b-30 overflow-auto">
                                        <div class="card-body">
                                            <table class="table table-bordered" id="datatable">

                                                <thead>

                                                <tr><th scope="col">Package</th><th scope="col">Prix</th><th scope="col">Medecin</th><th scope="col">Date de Paiement</th><th scope="col">Date D'expiration</th><th scope="col">Payé avec</th><th scope="col">Etat de paiement</th><th scope="col">ID de transaction</th><th scope="col">Action</th>

                                                </tr></thead>

                                                <tbody id="tb1">

                                                <?php $newtabx= array(); foreach($results1 as $key => $value) {$newtabx[$key] = $value;$newtab2= array();

                                                    foreach ($newtabx[$key] as $key2 => $value2) {
                                                        $newtab2[$key2] = $value2;
                                                    }

                                                    $paid = '0';$new = '';
                                                    if($newtab2['payment_id'] != '' or  $newtab2['payment_id'] != null){ $new = 'new'; }
                                                    $date = date('Y-m-d H:i:s');$datenow = date('Y-m-d H:i:s', strtotime($date));



                                                    $nbMois = $newtab2['nbMois']; $nbJours = $newtab2['nbJours'];
                                                    $expiration = date("Y-m-d H:i:s", strtotime("+$nbMois month", strtotime($newtab2['paid_at'])));
                                                    $expiration =date("Y-m-d H:i:s", strtotime("+$nbJours day", strtotime($expiration)));
                                                    $datepaiement = $newtab2['payment_status']!='approved' ? '' : $newtab2['paid_at'];
                                                    $dateExp = $newtab2['payment_status']!='approved' ? '' : $expiration;

                                                    if( strtotime($datenow) < strtotime($expiration) ) {$paid=1;}

                                                    echo  ' <tr data-id="'.$newtab2['id'].'"><td scope="row">'.getPackName($newtab2['pname']).'</td><td>'.$newtab2['amount'].'</td><td>'.$newtab2['nomprenom'].'</td><td>'.$datepaiement.'</td><td>'.$dateExp.'</td><td>'.$newtab2['payMethod'].'</td><td>'.$newtab2['payment_status'].'</td><td>'.$newtab2['payment_id'].'</td>';

                                                    if($_COOKIE['usertype']=='client' ){if($paid == '0'){if($new ==''){$btn = '<form action="renouvellement/charge.php" id="renouvellement" method="post"><a title="payment" class="btn btn-primary"  id="chargeNew"  data-id="'.$newtabx[$key]['id'].'">Paiement</a></form>';}else{ $btn= '<form action="renouvellement/charge.php" id="renouvellement" method="post"><a title="payment" class="btn btn-primary"  id="charge"  data-id="'.$newtabx[$key]['id'].'">renouvellement</a></form>';}}
                                                    else{if($new ==''){$btn = '<form action="renouvellement/charge.php" id="renouvellement" method="post"><a title="payment" class="btn btn-primary"  id="chargeNew"  data-id="'.$newtabx[$key]['id'].'">Paiement</a></form>';}else{$btn = '<form action="#" id="del1" method="post">Actif</form>';}} }
                                                    // pour l'administrateur
                                                    else{if($paid == '0'){$btn= '<form action="#" id="voir" method="post"></form>';}
                                                    else{$btn = '<form action="#" id="del1" method="post"></form>';}}

                                                    echo '<td>'.$btn.'</td></tr>';

                                                } ?>

                                                </tbody></table>


                                        </div>
                                    </div>
                                </div></div> <!-- end col -->
            
                        </div><!-- container fluid -->

                    </div> <!-- Page content Wrapper -->

                </div> <!-- content -->

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

        <!-- Plugins js -->
		   <!-- Required datatable js -->
        <script src="assets/plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="assets/plugins/datatables/dataTables.bootstrap4.min.js"></script>
        <!-- Buttons examples -->
        <script src="assets/plugins/datatables/dataTables.buttons.min.js"></script>
        <script src="assets/plugins/datatables/buttons.bootstrap4.min.js"></script>
        <script src="assets/plugins/datatables/jszip.min.js"></script>
        <script src="assets/plugins/datatables/pdfmake.min.js"></script>
        <script src="assets/plugins/datatables/vfs_fonts.js"></script>
        <script src="assets/plugins/datatables/buttons.html5.min.js"></script>
        <script src="assets/plugins/datatables/buttons.print.min.js"></script>
        <script src="assets/plugins/datatables/buttons.colVis.min.js"></script>
        <!-- Responsive examples -->
        <script src="assets/plugins/datatables/dataTables.responsive.min.js"></script>
        <script src="assets/plugins/datatables/responsive.bootstrap4.min.js"></script>

        <!-- Datatable init js -->
        <script src="assets/pages/datatables.init.js"></script>


        <!-- Plugins Init js --><script src="assets/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
        <script src="assets/pages/form-advanced.js"></script>

        <!-- App js -->
        <script src="assets/js/app.js"></script>
    </body>
</html>