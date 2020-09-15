<?php
include('includes/cookie.php');
requis("non","login","login");
include('includes/json/getdatas.php');

if(isset($_COOKIE['usertype']) and $_COOKIE['usertype']!='client'  ){
    if($_COOKIE['usertype']=='user'){

        if($_COOKIE['usertype']=='user'){
            $req2=$bdd->prepare('select * from user_acl where iduser =? and permission = ?');
            $req2->execute(array(intval($_COOKIE['iduser']),'abonnes'));
            $nbp = $req2->rowCount();
            if(intval($nbp)==0){
                header('location: '.$url.'');
            }
        }
    }

}else if(isset($_COOKIE['usertype']) and $_COOKIE['usertype']=='client'){
    header('location: abonnements');
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
        <title>Visio - Mes Abonnés</title>
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
                $('document').ready(function(event){


                    $(document).on('click','#ficheclient',function(){

                        var dataPost = {'idclient' :  $(this).data('id')}; var dataContact = JSON.stringify(dataPost);

                        $.ajax({

                            type:'POST',
                            url:'includes/json/cfillform.php',
                            data: {ficheclient : dataContact},
                            dataType: 'json',
                            async: false,
                            success:function(data){
                                //console.log(data);
                                $.each(data, function(key, value){
                                    if(key == 'suc' ){ suc=value;}
                                    if(key == 'err' ){ err=value;}
                                    if(key == 'er' ){ er=value;}
                                    if(key == 'dta' ){ dta=value;}
                                });
                                //cas d'absence d'erreurs de validation de champs ou autres
                                if(er == '0'){
                                    if(suc=='1'){

                                        $('#jcont').html(dta);
                                        console.log(dta);
                                        $('#exampleModalCenter').modal('toggle');
                                    }
                                }
                                else{alert(err);}

                            },error: function(data) {console.log(data);}

                        });

                    });

                    return false;

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
                                            <li class="breadcrumb-item"><a href="#">Mes Abonnés</a></li>

                                        </ol>
                                    </div>
                                    <h5 class="page-title">Mes Abonnements</h5>
                                </div>
                            </div>
                            <!-- end row -->
                           <!-- end row -->

                            <!-- modal start -->
                            <div class="modal fade" id="exampleModalCenter" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" >
                                <div class="modal-dialog modal-dialog" style="margin-top:40px;" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLongTitle">Fiche Client</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body text-center">
                                            <div class="alert alert-success w-100" style="margin-left:0px;margin-left:0px;display:none;" role="alert" id="jsuc">
                                                <p>Affiché avec succés. </p>
                                            </div>
                                            <div class="alert alert-danger w-100"  style="display:none;" role="alert" id="jer" >
                                                <h4 class="alert-heading">Erreur:</h4>
                                                <p>Veuillez corriger les erreurs suivantes:</p>
                                                <hr>
                                            </div>

                                            <!-- formulaire d'ajout -->
                                            <form action="#" method="post" id="jform">
                                                <div class="form-group row" id="jcont">

                                                </div>
                                            </form>
                                        </div>

                                        <div class="modal-footer d-flex justify-content-center px-5">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- modal end -->



                            <div class="row w-100 d-flex  bd-highlight" >
                                <div class="col-12 bd-highlight">
                                    <div class="card m-b-30 overflow-auto">
                                        <div class="card-body">
                                            <table class="table table-bordered" id="datatable">

                                                <thead>

                                                <tr><th scope="col">Client</th><th scope="col">Package</th><th scope="col">Prix</th><th scope="col">Date de Paiement</th><th scope="col">Date D'expiration</th><th scope="col">Payé avec</th><th scope="col">Etat de paiement</th><th scope="col">ID de transaction</th><th scope="col">Action</th>

                                                </tr></thead>

                                                <tbody id="tb1">

                                                <?php $newtabx= array(); foreach($resultw1 as $key => $value) {$newtabx[$key] = $value;$newtab2= array();

                                                    foreach ($newtabx[$key] as $key2 => $value2) {
                                                        $newtab2[$key2] = $value2;
                                                    }

                                                    $paid = '0';$new = '';
                                                    if($newtab2['payment_id'] != '' or  $newtab2['payment_id'] != null){ $new = 'new'; }
                                                    $date = date('Y-m-d H:i:s');$datenow = date('Y-m-d H:i:s', strtotime($date));



                                                    $nbMois = $newtab2['nbMois']; $nbJours = $newtab2['nbJours'];
                                                    $expiration = date("Y-m-d H:i:s", strtotime("+$nbMois month", strtotime($newtab2['paid_at'])));
                                                    $expiration =date("Y-m-d H:i:s", strtotime("+$nbJours day", strtotime($expiration)));
                                                    if( strtotime($datenow) < strtotime($expiration) ) {$paid=1;}

                                                    echo  ' <tr data-id="'.$newtab2['id_user'].'"><td scope="row"><a href="#" id="ficheclient" data-id="'.$newtab2['id_user'].'" title="'.$newtab2['email'].'">'.$newtab2['nomprenom'].' '.$newtab2['prenom'].'</a></td><td scope="row">'.getPackName($newtab2['pname']).'</td><td>'.$newtab2['amount'].'</td><td>'.$newtab2['paid_at'].'</td><td>'.$expiration.'</td><td>'.$newtab2['payMethod'].'</td><td>'.($newtab2['payment_status'] == 'approved' ? 'Approuvé' : 'en cours').'</td><td>'.$newtab2['payment_id'].'</td>';

                                                    if($_COOKIE['usertype']=='client' ){if($paid == '0'){if($new ==''){$btn = '<form action="renouvellement/charge.php" id="renouvellement" method="post"><a title="payment" class="btn btn-primary"  id="chargeNew"  data-id="'.$newtabx[$key]['id'].'">Paiement</a></form>';}else{ $btn= '<form action="renouvellement/charge.php" id="renouvellement" method="post"><a title="payment" class="btn btn-primary"  id="charge"  data-id="'.$newtabx[$key]['id'].'">renouvellement</a></form>';}}
                                                    else{if($new ==''){$btn = '<form action="renouvellement/charge.php" id="renouvellement" method="post"><a title="payment" class="btn btn-primary"  id="chargeNew"  data-id="'.$newtabx[$key]['id'].'">Paiement</a></form>';}else{$btn = '<form action="#" id="del1" method="post">Actif</form>';}} }
                                                    // pour l'administrateur
                                                    else{if($paid == '0'){$btn= 'Expiré';}
                                                    else{$btn = 'Actif';}}

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