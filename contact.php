<?php include('templates/header.php');

include('user/includes/json/getdatas.php');

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
                       if($.cookie('usertype')) {


                           $(this).closest("form").append('<input type="hidden" value="' + amount + '" name="amount" />' +
                               '<input type="hidden" value="' + $.cookie('iduser') + '" name="id_client" />' +
                               '<input type="hidden" value="' + idc + '" name="pack" />');

                           $(this).closest("form").submit();
                       }
                       else{window.location.replace("signup.php?idpack="+idc);

                       }

                });





});

        </script>
	<!--[if lt IE 8]>
		<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
	<![endif]-->



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