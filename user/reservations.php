<?php
include('includes/cookie.php');
requis("non","login","login");
include('includes/json/getdatas.php');

$tab = "";
if(isset($_COOKIE['ip'] )) {

    $req = $bdd->prepare("select * from rendezvous where idr=?");
    $req->execute(array(intval($_COOKIE['idconference'])));
    while($ar = $req->fetch()){
        $titre = $ar['titre'];
    }
    $dat1 = strtotime(date('Y-m-d H:i:s',strtotime($_COOKIE['startrdv'].':00')));
    $dat2 = strtotime(date('Y-m-d H:i:s',strtotime($_COOKIE['endrdv'].':00')));
    $diff =( $dat2-$dat1 ) / 3600;

        $tab = '<tr><td>' . $_COOKIE['idconference'] . '</td><td>' . $titre . '</td><td>' . $_COOKIE['startrdv'] . '</td>
        <td>' . $_COOKIE['endrdv'] . '</td><td>' . $diff . 'H</td><td><a href="abonnements">Payer Votre pack</a></td></tr>';

}

if(isset($_COOKIE['usertype']) and $_COOKIE['usertype']!='client'  ){
    if($_COOKIE['usertype']=='user'){

        if($_COOKIE['usertype']=='user'){
            $req2=$bdd->prepare('select * from user_acl where iduser =? and permission = ?');
            $req2->execute(array(intval($_COOKIE['iduser']),'reservations'));
            $nbp = $req2->rowCount();
            if(intval($nbp)==0){
                header('location: '.$url.'');
            }
        }
    }

}


$columns = 'a.idreservation,a.idconference,a.idc,a.paid ,a.startrdv,a.endrdv,a.typerdv,b.idr,b.idClient,b.idEmetteur,b.dateStart,b.dateEnd,b.completed,b.titre,c.idCompte';
if(isset($_GET['idreservation']) and $_COOKIE['usertype']!='client'){
    $req3=$bdd->prepare("select $columns from reservations as  a inner join rendezvous  b on a.idconference = b.idr inner join users  c on b.idEmetteur = c.idCompte $par and a.idconference=? ");
    $req3->execute(array($_GET['idreservation']));
    $result5 = $req3->fetchAll(\PDO::FETCH_ASSOC);

}


?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
        <title>VISIO | Liste des réservations</title>
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
                                                    window.location.replace("l.php");
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



                    /// click pour accepter une reservation

                    $(document).on('click', '#accepter', function() {
                        var idinter =  $(this).data('id');alert(idinter);
                        var dataPost = {
                            'idreservation' :  idinter

                        }; var dataContact = JSON.stringify(dataPost);
                        $.ajax({
                            type:'POST',
                            url:'includes/json/posterjs.php',
                            data: {datvac : dataContact},
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





                    /// click pour supprimmer une reservation
                    $(document).on('click', '#dell', function() {
                        var idinter =  $(this).data('id');
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




                    /// redirection vers la conference

                    $(document).on('click', '#voir', function() {
                        var idinter =  $(this).data('id');


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
                                            <li class="breadcrumb-item"><a href="reservations">Les réservations</a></li>

                                        </ol>
                                    </div>
                                    <h5 class="page-title">Les réservations</h5>
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

                                                <tr><th scope="col">Numéro de Conférence </th><th scope="col">Titre</th><th scope="col">Date de debut</th><th scope="col">Date De fin</th><th scope="col">La durée</th><th scope="col">Action</th>

                                                </tr></thead>

                                                <tbody id="tb1">

                                                <?php echo $tab; $newtabx= array(); foreach($result5 as $key => $value) {$newtabx[$key] = $value;$newtab2= array();
                                                    foreach ($newtabx[$key] as $key2 => $value2) {
                                                        $newtab2[$key2] = $value2;

                                                    }

                                                    $date1 = new DateTime($newtab2['startrdv']);$date2 = new DateTime($newtab2['endrdv']);
                                                    $diff = $date1->diff($date2);$hours = $diff->i;$diff = $date1->diff($date2);$hours2 = $diff->h;
                                                    $hours = ($hours / 60) + $hours2;

                                                    echo  ' <tr data-id="'.$newtab2['idreservation'].'"><td scope="row">'.$newtab2['idreservation'].'</td><td>'.$newtab2['titre'].'</td><td>'.$newtab2['startrdv'].'</td><td>'.$newtabx[$key]['endrdv'].'</td><td>'.number_format($hours,2).' H</td>';

                                                    if($_COOKIE['usertype']=='client' ){if($newtab2['paid'] == '1'){$btn= '<form action="#" id="voir2" method="post"><a title="voir" class="btn btn-primary"  id="voir" data-id="'.$newtabx[$key]['idreservation'].'">Voir la Conférence</a></form>';}
                                                    else{$btn = '<form action="#" id="del1" method="post"><a title="payer" class="btn btn-primary"  id="pay" data-id="'.$newtabx[$key]['idreservation'].'">payer</a><a title="supprimer" class="btn btn-danger"  id="dell" data-id="'.$newtabx[$key]['idreservation'].'">Supprimer</a></form>';} }
                                                    // pour l'administrateur
                                                    else{if($newtab2['paid'] == '0'){$btn= '<form action="#" id="voir2" method="post"><a title="accepter" class="btn btn-success"  id="accepter" data-id="'.$newtabx[$key]['idreservation'].'">Accepter</a><a title="supprimer" class="btn btn-danger"  id="dell" data-id="'.$newtabx[$key]['idreservation'].'">Supprimer</a></form>';}
                                                    else{$btn = '<form action="#" id="del1" method="post"><a title="voir" class="btn btn-primary"  id="voir" data-id="'.$newtabx[$key]['idreservation'].'">Voir la Conférence</a></form>';}}

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