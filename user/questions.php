<?php
include('includes/cookie.php');
requis("non","login","login");
include('includes/json/getdatas.php');

if(isset($_COOKIE['usertype']) and $_COOKIE['usertype']!='client'  ){
    if($_COOKIE['usertype']=='user'){

        if($_COOKIE['usertype']=='user'){
            $req2=$bdd->prepare('select * from user_acl where iduser =? and permission = ?');
            $req2->execute(array(intval($_COOKIE['iduser']),'questions'));
            $nbp = $req2->rowCount();
            if(intval($nbp)==0){
                header('location: '.$url.'');
            }
        }
    }

}else if(isset($_COOKIE['usertype']) and $_COOKIE['usertype']=='client'){
    header('location: reservations');
}

if($_COOKIE['usertype']!='client'){

    $iduser =$_COOKIE['iduser'];
    if($_COOKIE['usertype']=='user'){
        $req2=$bdd->prepare('select * from user_acl where iduser =?');
        $req2->execute(array(intval($_COOKIE['iduser'])));
        while($ar2 = $req2->fetch()){$iduser = $ar2['idadmin'];}
    }

    $req3=$bdd->prepare("select * from questions where id_Emetteur=? ");
    $req3->execute(array($iduser));
    $questions = $req3->fetchAll(\PDO::FETCH_ASSOC);

    $req=$bdd->prepare("select * from packs");
    $req->execute();
    $packs = $req->fetchAll(\PDO::FETCH_ASSOC);

    $req=$bdd->prepare("select * from categories");
    $req->execute();
    $categories = $req->fetchAll(\PDO::FETCH_ASSOC);

    function getCategorie($val){
        global $bdd;
        $req4=$bdd->prepare("select * from categories where id_cat=? ");
        $req4->execute(array($val));
        while($ar = $req4->fetch()){return $ar['categorie'];}
        return 1;
    }

    function getPacks($val){
        global $bdd;
        $req4=$bdd->prepare("select * from packs where idpack=? ");
        $req4->execute(array($val));
        while($ar = $req4->fetch()){return $ar['packname'];}
        return 1;
    }

    function nbReponses($val){
        global $bdd;
        $req4=$bdd->prepare("select * from reponses where id_res=? ");
        $req4->execute(array($val));
        $rows = $req4->rowcount();
        return $rows;

    }
}



?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
        <title>VISIO | Liste des Questions</title>
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
                    //le click de creer pour ajouter la question
                    $(document).on('click', '#poster', function() {
                        var berr = 0;var fberr=0;c = [];

                        checkinv('#question'); checkinv('#choix1'); checkinv('#choix2'); checkinv('#choix3');

                        for (i = 0; i < c.length; i++) {if(c[i] != 0){	berr = 1;} else{}}

                        //ajax request start
                        if(berr != 1){

                            var dataPost = {
                                'choix1' :  $("#choix1").val(), 'choix2' :  $("#choix2").val(),'choix3' :  $("#choix3").val(),
                                'question' :  $("#question").val(), 'typeq' :  $("#typeq").val(), 'pack' :  $("#pack").val(),
                                'categorie' :  $("#categorie").val()
                            };
                            var dataContact = JSON.stringify(dataPost);

                            window.setTimeout(function() {
                                $('#jer').html('');
                                $('#jer').append('<h4 class="alert-heading">Erreur:</h4><p>Veuillez corriger les erreurs suivantes:</p><hr>');
                                $('#jer').hide();$('#jsuc').hide();
                                $.ajax({ type:'POST',
                                    url:'includes/json/posterjs.php',
                                    data: {question : dataContact},
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
                                                $('#jform').hide();

                                                window.setTimeout(function() {
                                                    window.location.replace("questions");
                                                },1e3);
                                            }
                                        }
                                        //cas d'erreur de validation de champs ou autres
                                        else{
                                            $('#jer').append(err);  $('#jer').show(1000) ;}
                                    }, error: function(data) {  }
                                });
                            },1000);
                        }return false;  });



                    // le click pour modifier la question
                    $(document).on('click', '#poster2', function() {
                        var berr = 0;var fberr=0;c = [];
                        var idquestion =  $(this).data('id');
                        checkinv('#question'); checkinv('#choix1'); checkinv('#choix2'); checkinv('#choix3');

                        for (i = 0; i < c.length; i++) {if(c[i] != 0){	berr = 1;} else{}}

                        //ajax request start
                        if(berr != 1){
                            var dataPost = {'idquestion': idquestion,
                                'choix1' :  $("#choix1").val(), 'choix2' :  $("#choix2").val(),'choix3' :  $("#choix3").val(),
                                'question' :  $("#question").val(), 'typeq' :  $("#typeq").val(), 'pack' :  $("#pack").val(),
                                'categorie' :  $("#categorie").val(),'idchoix1' : $("#choix1").data('id'), 'idchoix2' : $("#choix2").data('id'),'idchoix3' : $("#choix3").data('id'),
                            };
                            var dataContact = JSON.stringify(dataPost);

                            window.setTimeout(function() {
                                $('#jer').html('');
                                $('#jer').append('<h4 class="alert-heading">Erreur:</h4><p>Veuillez corriger les erreurs suivantes:</p><hr>');
                                $('#jer').hide();$('#jsuc').hide();
                                $.ajax({ type:'POST',
                                    url:'includes/json/posterjs.php',
                                    data: {savequestion : dataContact},
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
                                                $('#jform').hide();

                                                window.setTimeout(function() {
                                                    window.location.replace("questions");
                                                },1e3);
                                            }
                                        }
                                        //cas d'erreur de validation de champs ou autres
                                        else{
                                            $('#jer').append(err);  $('#jer').show(1000) ;}
                                    }, error: function(data) {  }
                                });
                            },1000);
                        }return false;  });


                    /// click pour remplir le formulaire de modification d'un pack
                    $(document).on('click', '#edit', function() {
                        var idquestion =  $(this).data('id');
                        $('#poster').attr('data-id',idquestion);
                        $('#poster').attr('id','poster2');
                        var dataPost = {
                            'idquestion' :  idquestion
                        }; var dataContact = JSON.stringify(dataPost);
                        $.ajax({
                            type:'POST',
                            url:'includes/json/posterjs.php',
                            data: {editquestion : dataContact},
                            dataType: 'json',
                            async: false,
                            success:function(data){
                                //console.log(data);
                                $.each(data, function(key, value){
                                    if(key == 'suc' ){ suc=value;}
                                    if(key == 'err' ){ err=value;}
                                    if(key == 'er' ){ er=value;}
                                    if(key=='dta'){dta=value;}if(key=='dta2'){dta2=value;}if(key=='dta3'){dta3=value;}
                                });
                                //cas d'absence d'erreurs de validation de champs ou autres
                                if(er == '0'){
                                    if(suc=='1'){
                                        if(dta3 !=0){ $('#typeq').attr('disabled',true);  }else{ $('#typeq').prop('disabled',false);  }
                                         $('#pack').val(dta[0].packid); $('#question').val(dta[0].question); $('#categorie').val(dta[0].idCategorie);
                                        for(var i =0 ;i<dta2.length;i++){
                                            $('#choix'+(i+1)).val(dta2[i].choix);$('#choix'+(i+1)).attr('data-id', dta2[i].idchoix);
                                        }

                                         $('#exampleModalCenter').modal('toggle');
                                    }
                                } else{alert(err);}
                            },error: function(data) {}
                        }); return false;
                    });


                    /// click pour ouvrir le modal d'ajout
                    $(document).on('click', '#ajouter', function() {
                        init();
                        $('#exampleModalCenter').modal('toggle');

                    });

                    /// click pour supprimmer une reservation
                    $(document).on('click', '#dell', function() {
                        var idinter =  $(this).data('id');
                        var dataPost = {
                            'idquestion' :  idinter
                        }; var dataContact = JSON.stringify(dataPost);
                        $.ajax({
                            type:'POST',
                            url:'includes/json/posterjs.php',
                            data: {delquestion : dataContact},
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
                                        window.location.replace("questions");
                                        //$("#tb1").val(dta[0].client);  $("#tb1").val(dta[0].client);
                                        // alert(d);
                                    }
                                } else{alert(err);}
                            },error: function(data) {}
                        }); return false;
                    });



                    //la verification des champs
                    function checkinv(champ){var g= 0;
                        if($(champ).val().length >= 2){ g= 0; $(champ).removeClass('is-invalid'); $(champ).addClass('is-valid');}
                        else{ g= 1; $(champ).removeClass('is-valid'); $(champ).addClass('is-invalid');}
                        c.push(g);
                        return g;
                    }

                    function init(){ $('#poster2').attr('id','poster');$('#poster').attr('data-id','0');
                        $("#choix1").val('');  $("#choix2").val('');  $("#choix3").val('');
                            $("#question").val('');   $("#typeq").val('radio'); $("#typeq").attr('disabled',false);   $("#pack").val($("#pack option:first").val());$("#categorie").val($("#categorie option:first").val());
                              $("#categorie").val(); $("#choix1").attr('data-id','0');  $("#choix2").attr('data-id','0'); $("#choix3").attr('data-id','0');
                    }

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
                                            <li class="breadcrumb-item"><a href="questions">Les Questions</a></li>

                                        </ol>
                                    </div>
                                    <h5 class="page-title">Les Questions</h5>
                                </div>
                            </div>
                            <!-- end row -->
                           <!-- modal start -->
                            <div class="modal fade" id="exampleModalCenter" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" >
                                <div class="modal-dialog modal-dialog" style="margin-top:40px;" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLongTitle">Créer une Question</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body text-center">
                                            <div class="alert alert-success w-100" style="margin-left:0px;margin-left:0px;display:none;" role="alert" id="jsuc">
                                                <p>cette question a été ajouté avec succés. </p>
                                            </div>
                                            <div class="alert alert-danger w-100"  style="display:none;" role="alert" id="jer" >
                                                <h4 class="alert-heading">Erreur:</h4>
                                                <p>Veuillez corriger les erreurs suivantes:</p>
                                                <hr>
                                            </div>

                                            <!-- formulaire d'ajout -->
                                            <form action="#" method="post" id="jform">
                                                <div class="form-group row">
                                                    <label class="col-sm-4 col-form-label">Choisir le Pack</label>
                                                    <div class="col-sm-8 mb-1">
                                                        <select name="pack" id="pack" class="form-control">
                                                            <?php
                                                            $newtabx= array(); foreach($packs as $key => $value) {$newtabx[$key] = $value;$newtab2= array();
                                                                foreach ($newtabx[$key] as $key2 => $value2) {
                                                                    $newtab2[$key2] = $value2;
                                                                }
                                                                echo  '<option value="'.$newtab2['idpack'].'">'.$newtab2['packname'].'</option>';
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>


                                                    <label class="col-sm-4 col-form-label">Choisir la Catégorie</label>
                                                    <div class="col-sm-8 mb-1">
                                                        <select name="categorie" id="categorie" class="form-control">
                                                            <?php $newtabx= array(); foreach($categories as $key => $value) {$newtabx[$key] = $value;$newtab2= array();
                                                                foreach ($newtabx[$key] as $key2 => $value2) {
                                                                    $newtab2[$key2] = $value2;
                                                                }
                                                                echo  '<option value="'.$newtab2['id_cat'].'">'.$newtab2['categorie'].'</option>';
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>


                                                    <label class="col-sm-4 col-form-label">Type de choix</label>
                                                    <div class="col-sm-8 mb-1">
                                                        <select name="typeq" id="typeq" class="form-control">
                                                            <option value="radio" >Un seul choix</option>
                                                            <option value="checkbox" >Choix multiple</option>
                                                        </select>
                                                    </div>

                                                    <label class="col-sm-4 col-form-label">La Question </label>
                                                    <div class="col-sm-8 mb-1">
                                                        <input type="text" name="question" id="question" class="form-control pull-right" placeholder="La Question" >
                                                    </div>

                                                    <label class="col-sm-4 col-form-label">Choix 1</label>
                                                    <div class="col-sm-8 mb-1">
                                                        <input type="text" name="choix1" id="choix1" class="form-control pull-right" placeholder="choix1" >
                                                    </div>

                                                    <label class="col-sm-4 col-form-label">Choix 2</label>
                                                    <div class="col-sm-8 mb-1">
                                                        <input type="text" name="choix2" id="choix2" class="form-control pull-right" placeholder="choix2" >
                                                    </div>

                                                    <label class="col-sm-4 col-form-label">Choix 3</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" name="choix3" id="choix3" class="form-control pull-right" placeholder="choix3" >
                                                    </div>


                                                </div>
                                            </form>
                                        </div>

                                        <div class="modal-footer d-flex justify-content-center px-5">
                                            <button type="button" id="poster" class="btn btn-primary">Sauvegarder</button>
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
                                            <button id="ajouter" class="btn btn-primary mb-3">Ajouter Une Question</button>

                                            <table class="table table-bordered" id="datatable">

                                                <thead>
                                                <tr><th scope="col">#</th><th scope="col">La question</th><th scope="col">Type des choix</th><th scope="col">Catégorie</th><th scope="col">Pack concerné</th><th scope="col">Date de Création</th><th scope="col">Action</th>
                                                </tr></thead>

                                                <tbody id="tb1">

                                                <?php $newtabx= array(); foreach($questions as $key => $value) {$newtabx[$key] = $value;$newtab2= array();
                                                    foreach ($newtabx[$key] as $key2 => $value2) {
                                                        $newtab2[$key2] = $value2;
                                                    }

                                                    $found = nbReponses($newtab2['idq']);
                                                    echo  ' <tr data-id="'.$newtab2['idq'].'"><td scope="row">'.$newtab2['idq'].'</td><td>'.$newtab2['question'].'</td><td>'.($newtab2['typeq'] == 'radio' ? 'Un seul choix' : 'Choix Multiple').'</td><td>'.getCategorie($newtabx[$key]['idCategorie']).'</td><td>'.getPacks($newtab2['packid']).'</td><td>'.$newtab2['datecreation'].' </td>';
                                                    if($_COOKIE['usertype']!='client' ){ if(intval($found) == 0){$btn= '<form action="#" id="dell'.$newtab2['idq'].'" method="post" class="d-flex"><a title="Modifier" class="typcn typcn-edit  mdi-24px text-warning"  id="edit" data-id="'.$newtabx[$key]['idq'].'"></a><a title="supprimer" class="typcn typcn-delete mdi-24px text-danger"  id="dell" data-id="'.$newtabx[$key]['idq'].'"></a></form>';}
                                                    else{$btn = 'Contient '.$found. ' Réponses';} }

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