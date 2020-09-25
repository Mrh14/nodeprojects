<?php
session_start();

include('templates/header.php');

?>
        <script>
            var idpack=<?php if(isset($_SESSION["idpack"]))
                                { echo "1";}
            else{echo "0";} ?>;
            console.log(idpack);
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
                                            if(idpack=='1'){
                                                document.location.href="payer.php";}
                                            else
                                            {window.location.replace("user/events");}
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
           
			
            function checkinv(champ){var g= 0;
				if($(champ).val().length >= 2){ g= 0; $(champ).removeClass('is-invalid'); $(champ).addClass('is-valid');}
				else{ g= 1; $(champ).removeClass('is-valid'); $(champ).addClass('is-invalid');}
                c.push(g);
				return g;
			}


		   }) ;

        </script>


			
<main id="hb-main" class="hb-main hb-haslayout">
			
			
                  <div class="container-fluid">
                            <!-- end row -->

                            <div class="row w-100 mx-auto ">
                                <div class="col-12 col-md-8 col-lg-8 col-xl-6 mx-auto px-0 mt-5">
                                 <div class="alert alert-danger w-100"  style="display:none;" role="alert" id="jer" >
                                    <h4 class="alert-heading">Erreur:</h4><p>Veuillez corriger les erreurs suivantes:</p> <hr>
                                </div> </div>
							</div>


							<div class="row w-100 mx-auto  mt-5">
                             <div class="col-12 col-md-7 col-lg-7 col-xl-4 mx-auto px-0">
                                    <form id="connexion" action="#" >
                                        <div class="card bg-light" style="border:none;border-radius:9px;min-height:320px;">
                                            <div class="card-header pb-0 text-center bg-primary pt-3"> <h6 class="card-title text-light w-100 px-0 ">Authentification </h6> </div>
                                            <div class="card-body px-4 text-muted " >
                                                <div class="form-group">
                                                    <input type="email" class="form-control" id="email" style="border-radius:7px;background: rgba(0,0,0,.03);border: 1px solid rgba(0,0,0,.125);" placeholder="Entrez votre adresse email">
                                             </div> 
											 <div class="form-group">
                                                    <input type="password" class="form-control mb-0" style="border-radius:7px;background: rgba(0,0,0,.03);border: 1px solid rgba(0,0,0,.125);" id="pass" placeholder="Entrez votre mot de passe">
                                                </div>

                                                <div class="custom-control custom-checkbox d-flex align-items-center"">
                                                    <input type="checkbox" class="custom-control-input w-5" name="fremember" id="customCheck2">
                                                    <label class="custom-control-label" for="customCheck2">Se souvenir de moi?</label>
                                                </div>

                                                <button type="submit" class="btn btn-primary d-block mx-auto mt-3" id="cge">Se connecter</button>
                                            </div> </div>
                                    </form>
                                </div> <!-- end col -->

                      
							
										<!-- form signup -->
								<div class="col-12 col-md-7 col-lg-7 col-xl-7 mx-auto p-0">

							<form action="mission.php" method="get" >

								<div class="card bg-light text-center" style="border:none;border-radius:9px;min-height:320px;">

									<div class="card-header pb-0 "> <h6 class="card-title text-muted w-100 px-0">Pas encore inscrit? </h6> </div>

									<div class="card-body px-4 " >

										<p class="text-muted mb-3  ">Afin d'accedé aux offres proposées par Visio et de contacter le recruteur, vous devez être inscrit.</p>

										<div class="form-group">

											<a href="signup.php" type="submit" class="btn btn-primary">Inscrivez-vous</a>

										</div>

									</div>

								</div>
							</form>
						</div><!-- end col -->

                         
							
							
							
							
							</div> <!-- end row -->

			 </div>

		</main>
		
		<!--************************************
				Main End
		*************************************-->
	<?php include('templates/footer.php');
    session_destroy();?>