<?php
include('includes/cookie.php');
requis("non","login","login");
include('includes/json/getdatas.php');

if(isset($_COOKIE['usertype']) and $_COOKIE['usertype']!='client'  ){
    if($_COOKIE['usertype']=='user'){

        if($_COOKIE['usertype']=='user'){
            $req2=$bdd->prepare('select * from user_acl where iduser =? and permission = ?');
            $req2->execute(array(intval($_COOKIE['iduser']),'packs'));
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


     $req3=$bdd->prepare("select * from packs where Emetteur=? ");
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


}



?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
        <title>VISIO | Mes Packs</title>
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

                //ajouter le pack
                $('document').ready(function(){

                    var go = 0;var done = 0;var stored= ''; var c = [];

                    $(document).on('click', '#poster', function() {
                        var berr = 0;var fberr=0;c = []; done = 0; stored= '';var extras = [];

                        ///// process pour uploader image de pack

                            if($('#file').val() !=''){
                                var fd = new FormData();var files = $('#file')[0].files[0];fd.append('file',files);
                                $.ajax({
                                    url: 'includes/json/signupejs.php',
                                    type: 'post',
                                    data: fd,
                                    async: false,
                                    contentType: false,
                                    processData: false,
                                    success: function(response){
                                        if(response != 0){ $('#hfile').val(response); done = 1;stored = '';
                                            // Display image element
                                        }else{berr=1;alert('veuiller choisir une extension d\'image valide');}
                                    },
                                });
                            }


                        ////////


                        checkinv('#amount');checkinv('#packname'); checkinv('#premierRdv',1); checkinv('#deuxiemeRdv',1); checkinv('#nbvisio',1);checkinv('#prvisio',1);checkinv('#prpublic',1);
                        checkinv('#hrvisio',1); checkinv('#nbpublic',1); checkinv('#hrpublic',1); checkinv('#nbdomicile',1);checkinv('#hrdomicile',1);checkinv('#prdomicile',1);
                        for (i = 0; i < c.length; i++) {if(c[i] != 0){	berr = 1;} else{}}
                        if($("#nbMois").val() == '' || $("#nbJours").val() == ''){
                            $('#nbJours').removeClass('is-valid'); $('#nbJours').addClass('is-invalid');
                            $('#nbMois').removeClass('is-valid'); $('#nbMois').addClass('is-invalid');
                        }else{
                            $('#nbMois').removeClass('is-invalid'); $('#nbMois').addClass('is-valid');
                            $('#nbJours').removeClass('is-invalid'); $('#nbJours').addClass('is-valid');
                        }
                        //ajax request start
                        if(berr != 1){
                            $("input[name='extras[]']").each(function() {
                                if($(this).val() != ''){
                                    extras.push($(this).val());}
                            });

                       var dataPost = {
                           'amount': $('#amount').val(),'nbvisio' : $("#nbvisio").val(), 'hrvisio' : $("#hrvisio").val(),'nbpublic' : $("#nbpublic").val(),'hrpublic' : $("#hrpublic").val(),
                           'nbdomicile': $("#nbdomicile").val(),'hrdomicile' :$("#hrdomicile").val(), 'packname' : $("#packname").val(),'nbJours' :  $("#nbJours").val(),
                           'nbMois' : $("#nbMois").val(), 'premierRdv' : $("#premierRdv").val(),'deuxiemeRdv' : $("#deuxiemeRdv").val(),'prvisio' : $("#prvisio").val(),
                           'prpublic' : $("#prpublic").val(),'prdomicile' : $("#prdomicile").val(), 'image' : $("#hfile").val(), 'extras' : extras
                       };



                            var dataContact = JSON.stringify(dataPost);



                        if(done == 1){
                            window.setTimeout(function() {
                                $('#jer').html('');
                                $('#jer').append('<h4 class="alert-heading">Erreur:</h4><p>Veuillez corriger les erreurs suivantes:</p><hr>');
                                $('#jer').hide();$('#jsuc').hide();
                                $.ajax({ type:'POST',
                                    url:'includes/json/posterjs.php',
                                    data: {pack : dataContact},
                                    dataType: 'json',
                                    async: false,
                                    success:function(data){

                                        $.each(data, function(key, value){
                                            if(key == 'suc' ){ suc=value;}if(key == 'err' ){ err=value;}if(key == 'er' ){ er=value;}
                                        });
                                        console.log(data);
                                        //cas d'absence d'erreurs de validation de champs ou autres
                                        if(er == '0'){
                                            if(suc=='1'){
                                                $('#jsuc').show(1000);
                                                $('#jform').hide();

                                                window.setTimeout(function() {
                                                    window.location.replace("packs");
                                                },1e3);
                                            }
                                        }
                                        //cas d'erreur de validation de champs ou autres
                                        else{
                                            $('#jer').append(err);  $('#jer').show(1000) ;}
                                    }, error: function(data) { console.log(data); }
                                });
                            },2000);}else{
                                            alert('veuiller choisir une image de pack');
                                         }
                        }return false;  });





                    /// click pour ouvrir le modal d'ajout
                    $(document).on('click', '#ajouter', function() {


                        $('#poster2').attr('id','poster');
                        init();
                        $('#exampleModalCenter').modal('toggle');

                    });

                    /// click pour supprimmer un pack
                    $(document).on('click', '#dell', function() {
                        var idinter =  $(this).data('id');
                        var dataPost = {
                            'idpack' :  idinter
                        }; var dataContact = JSON.stringify(dataPost);
                        $.ajax({
                            type:'POST',
                            url:'includes/json/posterjs.php',
                            data: {delpack : dataContact},
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
                                        window.location.replace("packs");
                                        //$("#tb1").val(dta[0].client);  $("#tb1").val(dta[0].client);
                                        // alert(d);
                                    }
                                } else{alert(err);}
                            },error: function(data) {}
                        }); return false;
                    });


                    /// click pour remplir le formulaire de modification d'un pack
                    $(document).on('click', '#edit', function() {
                        var idpack =  $(this).data('id');
                        $('#poster').attr('data-id',idpack);
                        $('#poster').attr('id','poster2');
                        $('#extras2').val('');
                        $("input[name='extras[]']").each(function() {
                            if($(this).length>0){
                                if($(this).attr('id') != 'extras2' ){
                                    $(this).remove();
                                }
                            }
                        });

                        var dataPost = {
                            'idpack' :  idpack
                        }; var dataContact = JSON.stringify(dataPost);
                        $.ajax({
                            type:'POST',
                            url:'includes/json/posterjs.php',
                            data: {editpack : dataContact},
                            dataType: 'json',
                            async: false,
                            success:function(data){

                                $.each(data, function(key, value){
                                    if(key == 'suc' ){ suc=value;}
                                    if(key == 'err' ){ err=value;}
                                    if(key == 'er' ){ er=value;}
                                    if(key='dta'){dta=value;}



                                });
                                //cas d'absence d'erreurs de validation de champs ou autres
                                if(er == '0'){
                                    if(suc=='1'){
                                        console.log(dta);
                                        $('#packname').val(dta[0].packname); $('#premierRdv').val(dta[0].premierRdv); $('#deuxiemeRdv').val(dta[0].deuxiemeRdv);
                                        $('#hrvisio').val(dta[0].hrvisio);$('#hrpublic').val(dta[0].hrpublic);$('#hrdomicile').val(dta[0].hrdomicile);
                                        $('#nbvisio').val(dta[0].nbvisio);$('#nbpublic').val(dta[0].nbpublic);$('#nbdomicile').val(dta[0].nbdomicile);
                                        $('#prvisio').val(dta[0].prvisio);$('#prpublic').val(dta[0].prpublic);$('#prdomicile').val(dta[0].prdomicile);
                                        $('#nbMois').val(dta[0].nbMois); $('#nbJours').val(dta[0].nbJours);$('#hfile').val(dta[0].picture);$('#amount').val(dta[0].amount);

                                        if(dta[1].length>0){
                                            $.each(dta[1], function(key, value){
                                                if(key==0){
                                                    $('#extras2').val(value);
                                                }else{
                                                $('#extra').after('<label class="col-sm-3 col-form-label"></label> <div class="col-sm-9 mb-1 px-5"> <input type="text" name="extras[]" id="extras" class="form-control pull-right"  value="'+ value +'" placeholder="" ></div>');}
                                            });
                                        }


                                        $('#exampleModalCenter').modal('toggle');
                                    }
                                } else{alert(err);}
                            },error: function(data) {}
                        }); return false;
                    });
                    //add extras
                    $(document).on('click','#adextra',function(){

                        $('#extra').after('<label class="col-sm-3 col-form-label"></label> <div class="col-sm-9 mb-1 px-5"> <input type="text" name="extras[]" id="extras" class="form-control pull-right"  placeholder="" ></div>');


                    })



                    /// click pour modifier un pack
                    $(document).on('click', '#poster2', function() {
                        var idpack =  $(this).data('id');
                        stored = ''; done =0;
                        var berr = 0;var fberr=0;c = []; var extras = [];
                        ///// process pour uploader image de pack
                        if(done != 1){
                            if($('#file').val() != '' ){
                                var fd = new FormData();var files = $('#file')[0].files[0];fd.append('file',files);
                                $.ajax({
                                    url: 'includes/json/signupejs.php',
                                    type: 'post',
                                    data: fd,
                                    async: true,
                                    contentType: false,
                                    processData: false,
                                    success: function(response){
                                        if(response != 0){  $('#hfile').val(response); done = 1;
                                            // Display image element
                                        }else{berr=1;alert('veuiller choisir une extension d\'image valide');}
                                    },
                                });
                            }
                        }
                        ////////
                        checkinv('#amount');checkinv('#packname'); checkinv('#premierRdv',1); checkinv('#deuxiemeRdv',1); checkinv('#nbvisio',1);checkinv('#prvisio',1);checkinv('#prpublic',1);
                        checkinv('#hrvisio',1); checkinv('#nbpublic',1); checkinv('#hrpublic',1); checkinv('#nbdomicile',1);checkinv('#hrdomicile',1);checkinv('#prdomicile',1);
                        for (i = 0; i < c.length; i++) {if(c[i] != 0){	berr = 1;} else{}}
                        if($("#nbMois").val() == '' || $("#nbJours").val() == ''){
                            $('#nbJours').removeClass('is-valid'); $('#nbJours').addClass('is-invalid');
                            $('#nbMois').removeClass('is-valid'); $('#nbMois').addClass('is-invalid');
                        }else{
                            $('#nbMois').removeClass('is-invalid'); $('#nbMois').addClass('is-valid');
                            $('#nbJours').removeClass('is-invalid'); $('#nbJours').addClass('is-valid');
                        }
                        //ajax request start
                        if(berr != 1){

                            $("input[name='extras[]']").each(function() {
                                if($(this).val() != ''){
                                    extras.push($(this).val());}
                            });

                            window.setTimeout(function() {   var dataPost = {'idpack' : idpack,
                                'amount': $('#amount').val(), 'nbvisio' : $("#nbvisio").val(), 'hrvisio' : $("#hrvisio").val(),'nbpublic' : $("#nbpublic").val(),'hrpublic' : $("#hrpublic").val(),
                                'nbdomicile': $("#nbdomicile").val(),'hrdomicile' :$("#hrdomicile").val(), 'packname' : $("#packname").val(),'nbJours' :  $("#nbJours").val(),
                                'nbMois' : $("#nbMois").val(), 'premierRdv' : $("#premierRdv").val(),'deuxiemeRdv' : $("#deuxiemeRdv").val(),'prvisio' : $("#prvisio").val(),
                                'prpublic' : $("#prpublic").val(),'prdomicile' : $("#prdomicile").val(), 'image' : $('#hfile').val(), 'extras' : extras
                            };
                                var dataContact = JSON.stringify(dataPost);

                                $('#jer').html('');
                                $('#jer').append('<h4 class="alert-heading">Erreur:</h4><p>Veuillez corriger les erreurs suivantes:</p><hr>');
                                $('#jer').hide();$('#jsuc').hide();
                                $.ajax({ type:'POST',
                                    url:'includes/json/posterjs.php',
                                    data: {savepack : dataContact},
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
                                                    window.location.replace("packs");
                                                },2e3);
                                            }
                                        }
                                        //cas d'erreur de validation de champs ou autres
                                        else{
                                            $('#jer').append(err);  $('#jer').show(1000) ;}
                                    }, error: function(data) {  }
                                });
                            },2000);
                        }return false;
                    });




                    //la verification des champs
                    function checkinv(champ,leng=null){var g= 0;
                    if(leng == null) {
                        if ($(champ).val().length >= 2) {g = 0;$(champ).removeClass('is-invalid');$(champ).addClass('is-valid');
                        } else {g = 1;$(champ).removeClass('is-valid');$(champ).addClass('is-invalid');}}
                    else{
                        if ($(champ).val().length >= leng) {g = 0;$(champ).removeClass('is-invalid');$(champ).addClass('is-valid');
                        } else {g = 1;$(champ).removeClass('is-valid');$(champ).addClass('is-invalid');}}

                        c.push(g);
                        return g;
                    }

                    //pour reinitialiser tous les champs du formulaire pack
                    function init(){
                        $('#extras2').val('');
                        $("input[name='extras[]']").each(function() {
                            if($(this).length>0){
                                if($(this).attr('id') != 'extras2' ){
                                    $(this).remove();
                                }
                            }
                        });
                        $('#packname').val(''); $('#premierRdv').val(''); $('#deuxiemeRdv').val('');
                        $('#hrvisio').val('');$('#hrpublic').val('');$('#hrdomicile').val('');
                        $('#nbvisio').val('');$('#nbpublic').val('');$('#nbdomicile').val('');
                        $('#prvisio').val('');$('#prpublic').val('');$('#prdomicile').val('');
                        $('#nbMois').val(''); $('#nbJours').val('');
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
                                            <li class="breadcrumb-item"><a href="packs">Mes Packs</a></li>

                                        </ol>
                                    </div>
                                    <h5 class="page-title">Mes Packs</h5>
                                </div>
                            </div>
                            <!-- end row -->
                           <!-- modal start -->
                            <div class="modal fade" id="exampleModalCenter" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" >
                                <div class="modal-dialog modal-dialog" style="margin-top:40px;" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLongTitle">Créer un pack</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body text-center" style="height:370px;overflow-y:auto;">
                                            <div class="alert alert-success w-100" style="margin-left:0px;margin-left:0px;display:none;" role="alert" id="jsuc">
                                                <p>ce Pack a été ajouté avec succés. </p>
                                            </div>
                                            <div class="alert alert-danger w-100"  style="display:none;" role="alert" id="jer" >
                                                <h4 class="alert-heading">Erreur:</h4>
                                                <p>Veuillez corriger les erreurs suivantes:</p>
                                                <hr>
                                            </div>

                                            <!-- formulaire d'ajout -->
                                            <form action="#" method="post" id="jform">
                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-form-label">Durée en mois</label>
                                                    <div class="col-sm-9 mb-1">
                                                        <select name="nbMois" id="nbMois" class="form-control">
                                                            <option value="">Durée en mois</option>
                                                            <?php
                                                            for($i=0;$i<12;$i++){
                                                                echo  '<option value="'.$i.'">'.$i.' mois</option>';
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>


                                                    <label class="col-sm-3 col-form-label">Jours additionnés</label>
                                                    <div class="col-sm-9 mb-1">
                                                        <select name="nbJours" id="nbJours" class="form-control">
                                                            <option value="">Jours additionnés</option>
                                                            <?php
                                                            for($i=0;$i<30;$i++){
                                                                echo  '<option value="'.$i.'">'.$i.' jours</option>';
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>



                                                    <label class="col-sm-3 col-form-label">Nom de Pack</label>
                                                    <div class="col-sm-9 mb-1">
                                                        <input type="text" name="packname" id="packname" class="form-control pull-right" placeholder="Le nom de pack" >
                                                    </div>
                                                    <label class="col-sm-3 col-form-label">prix de Pack</label>
                                                    <div class="col-sm-9 mb-1">
                                                        <input type="text" name="amount" id="amount" class="form-control pull-right" placeholder="Le prix de pack" >
                                                    </div>

                                                    <label class="col-sm-3 col-form-label">1er Rdv </label>
                                                    <div class="col-sm-9 mb-1">
                                                        <input type="text" name="premierRdv" id="premierRdv" class="form-control pull-right" placeholder="Durée en heures exemple(1.5)" >
                                                    </div>
                                                    <label class="col-sm-3 col-form-label">2éme Rdv </label>
                                                    <div class="col-sm-9 mb-1">
                                                        <input type="text" name="deuxiemeRdv" id="deuxiemeRdv" class="form-control pull-right" placeholder="Durée en heures exemple(1.5)" >
                                                    </div>




                                                    <label class="col-sm-3 col-form-label">Les visios</label>
                                                    <div class="col-sm-9 mb-1">
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend"><span class="input-group-text" id="basic-addon3">heures</span></div>
                                                        <input type="text" class="form-control" id="hrvisio" aria-describedby="basic-addon3">
                                                        <div class="input-group-prepend"><span class="input-group-text" id="basic-addon3">séances</span></div>
                                                        <input type="text" class="form-control" id="nbvisio" aria-describedby="basic-addon3">
                                                        <div class="input-group-prepend"><span class="input-group-text" id="basic-addon3">€</span></div>
                                                        <input type="text" class="form-control" id="prvisio" aria-describedby="basic-addon3" placeholder="prix">
                                                    </div>
                                                    </div>


                                                    <label class="col-sm-3 col-form-label">RDV Public</label>
                                                    <div class="col-sm-9 mb-1">
                                                        <div class="input-group mb-3">
                                                            <div class="input-group-prepend"><span class="input-group-text" id="basic-addon3">heures</span></div>
                                                            <input type="text" class="form-control" id="hrpublic" aria-describedby="basic-addon3">
                                                            <div class="input-group-prepend"><span class="input-group-text" id="basic-addon3">séances</span></div>
                                                            <input type="text" class="form-control" id="nbpublic" aria-describedby="basic-addon3">
                                                            <div class="input-group-prepend"><span class="input-group-text" id="basic-addon3">€</span></div>
                                                            <input type="text" class="form-control" id="prpublic" aria-describedby="basic-addon3" placeholder="prix">
                                                        </div>
                                                    </div>


                                                    <label class="col-sm-3 col-form-label">RDV à Domicile</label>
                                                    <div class="col-sm-9 mb-1">
                                                        <div class="input-group mb-3">
                                                            <div class="input-group-prepend"><span class="input-group-text" id="basic-addon3">heures</span></div>
                                                            <input type="text" class="form-control" id="hrdomicile" aria-describedby="basic-addon3">
                                                            <div class="input-group-prepend"><span class="input-group-text" id="basic-addon3">séances</span></div>
                                                            <input type="text" class="form-control" id="nbdomicile" aria-describedby="basic-addon3">
                                                            <div class="input-group-prepend"><span class="input-group-text" id="basic-addon3">€</span></div>
                                                            <input type="text" class="form-control" id="prdomicile" aria-describedby="basic-addon3" placeholder="prix">
                                                        </div>
                                                    </div>

                                                    <label class="col-sm-3 col-form-label">Image de pack</label>
                                                    <div class="col-sm-9 mb-1">
                                                        <div class="input-group mb-3">
                                                        <input type="file" class="custom-file-input" id="file" value="parcourir" name="file" required>
                                                        <div class="invalid-feedback mt-0">Veuillez Choisir Une image!</div>
                                                        <label class="custom-file-label" for="validatedCustomFile">image de pack...</label>
                                                        <input type="hidden" class="custom-file-input" id="hfile" value="" name="hfile" >
                                                    </div></div>



                                                    <label class="col-sm-3 col-form-label">Les extras de ce Pack: </label>
                                                    <div class="col-sm-9 mb-1 d-flex">
                                                        <input type="text" name="extras[]" id="extras2" class="form-control pull-right" placeholder="" ><span id="adextra" class="pt-2 pl-2 typcn typcn-plus"></span>
                                                    </div>

                                                    <div id="extra" class="form-group row">

                                                    </div>





                                                </div>
                                            </form>
                                        </div>

                                        <div class="modal-footer d-flex justify-content-center px-5" id="fbutton">
                                            <button type="button" id="poster" class="btn btn-primary" data-id="0">Sauvegarder</button>
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
                                            <button id="ajouter" class="btn btn-primary mb-3">Ajouter Un Pack</button>

                                            <table class="table table-bordered" id="datatable">

                                                <thead>
                                                <tr><th scope="col">Le pack</th><th scope="col">Rdv Visio</th><th scope="col">Rdv Public</th><th scope="col">Rdv Domicile</th><th scope="col">Date de Création</th><th scope="col">Durée Du pack</th><th scope="col">1er RDV</th><th scope="col">2éme RDV</th><th scope="col">Action</th>
                                                </tr></thead>

                                                <tbody id="tb1">

                                                <?php $newtabx= array(); foreach($questions as $key => $value) {$newtabx[$key] = $value;$newtab2= array();
                                                    foreach ($newtabx[$key] as $key2 => $value2) {
                                                        $newtab2[$key2] = $value2;
                                                    }

                                                    $found = 0;
                                                    echo  ' <tr data-id="'.$newtab2['idpack'].'"><td scope="row">'.$newtab2['packname'].'</td><td> RDV('.$newtab2['nbvisio'].')  <br />Heures('.$newtab2['hrvisio'].')</td><td>RDV('.$newtab2['nbpublic'].')  <br />Heures('.$newtab2['hrpublic'].')</td><td>RDV('.$newtab2['nbdomicile'].') <br />Heures('.$newtab2['hrdomicile'].')</td><td>'.$newtab2['created_at'].'</td><td>'.$newtab2['nbMois'].' Mois et '.$newtab2['nbJours'].' Jours </td>';
                                                    if($_COOKIE['usertype']!='client' ){ if(intval($found) == 0){$btn= '<form action="#" id="dell'.$newtab2['idpack'].'" method="post" class="d-flex"><a title="Modifier" class="typcn typcn-edit  mdi-24px text-warning"  id="edit" data-id="'.$newtabx[$key]['idpack'].'"></a><a title="supprimer" class="typcn typcn-delete text-danger"  id="dell" data-id="'.$newtabx[$key]['idpack'].'"></a></form>';}
                                                    else{$btn = 'Contient '.$found. ' Réponses';} }

                                                    echo '<td>'.$newtab2['premierRdv'].' H</td><td>'.$newtab2['deuxiemeRdv'].' H</td><td>'.$btn.'</td></tr>';

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