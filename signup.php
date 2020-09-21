<?php include('includes/config.php');
include('includes/cookie.php'); ?>
<!doctype html>
<!--[if lt IE 7]>		<html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>			<html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>			<html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!-->	<html class="no-js" lang=""> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>VISIO | Communauté d'experts </title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>


    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/icomoon.css">
    <link rel="stylesheet" href="css/icofont.css">
    <link rel="stylesheet" href="css/plugins.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="css/color.css">
    <link rel="stylesheet" href="css/responsive.css">
    <script src="js/vendor/modernizr-2.8.3-respond-1.4.2.min.js"></script>

</head>
<body class="hb-home hb-homeone">
<!--[if lt IE 8]>
<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
<![endif]-->
<!--************************************
        Wrapper Start
*************************************-->
<div id="hb-wrapper" class="hb-wrapper hb-haslayout">
    <!--************************************
            Header V2 Start
    *************************************-->
    <header id="hb-header" class="hb-header v2 hb-haslayout">
        <div class="hb-topbar">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12" >
                        <strong class="hb-logo"><a href="./"><img src="images/logo.png" alt="company logo here"></a></strong>

                        <?php if(found() == '') {?>
                            <a href="login" class="hb-btn hidden-xs">Se connecter</a>
                            <a href="signup" class="hb-btn hidden-xs mr-2">S'inscrire</a>
                        <?php } else {?>
                            <a href="logout" class="hb-btn hidden-xs mr-2 px-3" title="Déconnexion"><span class="fas fa-sign-out-alt"></span></a>
                            <a href="<?php echo $_COOKIE['usertype'] == 'client' ? 'user/reserver' : 'user/events' ; ?>" class="hb-btn hidden-xs mr-2"><?php echo $_COOKIE['usertype'] == 'client' ? 'Réserver un RDV' : 'ADMINISTRATION' ; ?></a>


                        <?php } ?>
                        <div class="hb-info-area hidden-xs" style="overflow:hidden;">
                            <ul class="list-unstyled hb-info"   >
                                <li><i class="ti-location-pin hidden-sm"></i><span>3 Route de Cholet 95050 <em>Paris France</em></span></li>
                                <li><i class="ti-email hidden-sm"></i><span><a href="tel:01 85 23 56">01 85 23 56</a><a href="mailto:info@visio.com">info@visio.com</a></span>
                                </li>
                                <li>
                                </li>
                            </ul>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="hb-navigationarea" style="z-index:-1;">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="hb-addnav">

                        </div>
                        <nav id="hb-nav" class="hb-nav">
                            <div class="navbar-header">
                                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#hb-navigation" aria-expanded="false">
                                    <span class="sr-only">Toggle navigation</span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                </button>
                            </div>
                            <div id="hb-navigation" class="collapse navbar-collapse hb-navigation">
                                <ul id="respmenu" >

                                    <?php if(found() == '') {?>
                                        <li class="menu-item-has-children"><a href="login">Se connecter</a></li>
                                        <li class="menu-item-has-children"><a href="signup">S'inscrire</a></li>
                                    <?php } else {?>

                                        <li><a href="<?php echo $_COOKIE['usertype'] == 'client' ? 'user/reserver' : 'user/events' ; ?>" class="menu-item-has-children"><?php echo $_COOKIE['usertype'] == 'client' ? 'Réserver un RDV' : 'ADMINISTRATION' ; ?></a></li>
                                        <li><a href="logout" class="menu-item-has-children" title="Déconnexion">Déconnexion</a></li>

                                    <?php } ?>

                                </ul>
                                <ul>

                                    <li class="menu-item-has-children">
                                        <a href="./">Accueil</a>
                                    </li>
                                    <li class="menu-item-has-children">
                                        <a href="apropos">A propos</a>
                                    </li>

                                    <li><a href="contact">Contact</a></li>
                                </ul>
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!--************************************
            Header V2 End
    *************************************-->
    <div class="search-popup">
        <div class="holder">
            <div class="block">
                <a href="#" class="close-btn"><i class="fa fa-times"></i></a>
                <form action="#" class="search-form">
                    <fieldset>
                        <input type="search" class="form-control" placeholder="Search">
                        <button type="submit" class="btn-primary"><i class="fa fa-search"></i></button>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>

<?php
 requis("oui","login","index");

include('user/includes/json/getdatas.php');
function calluser($idp,$amount){
    if( isset($_GET['usertype']) ){echo '<a href="#" class="hb-btn changebtn" id="charge" data-price="90" data-id="'.$idp.'" >S\'abonner</a>';}
    else{echo '<a href="#" class="hb-btn changebtn" id="charge"  data-price="'.$amount.'" data-id="'.$idp.'" >S\'abonner</a>';}
}



?>
<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<script>
    $(function() {
        $('input[name="birthday"]').daterangepicker({
            singleDatePicker: true,
            showDropdowns: true,
            minYear: 1901,
            maxYear: parseInt(moment().format('YYYY'),10)
        });


    });
</script>
        <script>
            $('document').ready(function(){

                var go = 0;var done = 0;var stored= ''; var c = [];

                $(document).on('click', '#clickradio', function() {
                    $(this).find("input[type='radio']").prop('checked', false);
                 $(this).find("input[type='radio']").prop('checked', true);
                });


                $('#stp1').removeClass('btn-primary');
                $('#stp1').addClass('btn-success');




                $(document).on('click', '#cg', function() {
                    $('#jer').html('');
                    $('#jer').append('<h4 class="alert-heading">Erreur:</h4><p>Veuillez corriger les erreurs suivantes:</p><hr>');
                    $('#jer').hide();$('#jsuc').hide();
                    var objectifs = ''; var berr = 0;var fberr=0;c = [];
                    $("input[name='objectifs[]']:checked").each(function (index, obj) {
                        objectifs =  objectifs + '/' + $(this).val();
                    });
                    if(objectifs.length == 0) {alert('veuillez choisir un objectif'); berr = 1;}
                    if($('input[name="birthday"]').val()=='Date de naissance') {alert('veuillez choisir votre date de naissance'); berr = 1;}


                    checkinv('#prenom'); checkinv('#nom'); checkinv('#email'); checkinv('#pass');
                    checkinv('#tel'); checkinv('#poid');checkinv('#taille');

                    if($('#sexe').val() == 'sexe') {  $('#sexe').removeClass('is-valid'); $('#sexe').addClass('is-invalid'); }
                    else{ $('#sexe').removeClass('is-invalid'); $('#sexe').addClass('is-valid');}

                    for (i = 0; i < c.length; i++) {if(c[i] != 0){	berr = 1;} else{}}

                    
                    var dataPost = {'email' :  $("#email").val()};
                    var dataContact = JSON.stringify(dataPost);

                    $.ajax({ type:'POST',
                        url:'includes/json/signupjs.php',
                        data: {dataemail : dataContact},
                        dataType: 'json',
                        async: false,
                        success:function(data){

                            $.each(data, function(key, value){
                                if(key == 'suc' ){ suc=value;}if(key == 'err' ){ err=value;}if(key == 'er' ){ er=value;}if(key == 'rem' ){ rem=value;}
                            });
                            //cas d'absence d'erreurs de validation de champs ou autres
                            if(er == '0'){
                                if(suc=='1'){
                                    //verifier si il y a une erreur.
                                    if(berr != 1){
                                        // check if we already uploaded our file or not

                                        if(done != 1){
                                            if($('#file').val()==''){fberr = 1;$('#file').removeClass('is-valid'); $('#file').addClass('is-invalid');}
                                            else{
                                                var fd = new FormData();var files = $('#file')[0].files[0];fd.append('file',files);
                                                $.ajax({
                                                    url: 'includes/json/signupejs.php',
                                                    type: 'post',
                                                    data: fd,
                                                    contentType: false,
                                                    processData: false,
                                                    success: function(response){
                                                        if(response != 0){ $('#hfile').val(response); done = 1;stored = '';
                                                            // Display image element
                                                        }else{fberr=1;alert('veuiller choisir une extension d\'image valide');}
                                                    },
                                                });
                                            }
                                        }

                                        if(fberr != 1){  var packid='';   $("input[name='idpack[]']:checked").each(function (index, obj) {
                                                          packid =  $(this).val();
                                                          });
                                        if(packid != ''){
                                            alert(packid);
                                            goo();
                                        }else{
                                        swtch();   $('#stp2').removeClass('btn-primary'); $('#stp2').addClass('btn-success');} }else{$('#file').removeClass('is-valid'); $('#file').addClass('is-invalid');}
                                    }
                                    else{};



                                }
                            }
                            else if(er != '0'){

                                $('#jer').append(err);
                                $('#jer').show(1000);
                                $('#email').addClass('is-invalid');
                                $('#email').removeClass('is-valid');

                            }
                            //cas d'erreur de validation de champs ou autres
                            else{
                                $('#jer').append(err);  $('#jer').show(1000) ;}
                        }, error: function(data) { console.log(data);  }
                    });





                    return false;

                });


function goo(){
    var objectifs = '';var berr = 0;var fberr=0;c = [];
    $("input[name='objectifs[]']:checked").each(function (index, obj) {
        objectifs =  objectifs + '/' + $(this).val();
    });
    if(objectifs.length == 0) {alert('veuillez choisir un objectif'); berr = 1;}
    if($('input[name="birthday"]').val()=='Date de naissance') {alert('veuillez choisir votre date de naissance'); berr = 1;}


    checkinv('#prenom'); checkinv('#nom'); checkinv('#email'); checkinv('#pass');
    checkinv('#tel'); checkinv('#poid');checkinv('#taille');

    for (i = 0; i < c.length; i++) {if(c[i] != 0){	berr = 1;} else{}}

    $("input[name='idpack[]']:checked").each(function (index, obj) {
        pack =  $(this).val();

    });


    //ajax request start
    if(berr != 1){


        var dataPost = {
            'nom' :  $("#nom").val(), 'email' :  $("#email").val(), 'poid' : $("#poid").val(),'sexe' : $("#sexe").val(),'niveau' : $("#hiddendemo").val(),'naissance' : $('input[name="birthday"]').val(),
            'pass' :  $("#pass").val(), 'tel' :  $("#tel").val() ,'taille' : $("#taille").val(),'prenom' : $("#prenom").val(), 'objectifs' : objectifs, 'pack' : pack, 'image' : $("#hfile").val()
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
                        if(key == 'suc' ){ suc=value;}if(key == 'err' ){ err=value;}if(key == 'er' ){ er=value;}if(key == 'rem' ){ rem=value;}
                    });
                    //cas d'absence d'erreurs de validation de champs ou autres
                    if(er == '0'){
                        if(suc=='1'){
                            $('#stps1').addClass('d-none');
                            $('#stps2').addClass('d-none');
                            //si l'utilisateur est enregistré on va stocker le cookies
                            if(rem != ''){
                                //garder la session pour 7 jours
                                $.cookie('iduser', rem, { expires: 7, path: '/' });
                                $.cookie('email', $("#email").val(), { expires: 7, path: '/' });
                                $.cookie('pass', $("#pass").val(), { expires: 7, path: '/' });
                                $.cookie('usertype', 'client', { expires: 7, path: '/' });
                            }
                            window.setTimeout(function() {
                                window.location.replace("user/abonnements.php");
                            },2e3);

                        }
                    }
                    //cas d'erreur de validation de champs ou autres
                    else{
                        $('#jer').append(err);  $('#jer').show(1000) ;}
                }, error: function(data) { console.log(data);  }
            });
        },1000);


    }
}
            // button final pour enregistrer les données d'inscription
            $(document).on('click', '#sg', function() {
                                goo();

                    return false;   });

							function checkinv(champ){var g= 0;
							if($(champ).val().length >= 2){ g= 0; $(champ).removeClass('is-invalid'); $(champ).addClass('is-valid');}
							else{ g= 1; $(champ).removeClass('is-valid'); $(champ).addClass('is-invalid');}
							c.push(g);
							return g;
							}

                function swtch(){
                    $('#stps1').addClass('d-none');
                    $('#stps2').removeClass('d-none');
                }


                $(document).on('click', '.clickprice', function() {
                    $(this).children('div').children('div').children('input').prop('checked','checked');
                    $('.clickprice').removeClass('active');
                    $(this).addClass('active');
                });



});

        </script>


	<!--[if lt IE 8]>
		<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
	<![endif]-->
	<!--************************************
			Wrapper Start
	*************************************-->


			<!--************************************
						Appointment End
			*************************************-->



<main id="hb-main" class="hb-main hb-haslayout">

<section class="text-white">



    <div class="row w-100 mt-5">

        <div class="alert alert-success w-100" style="display:none;" role="alert" id="jsuc">
            <p> Votre message a été envoyé avec succés. </p>
        </div>
        <div class="alert alert-danger w-100"  style="display:none;" role="alert" id="jer" >
            <h4 class="alert-heading">Erreur:</h4>
            <p>Veuillez corriger les erreurs suivantes:</p>
            <hr>
        </div>



    </div>

    <div class="row d-flex justify-content-around text-center mb-5 " >



    </div>

    <div class="row w-100  " id="stps1">


        <div class="col-md-8 col-10 col-xl-8 col-sm-10 mx-auto bg-light p-2" style="margin:0px 0 150px 0;" id="stps1">

            <br /> <br />
            <h3 class="pt-4">Pour parler un peu de moi</h3><br />
            <form id="signup" action="includes/json/signupjs.php">


            <div class="d-flex justify-content-between">
                <div class="form-group col-md-6 col-6 col-sm-6 col-xl-6 pl-0">
                    <input type="text" id="nom" class="form-control" placeholder="Nom" required="required">
                    <div class="invalid-feedback">le nom est trés court !</div>
                </div>
                <div class="form-group col-md-6 col-6 col-sm-6 col-xl-6 pr-2">
                    <input type="text" id="prenom" class="form-control" placeholder="Prénom" required="required">
                    <div class="invalid-feedback">le prénom est trés court !</div>
                </div>
            </div>

                <div class="form-group">
                    <select name="sexe" id="sexe" class="form-control">
                        <option value="sexe">Je suis</option>
                        <option value="femme">Une Femme</option>
                        <option value="Homme">Un Homme</option>
                    </select>
                    <div class="invalid-feedback">le sexe est invalide!</div>
                </div>

                <div class="form-group">
                    <input type="text" id="taille" class="form-control" placeholder="Ma taille en centimètre" required="required">
                    <div class="invalid-feedback">la taille est invalide!</div>
                </div>

                <div class="form-group">
                    <input type="text" id="poid" class="form-control" placeholder="Mon poid en Kilos" required="required">
                    <div class="invalid-feedback">le poid est invalide!</div>
                </div>


				 <div class="form-group">
                    <input type="text" id="tel" class="form-control" placeholder="Téléphone" required="required">
                    <div class="invalid-feedback">le téléphone est invalide!</div>
                </div>


                <div class="form-group">
                    <div class="d-flex" style="color:grey;">Date de naissance:</div>
                    <!--  <input type="text" class="form-control" name="birthday" value="10/10/1984" placeholder="Date de Naissance" />-->
                    <input type="date" class="form-control" name="birthday" placeholder="Date de Naissance">
                  </div>


                <div class="form-group pl-5" style="margin-top:1rem">
                    <h3 style="margin-left:-20px;margin-top:40px;">Je désire bénéficier d'un type de coaching</h3><br />

                    <div class="checkbox objectif" style="display:block">
                        <input id="prisepoid" name="objectifs[]" class="styled" type="checkbox" value="prisepoid">
                        <label for="prisepoid" style="vertical-align:middle">
                            Prise de poids
                        </label>
                    </div>
                    <div class="checkbox objectif" style="display:block">
                        <input id="sportifs" name="objectifs[]" class="styled" type="checkbox" value="sportifs">
                        <label for="sportifs" style="vertical-align:middle">
                            Sportifs
                        </label>
                    </div>
                    <div class="checkbox objectif" style="display:block">
                        <input id="alergie" name="objectifs[]" class="styled" type="checkbox" value="alergie">
                        <label for="alergie" style="vertical-align:middle">
                            Régime alimentaire et allergie
                        </label>
                    </div>
                    <div class="checkbox objectif" style="display:block">
                        <input id="enceinte" name="objectifs[]" class="styled" type="checkbox" value="enceinte">
                        <label for="enceinte" style="vertical-align:middle">
                            Femmes enceintes et allaitantes
                        </label>
                    </div>
                    <div class="checkbox objectif" style="display:block">
                        <input id="digestif" name="objectifs[]" class="styled" type="checkbox" value="digestif">
                        <label for="digestif" style="vertical-align:middle">
                            Troubles digestifs
                        </label>
                    </div>
                    <div class="checkbox objectif" style="display:block">
                        <input id="diabete" name="objectifs[]" class="styled" type="checkbox" value="diabete">
                        <label for="diabete" style="vertical-align:middle">
                            Diabète T1 et T2
                        </label>
                    </div>

                    <div class="checkbox objectif" style="display:block">
                        <input id="tca" name="objectifs[]" class="styled" type="checkbox" value="tca">
                        <label for="tca" style="vertical-align:middle">
                            TCA
                        </label>
                    </div>

                    <div class="checkbox objectif" style="display:block">
                        <input id="reequilibre" name="objectifs[]" class="styled" type="checkbox" value="reequilibre">
                        <label for="reequilibre" style="vertical-align:middle">
                            Rééquilibrage
                        </label>
                    </div>
                    <div class="checkbox objectif" style="display:block">
                        <input id="enfants" name="objectifs[]" class="styled" type="checkbox" value="enfants">
                        <label for="enfants" style="vertical-align:middle">
                            Enfants
                        </label>
                    </div>


                </div>


                <div class="form-group ">
                        <br />
                    <h3>Je désire bénéficier d'un type de coaching</h3>
                    <br />
                        <input type="range" min="1" max="5" value="3" class="slider" id="myRange">
                        <div class="d-flex justify-content-between"><span id="demo">Cool</span><input type="hidden" name="hiddendemo" id="hiddendemo" value=""/><span id="demo2">Strict</span>   </div>
                        <br />
                        </div>


                <div class="form-group">
                    <input type="email" id="email" class="form-control" placeholder="adresse email" required="required">
                    <div class="invalid-feedback">l'email est invalide!</div>
                </div>
                <div class="form-group">
                    <input type="password" id="pass" class="form-control" placeholder="mot de passe" required="required">
                    <div class="invalid-feedback">mot de passe trés court!</div>
                </div>


                <div class="custom-file mb-4">
                    <input type="file" class="custom-file-input" id="file" value="parcourir" name="file">
                    <div class="invalid-feedback mt-0">Veuillez Choisir Une image!</div>
                    <label class="custom-file-label" for="validatedCustomFile">image de profil...</label>
                    <input type="hidden" class="custom-file-input" id="hfile" value="" name="hfile" >
                </div>







                <a href="user/abonnements.php">
                    <button type="button" class="btn btn-primary p-3 mx-auto d-block" style="font-size:16px;" >Terminer</button></a>
            </form>

        </div>

    </div>

    <!--

        <section class="hb-products hb-sectionspace hb-bg hb-haslayout d-none" id="stps2">
            <div class="container">
                <form action="payment/charge.php" id="formCharge" name="charge" method="post" >
                    <div class="row">
                        <div class=" col-xs-12 col-sm-12 col-sm-offset-0 col-md-8 col-md-offset-2">
                            <div class="hb-sectionhead" >
                                <div class="hb-sectiontitle">
                                    <h2>
                                        Veuillez selectionner un Pack
                                    </h2>
                                </div>
                            </div>
                        </div>
                    </div>


                        <div class="row">
                        <div id="hb-products" class="hb-productsarea owl-carousel owl-theme hb-haslayout  d-flex justify-content-center">

                            <?php /*$ij=0;$newtabx= array(); foreach($resultx as $key => $value) {$newtabx[$key] = $value;$newtab2= array();

                            foreach ($newtabx[$key] as $key2 => $value2) {
                                $newtab2[$key2] = $value2;
                            } */?>
                            <div class="item">
                                <div class="hb-pricingbox clickprice <?php /*if(isset($_GET['idpack'])){ if($newtab2['idpack']==$_GET['idpack']){echo'active';}} */?>" style="cursor:pointer;"   >
                                <figure class="hb-pricing-img" style="position:relative;">
                                    <img src="user/assets/upload/<?php /*echo $newtab2['picture'] */?>" alt="images description" >

                                </figure>
                                    <div class="pricingcontent">
                                        <h3>
                                            <?php /*echo $newtab2['packname'] */?>
                                            <span class=""><?php /*echo $newtab2['amount'] */?>€</span>
                                        </h3>
                                        <ul class="list-unstyled hb-pricinglist">
                                            <li><?php /*echo $newtab2['nbvisio'] */?> visios (1h puis 30mn). <?php /*echo $newtab2['hrvisio'] */?> h</li>
                                            <li><?php /*echo $newtab2['nbpublic'] */?> Rdv public (1h puis 30mn). <?php /*echo $newtab2['hrpublic'] */?> h</li>
                                            <li><?php /*echo $newtab2['nbdomicile'] */?> Rdv à Domicile (1h puis 30mn). <?php /*echo $newtab2['hrdomicile'] */?> h</li>

                                        </ul>
                                        <div class="hb-btnarea" >
                                            <input type="radio" name="idpack[]" id="idpack" value=" <?php /*echo $newtab2['idpack'] */?>"  <?php /*if(isset($_GET['idpack'])){ if($newtab2['idpack']==$_GET['idpack']){echo'checked';}} */?> />
                                        </div>
                                    </div>
                                </div>
                            </div> <?php /* } */?></div>  </div>











                <button type="button" class="btn btn-primary mx-auto mt-3 p-3 d-block"  style="font-size:16px;" id="sg" >Soumettre</button>-->
        </div>

    </section>

    <script>
        var slider = document.getElementById("myRange");
        var output = document.getElementById("hiddendemo");
        output.value = slider.value;

        slider.oninput = function() {
            output.value = slider.value;

        }
    </script>







		</main>

		<!--************************************
				Main End
		*************************************-->
		<?php include('templates/footer.php');?>

<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
