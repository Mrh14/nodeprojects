<?php include('templates/header.php');
include('includes/json/getdatas.php');
 requis("non","login","login");
$tab = "";
if(isset($_COOKIE['ip'] )) {

    $req = $bdd->prepare("select * from rendezvous where idr=?");
    $req->execute(array(intval($_COOKIE['idconference'])));
    while($ar = $req->fetch()){
        $titre = $ar['titre'];
    }

    $diff =( strtotime('Y-m-d H:i:s',$_COOKIE['startrdv']) - strtotime('Y-m-d H:i:s',$_COOKIE['endrdv']) ) / 3600;
    if($_COOKIE['ip'] == $_SERVER['REMOTE_ADDR']) {
        $tab = '<tr><td>' . $_COOKIE['idconference'] . '</td><td>' . $titre . '</td><td>' . $_COOKIE['startrdv'] . '</td>
        <td>' . $_COOKIE['endrdv'] . '</td><td>' . $diff . '</td><td><a href="abonnements">Payer Votre pack</a></td></tr>';
    }
}

?>

		<link href="assets/plugins/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/plugins/datatables/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <!-- Responsive datatable examples -->
        <link href="assets/plugins/datatables/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />

        <script>
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
                                        window.location.replace("reservations.php");
                                        //$("#tb1").val(dta[0].client);  $("#tb1").val(dta[0].client);
                                        // alert(d);
                                    }
                                } else{alert(err);}
                           },error: function(data) {}
                        }); return false;
                    });
					
					
					
					
					   /// redirection vers la conference

                    $(document).on('click', '#voir', function() {
                        var idinter =  $(this).data('id');alert(idinter);
                      
                                        window.location.replace("http://localhost:3000/"+idinter);
                                        //$("#tb1").val(dta[0].client);  $("#tb1").val(dta[0].client);
                                        // alert(d);
                             
                    });
					
					
					

$('#datatable').DataTable({"order" : [[0,"desc"]]});

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

<section class=" p-5 text-white">

<div class="container w-100" >

            <div class="row w-100 d-flex  bd-highlight" >

                                <div class="col-12 bd-highlight">

                                    <div class="card m-b-30">

                                        <div class="card-body overflow-auto">

                                            <table class="table table-bordered" id="datatable">

                                                <thead>

                                                <tr><th scope="col">Numéro de Conférence</th><th scope="col">Titre</th><th scope="col">Date de debut</th><th scope="col">Date De fin</th><th scope="col">La durée</th><th scope="col">Etat</th><th scope="col">Action</th>

                                                </tr></thead>

                                                <tbody id="tb1">

                                                <?php echo $tab;
                                                    $newtabx= array(); foreach($result5 as $key => $value) {$newtabx[$key] = $value;$newtab2= array();

                                                    foreach ($newtabx[$key] as $key2 => $value2) {

                                                        $newtab2[$key2] = $value2;

                                                    }

                                                    $date1 = new DateTime($newtab2['dateStart']);$date2 = new DateTime($newtab2['dateEnd']);

                                                    $diff = $date1->diff($date2);$hours = $diff->i;$diff = $date1->diff($date2);$hours2 = $diff->h;

                                                    $hours = ($hours / 60) + $hours2;

                                                    echo  ' <tr data-id="'.$newtab2['idr'].'"><td scope="row">'.$newtab2['idr'].'</td><td>'.$newtab2['titre'].'</td><td>'.$newtab2['dateStart'].'</td><td>'.$newtabx[$key]['dateEnd'].'</td><td>'.number_format($hours,2).' H</td>';

                                                    if($_COOKIE['usertype']=='client' ){if($newtab2['paid'] == '1'){$btn= '<form action="#" id="voir" method="post"><a title="voir" class="btn btn-primary"  id="voir" data-id="'.$newtabx[$key]['idreservation'].'">Voir la Conférence</a></form>';}
													else{$btn = '<form action="#" id="del1" method="post"><a title="payer" class="btn btn-primary"  id="pay" data-id="'.$newtabx[$key]['idreservation'].'">payer</a><a title="supprimer" class="btn btn-danger"  id="dell" data-id="'.$newtabx[$key]['idreservation'].'">Supprimer</a></form>';} }
													// pour l'administrateur
													else{if($newtab2['paid'] == '0'){$btn= '<form action="#" id="voir" method="post"><a title="accepter" class="btn btn-success"  id="accepter" data-id="'.$newtabx[$key]['idreservation'].'">Accepter</a><a title="supprimer" class="btn btn-danger"  id="dell" data-id="'.$newtabx[$key]['idreservation'].'">Supprimer</a></form>';}
													else{$btn = '<form action="#" id="del1" method="post"><a title="voir" class="btn btn-primary"  id="voir" data-id="'.$newtabx[$key]['idreservation'].'">Voir la Conférence</a></form>';}}

                                                    echo '<td>' .$newtab2['completed'].'</td><td>'.$btn.'</td></tr>';

                                                } ?>

                                                </tbody></table>





                                        </div>

                                    </div>

                                </div></div> <!-- end col -->

</div>

</section>
			
			
			
			
			
			
			
			
			
		</main>
		
		<!--************************************
				Main End
		*************************************-->
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
		<?php include('templates/footer.php');?>
						   <!-- Required datatable js -->

  