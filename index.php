<?php include('templates/header.php');

include('user/includes/json/getdatas.php');
function calluser($idp,$amount){
    if( isset($_GET['usertype']) ){echo '<a href="reserver.php" class="hb-btn changebtn" id="charge" data-price="90" data-id="'.$idp.'" >S\'abonner</a>';}
    else{echo '<a href="reserver.php" class="hb-btn changebtn" id="charge"  data-price="'.$amount.'" data-id="'.$idp.'" >S\'abonner</a>';}
}
?>
        <script>
            $('document').ready(function(){

                var go = 0;var done = 0;var stored= ''; var c = [];
                //envoyer le formulaire de contact
                $(document).on('click', '#poster', function() {

                    $('#jsuc').hide() ;$('#jer').hide() ;

                    //encapsulation de donne on object js

                    var dataPost = {
                        'name' :  $('#name').val(),
                        'email' :  $('#email').val(),
                        'subject' :  $('#subject').val(),
                        'phone' :  $('#phone').val(),
                        'comment' :  $('#comment-message').val()
                    };

                    var dataContact = JSON.stringify(dataPost);  c = []; var derr = 0;
                    if($('#name').val() == '' ){derr = 1; $('#name').addClass('is-invalid');}
                    if($('#email').val() == '' ){derr = 1; $('#email').addClass('is-invalid');}
                    if($('#subject').val() == '' ){derr = 1; $('#subject').addClass('is-invalid');}
                    if($('#phone').val() == '' ){derr = 1; $('#phone').addClass('is-invalid');}
                    if($('#comment-message').val() == '' ){derr = 1; $('#fort').removeClass('d-none');$('#fort').addClass('d-flex');}


                    for (i = 0; i < c.length; i++) {
                        if(c[i] != 0){	derr = 1;}
                    }
                    //ajax request start
                    if(derr != 1){

                        $.ajax({
                            type:'POST',
                            url:'includes/json/contact.php',
                            data: {datas : dataContact},
                            dataType: 'json',
                            async: false,
                            success:function(data){
                                $.each(data, function(key, value){
                                    if(key == 'suc' ){ suc=value;}
                                    if(key == 'err' ){ err=value;}
                                    if(key == 'er' ){ er=value;}
                                    if(key == 'dta' ){ dta=value;}
                                });

                                //cas d'absence d'erreurs de validation de champs ou autres

                                if(er == '0'){

                                    if(suc=='1'){
                                        $('#jsuc').show();
                                        $("#hideit").addClass("d-none");
                                        // $('#tb1').prepend(dta);
                                    }
                                }
                                //cas d'erreur de validation de champs ou autres
                                else{ $('#jer').append(err); $('#jer').show() ;}
                            },error: function(data) {console.log(data);}

                        });}

                    return false;

                });


                //click sur signup
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


                $(document).on('click', '#charge', function() {
                    var idc = $(this).data('id');
                    var amount = $(this).data('price');
                    // $.ajax({
                    //     type:'POST',
                    //     url:'includes/json/json.php',
                    //     data: {datav : dataContact},
                    //     dataType: 'json',
                    //     async: false,
                    //     success:function(data){
                    //         $.each(data, function(key, value){
                    //             if(key == 'suc' ){ suc=value;}if(key == 'err' ){ err=value;}
                    //             if(key == 'er' ){ er=value;}if(key == 'nbr' ){ nbr=value;}
                    //         });
                    //         //cas d'absence d'erreurs de validation de champs ou autres
                    //         if(er == '0'){if(suc=='1'){}}
                    //         //cas d'erreur de validation de champs ou autres
                    //         else{ $('#jer').append(err); $('#jer').show() ;}
                    //     },error: function(data) {console.log(data);}
                    // });

                       if($.cookie('usertype')) {
                           $(this).closest("form").append('<input type="hidden" value="' + amount + '" name="amount" />' +
                               '<input type="hidden" value="' + $.cookie('iduser') + '" name="id_client" />' +
                               '<input type="hidden" value="' + idc + '" name="pack" />'); $(this).closest("form").submit();
                       }
                       else{window.location.replace("reserver.php?idpack="+idc);}

                       //else{window.location.replace("signup.php?idpack="+idc);}

                });





});

        </script>
	<!--[if lt IE 8]>
		<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
	<![endif]-->
    <!--************************************
            Home Slider v3 Start
    *************************************-->
    <div id="hb-homeslider3" style="width:100% !important;padding:0 !important;" class="hb-homeslider owl-carousel owl-theme hb-haslayout" >
        <div class="item" > <div id="bfor"></div>

                <div class="row" >
                    <div class="col-xs-12"  >
                        <div class="hb-slidercontent-area" >
                            <figure class="hb-sliderimg" >
                                <img src="images/slide1.jpg" alt="image description" >
                                <figcaption class="hb-slidercontent" >
                                    <h1 style="z-index:9999;">Beauté & Spa</h1>
                                    <div class="hb-description" style="z-index:9999;">
                                        <p>Nos Spécialistes De Beauté & Spa seront à votre disponibilité.</p>
                                    </div>
                                   <?php if(found() == '') {?> <a href="signup" class="hb-btn">Réserver un Rendez-vous</a><?php } ?>
                                </figcaption>
                            </figure>
                        </div>
                    </div>
                </div>

        </div>
        <div class="item"><div id="bfor"></div>

                <div class="row">
                    <div class="col-xs-12"  >
                        <div class="hb-slidercontent-area">
                            <figure class="hb-sliderimg">
                                <img src="images/slide2.jpg" alt="image description" style="opacity:0.5;" >
                                <figcaption class="hb-slidercontent" >
                                    <h1 style=" z-index:9999;">Sport &amp; Dietologie</h1>
                                    <div class="hb-description" style="z-index:9999;">
                                        <p>Nos Spécialistes De Sport &amp; Dietologie seront à votre disponibilité.</p>
                                    </div>
                                    <?php if(found() == '') {?> <a href="signup" class="hb-btn">Réserver un Rendez-vous</a> <?php  }?>
                                </figcaption>
                            </figure>
                        </div>
                    </div>
                </div>
            </div>

    </div>
    <!--************************************
            Home Slider v3 End
    *************************************-->


    <!--************************************
                Paradise Center Start
    *************************************-->
    <section id="hb-paradisecenter" class="hb-paradisecenter v2 hb-sectionspace hb-haslayout">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-sm-offset-0 col-md-8 col-md-offset-2">
                    <div class="hb-sectionhead mb-5">
                        <div class="hb-sectiontitle">
                            <h2><span>Bienvenue</span>
                                Au Centre Visio
                            </h2>
                        </div>
                        <div class="hb-headcontent">
                            <h2>Vous Allez surement Apprecier Nos services!</h2>
                            <div class="hb-description">
                                <p>Nos Spécialiste De Sport &amp; Dietologie seront à votre disponibilité. est Vous Pouvez bénéficier de Ces 3 Types d'assistances  </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="hb-paradisecenter-area hb-haslayout">
                    <div class="col-xs-12 col-sm-6 col-md-7">
                        <div class="hb-paradisecenterimgbox">
                            <figure class="hb-paradiseimage">
                                <img src="images/team1.jpg" alt="images description">
                            </figure>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-5">
                        <ul class="list-unstyled hb-paradiselist">
                            <li class="hb-paradisecenterbox">
										<span class="hb-paradiseiconbox">
											<i class="ti-heart-broken"></i>
										</span>
                                <div class="hb-paradisecontent">
                                    <h3 class="hb-headingtree">Assistance à distance</h3>
                                    <div class="hb-description">
                                        <p>mettre en place un rendez-vous Audio Visuel avec un de Nos Experts</p>
                                    </div>
                                </div>
                            </li>
                            <li class="hb-paradisecenterbox">
										<span class="hb-paradiseiconbox">
											<i class="ti-user"></i>
										</span>
                                <div class="hb-paradisecontent">
                                    <h3 class="hb-headingtree">Rendez-vous dans une Place Public</h3>
                                    <div class="hb-description">
                                        <p>mettre en place un rendez-vous qui va être deroulé dans un espace public.</p>
                                    </div>
                                </div>
                            </li>
                            <li class="hb-paradisecenterbox">
										<span class="hb-paradiseiconbox">
											<i class="ti-face-smile"></i>
										</span>
                                <div class="hb-paradisecontent">
                                    <h3 class="hb-headingtree">Rendez-vous à Domicile</h3>
                                    <div class="hb-description">
                                        <p>mettre en place un rendez-vous qui va être deroulé dans Votre Domicillation .</p>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>




    <!--************************************
                        Products Start
            *************************************-->
    <section class="hb-products hb-sectionspace hb-bg hb-haslayout ">
        <div class="container">
            <form action="payment/charge.php" id="formCharge" name="charge" method="post" >
            <div class="row">
                <div class=" col-xs-12 col-sm-12 col-sm-offset-0 col-md-8 col-md-offset-2">
                    <div class="hb-sectionhead" >
                        <div class="hb-sectiontitle">
                            <h2><span>Découvrir</span>
                                Nos Packs
                            </h2>
                        </div>
                    </div>
                </div>
                <div id="hb-products" class="hb-productsarea owl-carousel owl-theme hb-haslayout">

                           <?php $newtabx= array(); foreach($resultx as $key => $value) {$newtabx[$key] = $value;$newtab2= array();

                                                    foreach ($newtabx[$key] as $key2 => $value2) {
                                                        $newtab2[$key2] = $value2;
                                                    } ?>
                    <div class="item ">
                        <div class="hb-pricingbox " style="vertical-align: center !important;"  >
                            <figure class="hb-pricing-img" style="position:relative;">
                                <img src="user/assets/upload/<?php echo $newtab2['picture'] ?>" alt="images description" >

                            </figure>
                            <div class="pricingcontent"  style="display:block !important;margin-top:auto !important;height:100% !important;">
                                <h3>
                                    <?php echo $newtab2['packname'] ?>
                                    <span id="spanh3" ><?php echo $newtab2['amount'] ?> €</span>
                                </h3>
                                <ul class="list-unstyled hb-pricinglist" style="display:block !important;margin-top:auto !important;height:100% !important;">
                                    <li><?php echo $newtab2['nbvisio'] ?> visios (1h puis 30mn). <?php echo $newtab2['hrvisio'] ?> h</li>
                                    <li><?php echo $newtab2['nbpublic'] ?> Rdv public (1h puis 30mn). <?php echo $newtab2['hrpublic'] ?> h</li>
                                    <li><?php echo $newtab2['nbdomicile'] ?> Rdv à Domicile (1h puis 30mn). <?php echo $newtab2['hrdomicile'] ?> h</li>
                             <?php
                             $req3=$bdd->prepare('select * from pack_extras where pack_id =?');
                             $req3->execute(array(intval($newtab2['idpack'])));
                                 while($ar3 = $req3->fetch()){
                                    echo '<li class="text-left"> <span class="fas fa-check text-success"></span>'.$ar3['extra'].' </li>';
                                 }
                             ?>
                                </ul>
                                <div class="hb-btnarea" >
                                    <?php calluser($newtab2['idpack'],$newtab2['amount']); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                 <?php } ?>
                </div>
                </form>
            </div>
        </div>
    </section>







    <section id="hb-contactus" class="hb-contactus hb-sectionspace hb-haslayout">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-sm-offset-0 col-md-8 col-md-offset-2">
                    <div class="hb-sectionhead mb-50">
                        <div class="hb-sectiontitle">
                            <h2><span></span>
                                Contactez-Nous
                            </h2>
                        </div>

                    </div>
                </div>
                <div class="hb-contactus-area hb-haslayout">
                    <div class="col-xs-12 col-sm-12">
                        <figure class="hb-contactusmap">
                            <img src="images/contactus-img.jpg" alt="images description">
                        </figure>
                    </div>

                    <div class="hb-contactus-formarea">
                        <div class="col-xs-12">

                        </div>
                        <div class="hb-formtheme hb-contactusform">
                            <div class="alert alert-success w-100" style="margin-left:0px;margin-left:0px;display: none;" role="alert" id="jsuc">
                                <p> Message envoyé avec succés nous vous répondont dans les prochaines délais. </p>
                            </div>
                            <div class="alert alert-danger w-100"  style="display:none;" role="alert" id="jer" >
                                <h4 class="alert-heading">Erreur:</h4>
                                <p>Veuillez corriger les erreurs suivantes:</p>  <hr>
                            </div>

                            <form id="hideit" >
                                <fieldset>
                                    <div class="col-xs-12 col-sm-12 col-md-4">
                                        <div class="form-group">
                                            <input type="text" id="name" class="form-control" name="name" placeholder="Nom complet" required data-error="NEW ERROR MESSAGE">
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-4">
                                        <div class="form-group">
                                            <input type="text" id="email" class="form-control" name="email" placeholder="Email" required data-error="NEW ERROR MESSAGE">
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-4">
                                        <div class="form-group">
                                            <input type="text" id="phone" class="form-control" name="phone" placeholder="téléphone" required data-error="NEW ERROR MESSAGE">
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <input type="text" id="subject" class="form-control" name="subject" placeholder="Titre" required data-error="NEW ERROR MESSAGE">
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12">
                                        <div class="form-group">

                                            <textarea name="message" id="comment-message" class="form-control" ></textarea>
                                            <span class="text-danger d-none" id="fort">Ecrivez un message</span>

                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12">
                                        <div class="form-group">
                                            <button type="submit" class="hb-btn" id="poster" >ENVOYER</button>
                                        </div>
                                    </div>
                                </fieldset>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>





		<!--************************************
				Main End
		*************************************-->
		<?php include('templates/footer.php');?>