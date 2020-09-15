<?php
include('includes/cookie.php');
requis("non","login","login");
include('includes/json/getdatas.php');

if(isset($_COOKIE['usertype']) and $_COOKIE['usertype']=='admin'  ){
    header('location: events');

}else if(isset($_COOKIE['usertype']) and $_COOKIE['usertype']=='user'){
    header('location: events');
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
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Paradise | Multipurpose HTML Template</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript" src="javascript/jquery.cookie.js"></script>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap-theme.min.css" integrity="sha384-6pzBo3FDv/PJ8r2KRkGHifhEocL+1X2rVCTTkUfGk7/0pbek5mMa1upzvWbrUbOZ" crossorigin="anonymous">

    <!-- Latest compiled and minified JavaScript -->

    <link rel="stylesheet" href="assets/calendar/css/bootstrap.css">

    <link rel="stylesheet" href="assets/calendar/css/style.css">

    <link rel="stylesheet" href="assets/calendar/css/responsive.css">

    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <link href="assets/css/icons.css" rel="stylesheet" type="text/css">
    <link href="assets/css/style.css" rel="stylesheet" type="text/css">
    <script>
        $(document).ready(function() {
           // $('#exampleModalCenter2').modal('toggle');
            c = []; var derr = 0;
            $(document).on('click','.fa-chevron-circle-right',function(){

                var dataPost = {
                    'date1' : $('#ladate').attr('class'),
                    'operator' : '+'
                };
                var datardv = JSON.stringify(dataPost);
                $.ajax({
                    type:'POST',
                    url:'includes/json/loadcalendar.php',
                    data: {calendar :datardv },
                    dataType: 'json',
                    async: false,
                    success:function(data){
                        $.each(data, function(key, value){
                            if(key == 'suc' ){ suc=value;}
                            if(key == 'err' ){ err=value;}
                            if(key == 'er' ){ er=value;}
                            if(key == 'dta' ){ dta=value;}
                            if(key == 'date1' ){ date1=value;}
                            if(key == 'month1' ){ month1=value;}
                            if(key == 'year1' ){ year1=value;}
                            if(key == 'dta2' ){ dta2=value;}
                        });
                        //cas d'absence d'erreurs de validation de champs ou autres
                        if(er == '0'){
                            if(suc=='1'){


                                //console.log('tableau',dta2);
                                $('.month-name').html(month1 +' ' + year1);
                                $('#ladate').html(dta2);
                                $('#ladate').attr('class', date1);
                                load();
                            }
                        }

                        //cas d'erreur de validation de champs ou autres
                        else{ console.log(err); }
                    },error: function(data) {console.log(data);}

                });

            });
            $(document).on('click','.fa-chevron-circle-left',function(){

                var dataPost = {
                    'date1' : $('#ladate').attr('class'),
                    'operator' : '-'
                };
                var datardv = JSON.stringify(dataPost);
                $.ajax({
                    type:'POST',
                    url:'includes/json/loadcalendar.php',
                    data: {calendar :datardv },
                    dataType: 'json',
                    async: false,
                    success:function(data){
                        $.each(data, function(key, value){
                            if(key == 'suc' ){ suc=value;}
                            if(key == 'err' ){ err=value;}
                            if(key == 'er' ){ er=value;}
                            if(key == 'dta' ){ dta=value;}
                            if(key == 'date1' ){ date1=value;}
                            if(key == 'month1' ){ month1=value;}
                            if(key == 'year1' ){ year1=value;}
                            if(key == 'dta2' ){ dta2=value;}
                        });
                        //cas d'absence d'erreurs de validation de champs ou autres
                        if(er == '0'){
                            if(suc=='1'){


                                // console.log('tableau',dta2);
                                $('.month-name').html(month1 +' ' + year1);
                                $('#ladate').html(dta2);
                                $('#ladate').attr('class', date1);
                                load();

                            }
                        }

                        //cas d'erreur de validation de champs ou autres
                        else{ console.log(err); }
                    },error: function(data) {console.log(data);}

                });
            });
            $(document).on('click','.reserver',function(event){
                event.preventDefault();
                if ($.cookie('usertype') =='client'){
                    obj = [];
                    tb = [];
                    var idr= $(this).attr('id');
                    obj.push(idr);
                    var found = verify(idr);

                    //verifier si cet evenement est disponible et n'est pas dejâ réservé
                    if (found[0] != '0') {
                        alert('vous avez dejà envoyer une demande de reservation');
                    } else {
                        if (found[1] == '1') {
                            alert('Pas de Disponibilité');
                        } else {

                            $('#poster2').data('id', idr);
                            $('#events').data('id', idr);
                            var dhi = $(this).data('h');var dmi = $(this).data('m');

                            if(parseInt($(this).data('h')) < 10){ dhi = '0' + dhi;  }
                            if(parseInt($(this).data('m')) < 10){ dmi = '0' + dmi;  }
                            getrdvdate(idr,dhi,dmi);


                            $('#exampleModalCenter2').modal('toggle');

                        }


                    }
                    return false;}

            });

            $(document).on('click','.jour',function(){
                $('.entry-block').remove();
                var attr = $(this).attr('data-id');
                // alert($(this).closest('tr').attr('id'));
                var theid = $(this).closest('tr').attr('id');
                //alert($(this).attr('data-date'));
                if(typeof attr !== typeof undefined && attr !== false){
                    var dataPost = {
                        'day1':attr,
                        'date1' : $(this).attr('data-date')
                    };
                    var datardv = JSON.stringify(dataPost);
                    $.ajax({
                        type:'POST',
                        url:'includes/json/loadrdv.php',
                        data: {load :datardv },
                        dataType: 'json',
                        async: false,
                        success:function(data){
                            $.each(data, function(key, value){
                                if(key == 'suc' ){ suc=value;}
                                if(key == 'err' ){ err=value;}
                                if(key == 'er' ){ er=value;}
                                if(key == 'dta' ){ dta=value;}
                                if(key == 'dta2' ){ dta2=value;}
                                if(key == 'diff' ){ diff=value;  }
                                if(key == 'found' ){ found=value;  }
                                if(key == 'val' ){ val=value;  }
                                if(key == 'disp' ){ disp=value;  }


                            });
                            //cas d'absence d'erreurs de validation de champs ou autres
                            if(er == '0'){
                                if(suc=='1'){

                                    console.log('ligne2',found);
                                    console.log('ligne3',disp);
                                    console.log('ligne4',dta2);
                                    console.log('ligne2',val);

                                    $.each( dta2, function( key, value ){
                                        if(key == 0){
                                            $('#'+theid).after('<tr class="entry-block" style="display:inline;" ><td>' +
                                                '                            <table>' +
                                                '                                <thead>' +
                                                '                                <th>Les RDV Disponibles</th>' +
                                                '                                </thead>' +
                                                '                                <tbody id="thebod">' + value +
                                                '                                </tbody>' +
                                                '                            </table>' +
                                                '                        </td></tr>');
                                        }



                                        else {
                                            $('#thebod').append( value  );
                                        }
                                    });
                                }
                            }

                            //cas d'erreur de validation de champs ou autres
                            else{ console.log(err); }
                        },error: function(data) {console.log(data);}

                    });



                }
            });
            function load(){
                var ladate = $('#ladate').attr('class');
                //alert(ladate);
                var dataPost = {
                    'ladate':ladate
                };
                var date1 = JSON.stringify(dataPost);
                $.ajax({
                    type:'POST',
                    url:'includes/json/reserve.php',
                    data: {date1 : date1},
                    dataType: 'json',
                    async: false,
                    success:function(data){
                        $.each(data, function(key, value){
                            if(key == 'suc' ){ suc=value;}
                            if(key == 'err' ){ err=value;}
                            if(key == 'er' ){ er=value;}
                            if(key == 'dta' ){ dta=value;}
                            if(key == 'dta2' ){ dta2=value;}
                            if(key == 'diff' ){ diff=value; }
                        });
                        //cas d'absence d'erreurs de validation de champs ou autres
                        if(er == '0'){
                            if(suc=='1'){
                                $.each( dta, function( key, value ){
                                    //console.log('ligne',dta[key]);

                                    $('#j'+dta[key].d).closest('td').addClass('bg-pink');
                                    $('#j'+dta[key].d).closest('span').css('cursor','pointer');
                                    $('#j'+dta[key].d).attr('data-id', dta[key].id);
                                });



                                //$("#tb3").prepend(dta);
                            }
                        }

                        //cas d'erreur de validation de champs ou autres
                        else{ console.log(err); }
                    },error: function(data) {console.log(data);}

                });}
            load();


            //initialiser les input de start2 and end2 apres click
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

            function getrdvdate(arg,dh=null,dm=null){
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
                        var b = moment(ad+"/"+am+"/"+stdate+ " 20:00 ","DD/MM/YYYY HH:mm");if(date1 < b || date1 > b){return true;} }});

                $('input[name="end2"]').daterangepicker({startDate:false,timePicker24Hour:true ,timePicker : true, singleDatePicker : true,locale:{format:'DD/MM/YYYY HH:mm'}, isInvalidDate: function(date2) {	var stdate2 = $('input[name="start2"]').data('daterangepicker').startDate.format("YYYY");
                        var b = moment(ad+"/"+am+"/"+stdate+ " 20:00 ","DD/MM/YYYY HH:mm");if(date2 < b || date2 > b){return true;} }});

                var date1 = ad+"/"+am+"/"+stdate+ " "+dh+":"+dm;

                var date2 = ad+"/"+am+"/"+stdate+ " "+parseInt(parseInt(dh)+1)+":"+dm;
                $('input[name="start2"]').data('daterangepicker').setStartDate(date1);$('input[name="start2"]').data('daterangepicker').setEndDate(date1);
                $('input[name="end2"]').data('daterangepicker').setStartDate(date2);$('input[name="end2"]').data('daterangepicker').setEndDate(date2);


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

                    if(moment($('input[name="start2"]').data('daterangepicker').startDate).toDate() > moment($('input[name="end2"]').data('daterangepicker').startDate).toDate()){
                        alert('la date ou l\'heure de fin est inférieure à la date ou l\'heure de debut');
                    }

                    else if(moment($('input[name="start2"]').data('daterangepicker').startDate).toDate() < moment().toDate()){
                        alert('Veuillez choisir une date superieure à la date actuelle');
                    }

                    else{
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
                                        window.location.replace("reserver");
                                    }
                                }
                                //cas d'erreur de validation de champs ou autres
                                else{alert(err); }
                            },error: function(data) {console.log(data);}

                        });}}
                return false;

            });
        });
    </script>
</head>


    <body class="fixed-left">



    <main id="hb-main" class="hb-main hb-haslayout">
        <!-- Modal utilisateur-->
        <div class="row" style=" display:flex;justify-content:center;padding-bottom:0px;margin-top:100px;">
            <div class="col-sm-12" style="texl-align:center;">
                <div class=" page-breadcrumb" style="display:block;padding-left:40%;margin-bottom:0px;padding-bottom:0px;">
                    <ol class="breadcrumb" style="padding-bottom:0px;margin-bottom:0px;">
                        <li class="breadcrumb-item"><a href="<?=$url ; ?>">Accueil > </a><span style="margin-right:20px;padding-left:10px;"> Réserver un RDV</span></li>

                    </ol>
                </div>
            </div>
        </div>
        <div class="modal fade" id="exampleModalCenter2" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" >
            <div class="modal-dialog modal-dialog-centered" style="margin-top:40px;" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Réserver un RDV</h5>
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

                        <!--    <div class="form-group row d-flex justify-content-center">

                                <label class="col-sm-4 col-form-label">Date et Heure De Debut</label>
                                <div class="col-sm-8">
                                    <input type="text" name="start2" class="form-control pull-right"  >
                                </div>
                            </div>
                            <div class="form-group row d-flex justify-content-center">
                                <label class="col-sm-4 col-form-label">Date et Heure De Fin</label>
                                <div class="col-sm-8">
                                    <input type="text" name="end2" class="form-control pull-right" >
                                </div></div>-->
                                <div class="form-group row d-flex justify-content-center">
                                </div>
                                <?php  if ($paid == '1'){ if($nbs >= $nbpacks || $hoursTotal >= $nbhr){
                                    $btn2 = '<form action="payrdv/charge.php" id="chargerdv" name="chargerdv"  method="post" ><button type="button" id="poster2" data-id="55" class="btn btn-primary waves-effect waves-light mr-5">Payer</button></form>'; } else{
                                    $btn2='<button type="button" id="poster3" class="btn btn-primary waves-effect waves-light mt-2" >Réserver</button>'; } ?>
                                <?php } else{ $btn2='';echo '<h3 id="msgt">Veuillez Payez un pack.</h3>';}?>
                            </div>

                        </form>

                    </div>
                    <div class="modal-footer d-flex justify-content-between" >

                        <div class="col-md-5 col-sm-5 col-5 col-lg-5">
                            <?php echo $btn2; ?>
                        </div>

                        <div class="col-md-5 col-sm-5 col-5 col-lg-5"><button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>  </div>
                    </div>
                </div>
            </div>

        </div>



    </main>

        <!-- Loader -->


        <!-- Begin page -->
        <div id="wrapper">



            <!-- ========== Left Sidebar Start ========== -->
            <div class="left side-menu " style="padding-top:40px;">
                <button type="button" class="button-menu-mobile button-menu-mobile-topbar open-left waves-effect">
                    <i class="ion-close"></i>
                </button>



                <div class="sidebar-inner slimscrollleft">

                    <div id="sidebar-menu">
                        <ul>


                            <li>

                                <?php if(isset($_COOKIE['usertype']) ){ ?>



                                <a href="<?=$_COOKIE['usertype'] == 'client' ? 'reserver' :'events' ; ?>" class="waves-effect">
                                    <i class="dripicons-clock"></i>
                                    <span> <?=$_COOKIE['usertype'] == 'client' ? 'Les' :'Mes' ; ?>  disponibilités <span class="badge badge-success badge-pill float-right"></span></span>
                                </a>

                                <a href="reservations" class="waves-effect">
                                    <i class="dripicons-document"></i>
                                    <span> <?=$_COOKIE['usertype'] == 'client' ? 'Mes' :'Les' ; ?>  réservations<span class="badge badge-success badge-pill float-right"></span></span>
                                </a>

                                <?php if($_COOKIE['usertype'] =='client' ){ ?>
                                    <a href="abonnements" class="waves-effect">
                                        <i class="dripicons-briefcase"></i>
                                        <span>Abonnements<span class="badge badge-success badge-pill float-right"></span></span>
                                    </a>
                                <?php } if($_COOKIE['usertype'] =='admin' ){  ?>
                                    <a href="packs" class="waves-effect">
                                        <span class="fa fa-dropbox pl-1 pr-3"></span>
                                        <span>Mes packs<span class="badge badge-success badge-pill float-right"></span></span>
                                    </a>
                                    <a href="questions" class="waves-effect">
                                        <i class="dripicons-question "></i>
                                        <span>Les questions<span class="badge badge-success badge-pill float-right"></span></span>
                                    </a>
                                    <a href="abonnes" class="waves-effect">
                                        <i class="dripicons-user-group "></i>
                                        <span>Mes abonnés<span class="badge badge-success badge-pill float-right"></span></span>
                                    </a>

                                <?php } if($_COOKIE['usertype'] =='supadmin' ){ ?>
                                <a href="users.php" class="waves-effect">
                                    <i class="dripicons-user-group"></i>
                                    <span>Evénements<span class="badge badge-success badge-pill float-right"></span></span>
                                </a>

                                <a href="restitutions.php" class="waves-effect">
                                    <i class="dripicons-thumbs-up"></i>
                                    <span> ÉTAT DE RESTITUTION <span class="badge badge-success badge-pill float-right"></span></span>
                                </a>
                            </li>

                            <li class="menu-title"><hr> </li>
                            <li class="has_sub">
                                <a href="javascript:void(0);" class="waves-effect"><i class="dripicons-briefcase"></i> <span> Actualités </span> <span class="menu-arrow float-right"><i class="mdi mdi-chevron-right"></i></span></a>
                                <ul class="list-unstyled">
                                    <li><a href="nouvact.php">Nouvelle Actualité</a></li>
                                    <li><a href="actualites.php">Actualités</a></li>
                                    <li><a href="nouvcat.php">Nouvelle Catégorie</a></li>
                                    <li><a href="categories.php">Catégories</a></li>
                                </ul>
                            </li>


                            <?php } } ?>







                        </ul>
                    </div>
                    <div class="clearfix"></div>
                </div> <!-- end sidebarinner -->
            </div>
            <!-- Left Sidebar End -->

            <!-- Start right Content here -->

            <div class="content-page">
                <!-- Start content -->
                <div class="content">

                    <!-- Top Bar Start -->


                    <div class="topbar">

                        <div class="topbar-left	d-none d-lg-block">
                            <div class="text-center">

                                <a href="<?=$url?>" class="logo text-light ">
                                    <img src="assets/icons/logo.png" alt="Finance" data-retina="assets/img/logo1.png" data-width="184" data-height="40" width="184" height="40">
                                </a>
                            </div>
                        </div>

                        <nav class="navbar-custom">

                            <ul class="list-inline float-right mb-0" style="float:right;">

                                <?php if(isset($_COOKIE['email'])){ ?>


                                    <li class="list-inline-item dropdown notification-list" >
                                        <a class="nav-link dropdown-toggle arrow-none waves-effect nav-user" data-toggle="dropdown" href="#" role="button"
                                           aria-haspopup="false" aria-expanded="false">
                                            <img src="assets/images/users/user-1.jpg" alt="user" class="rounded-circle">
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-animated profile-dropdown " >
                                            <a class="dropdown-item" href="../../nodeprojects2/index"><i class="mdi mdi-account-circle m-r-5 text-muted"></i> Accueil Visio</a>
                                            <a class="dropdown-item" href="<?php echo $_COOKIE['usertype'] == 'client' ? 'reserver' : 'events' ; ?>"><span class="badge badge-success mt-1 float-right"></span><i class="mdi mdi-settings m-r-5 text-muted"></i> Disponibilités </a>
                                            <br /><a class="dropdown-item" href="logout"><i class="mdi mdi-logout m-r-5 text-muted"></i> Déconnexion</a>
                                        </div>
                                    </li>

                                <?php } else { ?>

                                    <li class="list-inline-item dropdown notification-list">
                                        <a class="nav-link arrow-none waves-effect nav-user"  href="login.php" role="button"
                                           aria-haspopup="false" aria-expanded="false">
                                            <button class="btn btn-outline-light">Se Connecter</button>
                                        </a>

                                    </li>

                                <?php }  ?>
                            </ul>


                            <ul class="list-inline menu-left mb-0" style="max-height:70px;">
                                <li class="list-inline-item">
                                    <button type="button" class="button-menu-mobile open-left waves-effect">
                                        <i class="ion-navicon"></i>
                                    </button>
                                </li>
                            </ul>

                            <div class="clearfix"></div>

                        </nav>

                    </div>


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


                                                <button type="button" id="poster" class="btn btn-primary">Créér</button>

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



                            <!-- end row -->
                           <!-- end row -->


 <!-- end col -->
            
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




        <script src="assets/js/jquery.slimscroll.js"></script>

        <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>

    <script src="assets/js/fastclick.js"></script>




        <!-- App js -->
        <script src="assets/js/app.js"></script>




    </body>
</html>