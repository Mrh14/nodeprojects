<?php
include('includes/cookie.php');
requis("non","login","login");
include('includes/json/getdatas.php');
if(isset($_COOKIE['usertype']) and $_COOKIE['usertype']!='client'  ){
    if($_COOKIE['usertype']=='user'){

        if($_COOKIE['usertype']=='user'){
            $req2=$bdd->prepare('select * from user_acl where iduser =? and permission = ?');
            $req2->execute(array(intval($_COOKIE['iduser']),'disponibilites'));
            $nbp = $req2->rowCount();
            if(intval($nbp)==0){
                header('location: '.$url.'');
            }
        }
    }

}else if(isset($_COOKIE['usertype']) and $_COOKIE['usertype']=='client'){
    header('location: reservations');
}




//pour sa voir si il'y a un plan active
$paid = 0;
$nbpacks = 0; $hoursTotal = 0; $nbs = 0;$nbhr = 0;
$packs = array();$newtabx= array(); foreach($resultsz1 as $key => $value) {$newtabx[$key] = $value;$newtab2= array();

    foreach ($newtabx[$key] as $key2 => $value2) {
        $newtab2[$key2] = $value2;
    }
    //echo $newtab2['pnom'] . '<br>';
    $expiration ='';$jours = 0;$found = 0;
    $date = date('Y-m-d H:i:s');$datenow = date('Y-m-d H:i:s', strtotime($date));

        $nbMois = $newtab2['nbMois']; $nbJours = $newtab2['nbJours'];
        $expiration = date("Y-m-d H:i:s", strtotime("+$nbMois month", strtotime($newtab2['paid_at'])));
        $expiration =date("Y-m-d H:i:s", strtotime("+$nbJours day", strtotime($expiration)));
        if( strtotime($datenow) < strtotime($expiration) ) {$paid=1;$found=1;}
        if($found == 1){array_push($packs,$newtab2['pname']);$nbpacks = $nbpacks + intval($newtab2['nbvisio']); $nbhr = floatval($newtab2['hrvisio']);
            $expiration = date("Y-m-d H:i:s", strtotime("+1 month", strtotime($newtab2['paid_at'])));}

    //echo $found .'/'.$newtab2['id'].'<br>';
    if($found != 0){  $req2 = $bdd->prepare('select * from reservations where dateReservation >= ? and dateReservation <= ?   and idc = ? and paid = 1 and typerdv=?');
        $req2->execute(array($newtab2['paid_at'],$expiration,$_COOKIE['iduser'],'visio'));

        $nbs = intval($req2->rowcount()) + $nbs;
        while($arv = $req2->fetch()){
            $t1 = strtotime($arv['endrdv']);$t2 = strtotime($arv['startrdv']);
            $diff = $t1 - $t2;$hours = $diff / ( 60 * 60 );$hoursTotal = $hours + $hoursTotal;
        }}


}

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
        <title>VISIO | Les disponibilités</title>
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

        <link href='packages/core/main.css' rel='stylesheet' />
        <link href='packages/daygrid/main.css' rel='stylesheet' />
        <link href='packages/timegrid/main.css' rel='stylesheet' />
        <link href='packages/list/main.css' rel='stylesheet' />
        <link href='packages/bootstrap/main.css' rel='stylesheet' />

        <script src='packages/core/main.js'></script>
        <script src='packages/core/locales/fr-ch.js'></script>
        <script src='packages/core/locales-all.js'></script>
        <script src='packages/interaction/main.js'></script>
        <script src='packages/daygrid/main.js'></script>
        <script src='packages/timegrid/main.js'></script>
        <script src='packages/list/main.js'></script>

    </head>


    <body class="fixed-left">

        <!-- Loader -->
        <div id="preloader"><div id="status"><div class="spinner"></div></div></div>

        <!-- Begin page -->
        <div id="wrapper">


            <script>

                //poster la mission
                $('document').ready(function(){
                    //pour cacher le sidebar
                    if(!$(".enlarged")[0]){$('#wrapper').addClass('enlarged');}
                    if(!$(".fixed-left-void")[0]){ $('body').addClass('fixed-left-void');}
                    var go = 0;var done = 0;var stored= ''; var c = []; var tb = [];



                    function checkinv(champ){var g= 0;
                        if($(champ).val().length >= 2){ g= 0; $(champ).removeClass('is-invalid'); $(champ).addClass('is-valid');}
                        else{ g= 1; $(champ).removeClass('is-valid'); $(champ).addClass('is-invalid');}
                        c.push(g);
                        return g;
                    }


                    /// click pour supprimmer l'intervention

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
                                        window.location.replace("events");
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

                });
            </script>


            <script>$(function() {


                });

                document.addEventListener('DOMContentLoaded', function() {

                    c = []; var derr = 0;

                    $(document).on('click', '#poster', function() {

                        checkinv('#nature');


                        for (i = 0; i < c.length; i++) {
                            if(c[i] != 0){	derr = 1;}
                        }
                        //ajax request start

                        if(derr != 1){
                            //encapsulation de donne on object js
                            var dataPost = {
                                'datedebut' :  $('input[name="start"]').val(),
                                'datefin' :  $('input[name="end"]').val(),
                                'nature' :  $("#nature").val()
                            };
                            var dataContact = JSON.stringify(dataPost);
                            var stdate1 = $('input[name="start"]').data('daterangepicker').startDate.format("YYYY-MM-DDTHH:mm:ss");
                            var stdate2 = $('input[name="end"]').data('daterangepicker').startDate.format("YYYY-MM-DDTHH:mm:ss");

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
                                'idconference' :  obj[0],
                                'typerdv' : $('#rdvtype').val(),
                                'datedebut' :  $('input[name="start2"]').val(),
                                'datefin' :  $('input[name="end2"]').val()
                            };
                            var dataContact = JSON.stringify(dataPost);
                            if(moment($('input[name="end2"]').val()) -moment($('input[name="start2"]').val()) ==0 ){
                              alert('la date ou l\'heure de fin est inférieure à la date ou l\'heure de debut');
                            } else{
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
                                        if(key == 'dta' ){ dta=value;}
                                    });
                                    //cas d'absence d'erreurs de validation de champs ou autres
                                    if(er == '0'){
                                        if(suc=='1'){
                                            $('#exampleModalCenter2').modal('toggle');
                                        }
                                    }
                                    //cas d'erreur de validation de champs ou autres
                                    else{alert(err); }
                                },error: function(data) {console.log(data);}

                            });}}
                        return false;

                    });

                    //listes d'evenements reservés
                     $(document).on('click', '#events', function() {
                        var idv = $(this).data('id');
                         //encapsulation de donne on object js
                         var dataPost = {
                             'idv' : idv
                         };
                         var dataContact = JSON.stringify(dataPost);

                         $.ajax({
                             type:'POST',
                             url:'includes/json/hours.php',
                             data: {idv : dataContact},
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

                                         alert(dta);
                                         //$("#tb3").prepend(dta);
                                     }
                                 }

                                 //cas d'erreur de validation de champs ou autres
                                 else{ alert(err); }
                             },error: function(data) {console.log(data);}

                         });
                     });


                    //typerdv select change event
                    $(document).on('change', '#rdvtype', function() {
                        //encapsulation de donne on object js
                        var dataPost = {
                            'typerdv' :  $("#rdvtype").val()
                        };
                        var dataContact = JSON.stringify(dataPost);
                        //fonction ajax pour le backend
                        $.ajax({
                            type:'POST',
                            url:'includes/json/hours.php',
                            data: {typerdv : dataContact},
                            dataType: 'json',
                            async: false,
                            success:function(data){
                                $.each(data, function(key, value){
                                    if(key == 'suc' ){ suc=value;}
                                    if(key == 'err' ){ err=value;}
                                    if(key == 'er' ){ er=value;}
                                    if(key == 'rs' ){ rs=value;}
                                    if(key == 'paid' ){ paid=value;}
                                });
                                //cas d'absence d'erreurs de validation de champs ou autres
                                if(er == '0'){
                                    if(suc=='1'){
                                        if(paid =='1' ){ $('#msgt').hide();
                                            if(rs =='0' ){ $('#modalfooter').html('<form action="payrdv/charge.php" id="formCharge" name="charge" method="post" ><button type="button" id="poster2" data-id="" class="btn btn-primary waves-effect waves-light mr-5">Payer</button></form>');
                                                if($('#packs').val() !=''){
                                                    //encapsulation de donne on object js
                                                    var dataPost = {'rdvtype' :  $("#rdvtype").val(), 'id' : $("#packs").val()};
                                                    var dataContact = JSON.stringify(dataPost);
                                                    $.ajax({
                                                        type:'POST',
                                                        url:'includes/json/hours.php',
                                                        data: {packChange : dataContact},
                                                        dataType: 'json',
                                                        async: false,
                                                        success:function(data){
                                                            $.each(data, function(key, value){
                                                                if(key == 'suc' ){ suc=value;}if(key == 'err' ){ err=value;}if(key == 'er' ){ er=value;}if(key == 'price' ){ price=value;}
                                                            });
                                                            //cas d'absence d'erreurs de validation de champs ou autres
                                                            if(er == '0'){
                                                                if(suc=='1'){
                                                                    $('#poster2').text('Payer ('+ price +'€)');
                                                                }
                                                            }

                                                            else{ alert(err); }
                                                        },error: function(data) {console.log(data);}
                                                    });
                                                }

                                            }
                                            else if(rs =='1' ){$('#modalfooter').html('<button type="button" id="poster3" class="btn btn-primary waves-effect waves-light" >Réserver</button>');}

                                        }
                                        else{
                                            $('#msgt').show();
                                        }
                                        //$("#tb3").prepend(dta);
                                    }
                                }

                                //cas d'erreur de validation de champs ou autres
                                else{ alert(err); }
                            },error: function(data) {console.log(data);}

                        });

                    });


                    //packs selectbox pour choisir quel pack
                    $(document).on('change', '#packs', function() {
                        if($('#packs').val() !=''){
                            //encapsulation de donne on object js
                            var dataPost = {'rdvtype' :  $("#rdvtype").val(), 'id' : $("#packs").val()};
                            var dataContact = JSON.stringify(dataPost);
                            $.ajax({
                                type:'POST',
                                url:'includes/json/hours.php',
                                data: {packChange : dataContact},
                                dataType: 'json',
                                async: false,
                                success:function(data){
                                    $.each(data, function(key, value){
                                        if(key == 'suc' ){ suc=value;}if(key == 'err' ){ err=value;}if(key == 'er' ){ er=value;}if(key == 'price' ){ price=value;}
                                    });
                                    //cas d'absence d'erreurs de validation de champs ou autres
                                    if(er == '0'){
                                        if(suc=='1'){
                                            $('#poster2').text('Payer ('+ price +'€)');
                                        }
                                    }

                                    else{ alert(err); }
                                },error: function(data) {console.log(data);}
                            });
                        }
                    });



                    //pour payer une reservation
                    $(document).on('click', '#poster2', function() {

                        if($.cookie('usertype')) {     if($('#packs').val() != ''){
                            var idc = $(this).data('id');
                            var typerdv = $('#rdvtype').val();
                            var idpacks = $('#packs').val();
                            var date1 = $('input[name="start2"]').val().replace(' ','');
                            var date2  =$('input[name="end2"]').val().replace(' ','');
                            if(moment($('input[name="end2"]').val()) -moment($('input[name="start2"]').val()) ==0 ){
                                alert('la date ou l\'heure de fin est inférieure à la date ou l\'heure de debut');
                            }else{
                            $(this).closest("form").append('<input type="hidden" value="' + idc + '" name="idconference" />' +
                                '<input type="hidden" value="' + typerdv + '" name="typerdv" />' +
                                '<input type="hidden" value="' + idpacks + '" name="idpacks" />' +
                                '<input type="hidden" value="' + date1 + '" name="dateStart" />' +
                                '<input type="hidden" value="' + date2 + '" name="dateEnd" />');

                            $(this).closest("form").submit();
                            }
                        }
                        else{
                            $('#packs').removeClass('is-invalid');
                            $('#packs').addClass('is-invalid');
                        }
                        }
                        else{alert('Vous devez être inscrit d\'abord');}

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
                            if ($.cookie('usertype') =='admin' || $.cookie('usertype') =='user'){
                               init(arg);$('#exampleModalCenter').modal('toggle');}
                        },

                        eventClick: function(info) {

                            if ($.cookie('usertype') =='client'){
                                obj=[];
                                tb=[];
                                obj.push(info.event.id);
                                var found = verify(info.event.id);

                                //verifier si cet evenement est disponible et n'est pas dejâ réservé
                                if(found[0] != '0'){
                                    alert('vous avez dejà envoyer une demande de reservation');
                                }
                                else{
                                    if(found[1] == '1'){
                                        alert('Pas de Disponibilité');
                                    } else{
                                        $('#poster2').data('id',info.event.id) ;
                                        $('#events').data('id',info.event.id);

                                        getrdvdate(info.event.id);

                                        $('#exampleModalCenter2').modal('toggle');

                                    }


                                }
                            }
                        }





                    });
                    calendar.setOption('locale', 'fr');
                    calendar.setOption('lang', 'fr');
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

                    //initialiser les input de start2 and end2

                    function getrdvdate(arg){
                        var dataPost = {'id':arg}; var dataContact = JSON.stringify(dataPost);
                        $.ajax({
                            type:'POST',
                            url:'includes/json/json.php',
                            data: {getrdvdate : dataContact},
                            dataType: 'json',
                            async: false,
                            success:function(data){
                                $.each(data, function(key, value){
                                    if(key == 'suc' ){ suc=value;}
                                    if(key == 'err' ){ err=value;}
                                    if(key == 'er' ){ er=value;}
                                    if(key == 'date1' ){  date1=value;}if(key == 'date2' ){  date2=value;}
                                });
                                //cas d'absence d'erreurs de validation de champs ou autres
                                if(er == '0'){
                                    if(suc=='1'){
                                    }
                                }
                                else{   }
                            },error: function(data) {console.log(data);}

                        });

                        var date1 = date1.replace(/-/g, "/"); date1 = new Date(date1);
                        var date2 = date2.replace(/-/g, "/");   date2 =  new Date(date2);



                        var ad= date1.getDate();var am= (parseInt(date1.getMonth())+1) ;var stdate =date1.getFullYear();
                        $('input[name="start2"]').daterangepicker({startDate:false,timePicker24Hour:true ,timePicker : true, singleDatePicker : true,locale:{format:'DD/MM/YYYY HH:mm'}, isInvalidDate: function(date1) {	var stdate2 = $('input[name="start2"]').data('daterangepicker').startDate.format("YYYY");
                                var b = moment(ad+"/"+am+"/"+stdate,"DD/MM/YYYY");if(date1 < b || date1 > b){return true;} }});

                        $('input[name="end2"]').daterangepicker({startDate:false,timePicker24Hour:true ,timePicker : true, singleDatePicker : true,locale:{format:'DD/MM/YYYY HH:mm'}, isInvalidDate: function(date2) {	var stdate2 = $('input[name="start2"]').data('daterangepicker').startDate.format("YYYY");
                                var b = moment(ad+"/"+am+"/"+stdate,"DD/MM/YYYY");if(date2 < b || date2 > b){return true;} }});

                        var date1 = ad+"/"+am+"/"+stdate;
                        $('input[name="start2"]').data('daterangepicker').setStartDate(date1);$('input[name="start2"]').data('daterangepicker').setEndDate(date1);
                        $('input[name="end2"]').data('daterangepicker').setStartDate(date1);$('input[name="end2"]').data('daterangepicker').setEndDate(date1);


                    }



                    function verify(id){
                        var ar = '';var ar2='';
                        var dataPost = {'id':id}; var dataContact = JSON.stringify(dataPost);
                        $.ajax({
                            type:'POST',
                            url:'includes/json/json.php',
                            data: {verify : dataContact},
                            dataType: 'json',
                            async: false,
                            success:function(data){
                                $.each(data, function(key, value){
                                    if(key == 'suc' ){ suc=value;}
                                    if(key == 'err' ){ err=value;}
                                    if(key == 'er' ){ er=value;}
                                    if(key == 'dta' ){ ar = value; dta=value;}
                                    if(key == 'fnd' ){ ar2=value; fnd=value;}
                                });
                                //cas d'absence d'erreurs de validation de champs ou autres
                                if(er == '0'){
                                    if(suc=='1'){
                                        //return dta;
                                        //$("#tb3").prepend(dta);
                                    }
                                }
                                else{   }
                            },error: function(data) {console.log(data);}

                        });
                        return [ar,ar2];

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
                        data: {ficheall : {'id':'1'}},
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

                            <!-- Modal admin-->

                            <div class="modal fade" id="exampleModalCenter" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" >
                                <div class="modal-dialog modal-dialog" style="margin-top:40px;" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLongTitle">Créer une Conférence</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>

                                        <div class="modal-body text-center">
                                            <!-- formulaire d'ajout -->
                                            <form action="#" method="post" id="jform">
                                                <div class="form-group row">
                                                       <label class="col-sm-4 col-form-label">Date et Heure De Debut</label>
                                                    <div class="col-sm-8">
                                                            <input type="text" name="start" class="form-control pull-right"  >
                                                    </div>

                                                    <label class="col-sm-4 col-form-label">Date et Heure De Fin</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" name="end" class="form-control pull-right" >
                                                    </div>

                                                    <label class="col-sm-4 col-form-label">NB: </label>
                                                    <div class="col-sm-8">
                                                        <input type="text" name="nature" id="nature" class="form-control pull-right" placeholder="nota bene" >
                                                    </div>


                                                    </div>


                                            </form>

                                        </div>

                                            <div class="modal-footer d-flex justify-content-center px-5">


                                                <button type="button" id="poster" class="btn btn-primary">Créer</button>

                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>


                                            </div>

                                    </div>
                                </div>

                            </div>

                            <!-- Modal utilisateur-->

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
                                                <div class="form-group row d-flex justify-content-center mb-1 px-5" >
                                                    <select name="rdvtype" id="rdvtype" class="form-control">
                                                        <option value="visio">RDV à distance</option>
                                                        <option value="public">RDV dans une place public</option>
                                                        <option value="domicile">RDV à domicile</option>
                                                    </select>
                                                </div>

                                                <div class="form-group row d-flex justify-content-center mb-3 px-5" id="packdiv">
                                                    <select name="packs" id="packs" class="form-control">
                                                        <option value="">Choisir le Pack</option>
                                                     <?php  $newtabx= array(); foreach($packs as $key => $value) {$newtabx[$key] = $value;$newtab2= array();
                                                        foreach ($newtabx[$key] as $key2 => $value2) {
                                                            $newtab2[$key2] = $value2;
                                                        }
                                                        echo '<option value="'.$value.'">'.getPackName($value).'</option>';
                                                     } ?>
                                                    </select>
                                                </div>

                                                    <div class="form-group row d-flex justify-content-center">

                                                        <label class="col-sm-4 col-form-label">Date et Heure De Debut</label>
                                                        <div class="col-sm-8">
                                                            <input type="text" name="start2" class="form-control pull-right"  >
                                                        </div>

                                                        <label class="col-sm-4 col-form-label">Date et Heure De Fin</label>
                                                        <div class="col-sm-8">
                                                            <input type="text" name="end2" class="form-control pull-right" >
                                                        </div>

                                                    <?php  if ($paid == '1'){ if($nbs >= $nbpacks || $hoursTotal >= $nbhr){
                                                        $btn2 = '<form action="payrdv/charge.php" id="chargerdv" name="chargerdv"  method="post" ><button type="button" id="poster2" data-id="55" class="btn btn-primary waves-effect waves-light mr-5">Payer</button></form>'; } else{
                                                        $btn2='<button type="button" id="poster3" class="btn btn-primary waves-effect waves-light mt-2" >Réserver</button>'; } ?>
                                                    <?php } else{ $btn2='';echo '<h3 id="msgt">vous devez Payez pour un pack d\'abord</h3>';}?>
                                                </div>

                                            </form>

                                        </div>
                                        <div class="modal-footer d-flex justify-content-between" >
                                            <button type="button" class="btn btn-warning text-dark" id="events" data-id="0">RDV reservés</button>
                                                <div id="modalfooter">
                                                 <?php echo $btn2; ?>
                                                </div>
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                                        </div>
                                    </div>
                                </div>

                            </div>


                            <div class="row">
                                <!-- Modal success-->

                                <!-- Modal sucess end-->

                                <div class="col-sm-12">
                                    <div class="float-right page-breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="<?=$url ; ?>">Accueil </a></li>
                                            <li class="breadcrumb-item"><a href="events">Disponibilités</a></li>

                                        </ol>
                                    </div>
                                    <h5 class="page-title">Disponibilités</h5>

                                </div>
                            </div>
                            <!-- end row -->
                           <!-- end row -->


                            <div class="row w-100 d-flex  bd-highlight" >
                                <div class="col-12 bd-highlight">
                                    <div class="card m-b-30 overflow-auto">
                                        <div class="card-body">
                                            <?php if($_COOKIE['usertype'] == 'admin' or $_COOKIE['usertype'] == 'user' ){ ?>
                                            <table class="table table-bordered" id="datatable">

                                                <thead>
                                                <tr><th scope="col">#</th><th scope="col">Nota bene</th><th scope="col">Date de debut</th><th scope="col">Date De fin</th><th scope="col">La durée</th><th scope="col">Etat</th><th scope="col">Action</th>
                                                </tr></thead>

                                                <tbody id="tb1">

                                                <?php  $newtabx= array(); foreach($results2 as $key => $value) {$newtabx[$key] = $value;$newtab2= array();
                                                    foreach ($newtabx[$key] as $key2 => $value2) {
                                                        $newtab2[$key2] = $value2;
                                                    }
                                                    $completed = 'disponible'; $idreservation = '';

                                                    $date1 = new DateTime($newtab2['dateStart']);$date2 = new DateTime($newtab2['dateEnd']);
                                                    $diff = $date1->diff($date2);$hours = $diff->i;$diff = $date1->diff($date2);$hours2 = $diff->h;
                                                    $hours = ($hours / 60) + $hours2;

                                                    $hour1 = date('H:i:s', strtotime($newtab2['dateStart']));
                                                    $hour2 = date('H:i:s', strtotime($newtab2['dateEnd']));

                                                    $hr1 = strtotime($hour2) -  strtotime($hour1) ;$trdv = 0;

                                                    //pour compter le total des heures de tous les rdv d'une certaine conference.
                                                    $req2 = $bdd->prepare("select * from reservations where idconference=?");
                                                    $req2->execute(array($newtab2['idr']));
                                                    while ($ar2 = $req2->fetch()) {
                                                        $rhr1 = date('H:i:s', strtotime($ar2['startrdv']));
                                                        $rhr2 = date('H:i:s', strtotime($ar2['endrdv']));
                                                        $trdv =$trdv +  (strtotime($rhr2) -  strtotime($rhr1)) ;
                                                    }
                                                    if($hr1 <= $trdv){$completed = '<a href="reservations.php?idreservation='.$newtab2['idr'].'" title="Consulter la réservation" class="btn btn-link"  data-id="'.$newtab2['idr'].'">Reservé</a>';}

                                                    echo  ' <tr data-id="'.$newtab2['idr'].'"><td scope="row">'.$newtab2['idr'].'</td><td>'.$newtab2['titre'].'</td><td>'.$newtab2['dateStart'].'</td><td>'.$newtabx[$key]['dateEnd'].'</td><td>'.number_format($hours,2).' H</td>';


                                                    // pour l'administrateur
                                                    if($newtab2['paid'] == '0'){$btn= '<form action="#" id="voir" method="post" class="d-flex">'; if($completed == 'disponible'){ $btn .='<a title="supprimer" class="typcn typcn-delete text-danger m-0" style="font-size:25px;" id="dell" data-id="'.$newtab2['idr'].'"></a></form>';}}
                                                    else{$btn = '<form action="#" id="del1" method="post"><a title="voir" class="btn btn-link"  id="voir" data-id="'.$newtab2['idr'].'">Voir la Conférence</a></form>';}

                                                    echo '<td>' .$completed.'</td><td>'.($trdv==0 ? $btn :'').'</td></tr>';
                                                } ?>

                                                </tbody></table> <?php } ?>




                                            <div id='calendar' style="width:90%;margin:auto;margin-top:50px;" ></div>

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
        <style>

           .fc-time {
                color: black;
            }

            .fc-title {
                color: black;
            }
            .fc-row{margin-right:0px;}


            .fc-content{cursor:pointer;}

        </style>

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


        <!-- Plugins Init js -->
        <script src="assets/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
        <script src="assets/pages/form-advanced.js"></script>

        <!-- App js -->
        <script src="assets/js/app.js"></script>

    </body>
</html>