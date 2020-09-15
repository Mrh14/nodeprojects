<?php include('templates/header.php'); 
 include('includes/json/getdatas.php');
requis("non","login","login");


//pour sa voir si il'y a un plan active
$paid = 0;
 $newtabx= array(); foreach($results1 as $key => $value) {$newtabx[$key] = $value;$newtab2= array();

    foreach ($newtabx[$key] as $key2 => $value2) {
        $newtab2[$key2] = $value2;
    }
    $date = date('Y-m-d H:i:s');$datenow = date('Y-m-d H:i:s', strtotime($date));

    if(getPack($newtab2['pname']) != '7d'){
        $day1 = date('d',strtotime($newtab2['paid_at']));
        $mois1 = date('m',strtotime($newtab2['paid_at']));
        $year1 = date('Y',strtotime($newtab2['paid_at']));
        $day2 = date('d',strtotime($datenow));
        $mois2 = date('m',strtotime($datenow));
        $year2 = date('Y',strtotime($datenow));

        if($year1 < $year2) {
            print_r("inférieur");
        }else if($year1 == $year2) {

            if(getPack($newtab2['pname']) == '1m'){//echo "<br /><br /> 1111111111111111111111111111111111111111111111";
                if( ($mois2 - $mois1) == 1 and ($day1 >= $day2)) {$paid=1; echo '1mois';}
                else if(($mois2 - $mois1) < 1 ){$paid=1; echo '1mois';}
            }
            if(getPack($newtab2['pname']) == '3m'){
                if(($mois2 - $mois1) == 3 and ($day1 >= $day2 ) ){$paid=1;echo '3 mois';}
                else if(($mois2 - $mois1) < 3 ){$paid=1; echo '6mois';}
            }
            if(getPack($newtab2['pname']) == '6m'){
                if(($mois2 - $mois1) == 6 and ($day1 >= $day2 ) ){$paid=1; echo '6mois';}
                else if(($mois2 - $mois1) < 6 ){$paid=1; echo '6mois';}
            }


        }



        }else{
        $date1 = new DateTime($newtab2['paid_at']);$date2 = new DateTime($datenow);
        $diff = $date1->diff($date2);
        echo $diff->m; echo $diff->d;



         }

//    $date1 = new DateTime($newtab2['dateStart']);$date2 = new DateTime($newtab2['dateEnd']);
//    $diff = $date1->diff($date2);$hours = $diff->i;$diff = $date1->diff($date2);$hours2 = $diff->h;
//    $hours = ($hours / 60) + $hours2;

} ?>
<link href='packages/core/main.css' rel='stylesheet' />
<link href='packages/daygrid/main.css' rel='stylesheet' />
<link href='packages/timegrid/main.css' rel='stylesheet' />
<link href='packages/list/main.css' rel='stylesheet' />
<link href='packages/bootstrap/main.css' rel='stylesheet' />

<script src='packages/core/main.js'></script>
<script src='packages/interaction/main.js'></script>
<script src='packages/daygrid/main.js'></script>
<script src='packages/timegrid/main.js'></script>
<script src='packages/list/main.js'></script>
    

        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />


<script>$(function() {



});
			
  document.addEventListener('DOMContentLoaded', function() {
	  
	   c = []; var derr = 0;



					
	              $(document).on('click', '#poster', function() {


				checkinv('#nature');
				checkinv('#prix');

                for (i = 0; i < c.length; i++) {
                    if(c[i] != 0){	derr = 1;}
                }
                //ajax request start

                if(derr != 1){ 
							//encapsulation de donne on object js
							 var dataPost = {                 
								'datedebut' :  $('input[name="start"]').val(),
								'datefin' :  $('input[name="end"]').val(),
								'nature' :  $("#nature").val(),
								'prix' :  $("#prix").val()
							};
							var dataContact = JSON.stringify(dataPost);  
							//fonction ajax pour le backend
                    $.ajax({
                        type:'POST',
                        url:'includes/json/posterjs.php',
                        data: {fichecreate : dataContact},
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
								
										var stdate1 = $('input[name="start"]').data('daterangepicker').startDate.format("YYYY-MM-DDTHH:mm:ss");
										var stdate2 = $('input[name="end"]').data('daterangepicker').startDate.format("YYYY-MM-DDTHH:mm:ss");
										
										  var myEvent = {id : dta,
										  title: $("#nature").val(),
										  start: stdate1,
										  end: stdate2,
										  constraint: 'businessHours',allDay: false,color: '#00ff00'};
										calendar.addEvent(myEvent);
										
                                    $('#exampleModalCenter').modal('toggle');
                                    //$("#tb3").prepend(dta);
                                }
                            }

                            //cas d'erreur de validation de champs ou autres
                            else{ alert(err); }
                        },error: function(data) {console.log(data);}

                    });}
                return false;

            });



	  
	  //pour joindre la conference 
	       $(document).on('click', '#poster3', function() {


                //ajax request start

                if(obj[0]){ 
							//encapsulation de donne on object js
							 var dataPost = {                 
								'idconference' :  obj[0]
							};
							var dataContact = JSON.stringify(dataPost);  
							//fonction ajax pour le backend
                    $.ajax({
                        type:'POST',
                        url:'includes/json/posterjs.php',
                        data: {conference : dataContact},
                        dataType: 'json',
                        async: false,
                        success:function(data){
                            $.each(data, function(key, value){
                                if(key == 'suc' ){ suc=value;}
                                if(key == 'err' ){ err=value;}
                                if(key == 'er' ){ er=value;}
                            });
                            //cas d'absence d'erreurs de validation de champs ou autres
                            if(er == '0'){
                                if(suc=='1'){
										alert('success'); 
										
                                    $('#exampleModalCenter2').modal('toggle');
                                    //$("#tb3").prepend(dta);
                                }
                            }

                            //cas d'erreur de validation de champs ou autres
                            else{alert(err); }
                        },error: function(data) {console.log(data);}

                    });}
                return false;






            });
	  




	  $(document).on('click','.fc-content',function(){


	  });

	  
    var calendarEl = document.getElementById('calendar');

    var calendar = new FullCalendar.Calendar(calendarEl, {
      plugins: [ 'interaction', 'dayGrid', 'timeGrid', 'list' ],
      header: {
        left: 'prev,next today',
        center: 'title',
        right: 'dayGridMonth,timeGridWeek,timeGridDay,listMonth'
      },
      defaultDate: moment().format("YYYY-MM-DD"),
      navLinks: true, // can click day/week names to navigate views
      businessHours: true, // display business hours
      editable: false,
	  selectable : true,
	  timeFormat: 'h:mm-h:mma ', 
	   displayEventEnd : true,
      events: [
       
      ], dateClick: function(arg) {
		 if ($.cookie('usertype') =='admin'){
         init(arg);$('#exampleModalCenter').modal('toggle');}
      },

  eventClick: function(info) {

	  if ($.cookie('usertype') =='client'){
	obj=[];
			obj.push(info.event.id)		
			$('#exampleModalCenter2').modal('toggle');

		}
  }

  
	  
  

    });

    calendar.render();
	  	 function rday(m,y){return new Date(y, parseInt(m) , 0).getDate();}
                 function init(arg){
					var ad= arg.date.getDate();var am= (parseInt(arg.date.getMonth())+1) ;var stdate =arg.date.getFullYear();
                    $('input[name="start"]').daterangepicker({startDate:false,timePicker24Hour:true ,timePicker : true, singleDatePicker : true,locale:{format:'DD/MM/YYYY HH:mm'}, isInvalidDate: function(date) {	var stdate2 = $('input[name="start"]').data('daterangepicker').startDate.format("YYYY");
                           var b = moment(ad+"/"+am+"/"+stdate,"DD/MM/YYYY");if(date < b || date > b){return true;} }});

                    $('input[name="end"]').daterangepicker({startDate:false,timePicker24Hour:true ,timePicker : true, singleDatePicker : true,locale:{format:'DD/MM/YYYY HH:mm'}, isInvalidDate: function(date) {	var stdate2 = $('input[name="start"]').data('daterangepicker').startDate.format("YYYY");
                            var b = moment(ad+"/"+am+"/"+stdate,"DD/MM/YYYY");if(date < b || date > b){return true;} }});

                    var date1 = ad+"/"+am+"/"+stdate;

                    $('input[name="start"]').data('daterangepicker').setStartDate(date1);$('input[name="start"]').data('daterangepicker').setEndDate(date1);
                    $('input[name="end"]').data('daterangepicker').setStartDate(date1);$('input[name="end"]').data('daterangepicker').setEndDate(date1);
                }

           function checkinv(champ){var g= 0;
                        if($(champ).val().length >= 2){ g= 0; $(champ).removeClass('is-invalid'); $(champ).addClass('is-valid');}
                        else{ g= 1; $(champ).removeClass('is-valid'); $(champ).addClass('is-invalid');}
                        c.push(g);
                        return g;
                    }      
					
		  	    $.ajax({
                        type:'POST',
                        url:'includes/json/json.php',
                        data: {fichecreate : {'id':'1'}},
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

										$.each( dta, function( key, value ) {
											  calendar.addEvent(dta[key]);
											});
										calendar.addEvent();
                                    //$("#tb3").prepend(dta);
                                }
                            }

                            //cas d'erreur de validation de champs ou autres
                            else{ console.log(err); }
                        },error: function(data) {console.log(data);}

                    });
					
					
  });

</script>
	<!--[if lt IE 8]>
		<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
	<![endif]-->

    <!-- Modal ajout-->
<div class="modal fade" id="exampleModalCenter" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" >
    <div class="modal-dialog modal-dialog" style="margin-top:40px;" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Joindre La Conférence</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                <!-- formulaire d'ajout -->
                <form action="#" method="post" id="jform">
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Date D'absence</label>
                        <div class="col-sm-8"> <div class="">
                                <input type="text" name="start" class="form-control pull-right"  >
                                <input type="text" name="end" class="form-control pull-right" >
                                <input type="text" name="nature" id="nature" class="form-control pull-right" >
                                <input type="text" name="prix" id="prix" class="form-control pull-right" >
                            </div>
                        </div>
                    </div>
                    <div class="form-group row d-flex justify-content-center">
                            <button type="button" id="poster" class="btn btn-secondary waves-effect waves-light ">Créér</button>
                    </div>
                </form>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>
</div>



    <div class="modal fade" id="exampleModalCenter2" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" >
        <div class="modal-dialog modal-dialog-centered" style="margin-top:40px;" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Joindre La Conférence</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body text-center">
                      <!-- formulaire d'ajout -->
                    <form action="#" method="post" id="jform">

                        <div class="form-group row d-flex justify-content-center">

                            <?php  if ($paid == '1'){ ?>
                             <button type="button" id="poster2" class="btn btn-secondary waves-effect waves-light mr-5">Payer</button>
							<button type="button" id="poster3" class="btn btn-primary waves-effect waves-light">Réserver</button>
                            <?php } else{ echo '<h3>vous devez Payez pour un pack d\'abord</h3>';}?>
                        </div>
                       
                    </form>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>                  
                </div>
            </div>
        </div>

    </div>


    <!-- Modal ajout end-->
			<!--************************************
						Appointment End
			*************************************-->
			
			
<main id="hb-main" class="hb-main hb-haslayout">



 <div id='calendar' style="width:90%;margin:auto;margin-top:50px;" ></div>
			
			
			
			
			
			
			
			
		</main>
		<style>


.fc-row{margin-right:0px;}

  
  .fc-content{cursor:pointer;}

</style>
		<!--************************************
				Main End
		*************************************-->
		<?php include('templates/footer.php');?>
		    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>

        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>