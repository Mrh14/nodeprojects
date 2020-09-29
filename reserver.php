<?php
include('includes/config.php');
include('includes/cookie.php');
$idpack=$_GET['idpack'] ?? "";
if(isset($idpack)){
    session_start();
    $_SESSION["idpack"]=$idpack;

}
?>
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
    <title>VISIO | Communauté d'experts</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript" src="javascript/jquery.cookie.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap-theme.min.css" integrity="sha384-6pzBo3FDv/PJ8r2KRkGHifhEocL+1X2rVCTTkUfGk7/0pbek5mMa1upzvWbrUbOZ" crossorigin="anonymous">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>

    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/icomoon.css">
    <link rel="stylesheet" href="css/icofont.css">
    <link rel="stylesheet" href="css/plugins.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="css/color.css">
    <link rel="stylesheet" href="css/responsive.css">
    <script src="js/vendor/modernizr-2.8.3-respond-1.4.2.min.js"></script>

</head>



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
                url:'user/includes/json/loadcalendar.php',
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
                        if(key == 'prevEnable' ){ prevEnable=value;}


                    });

                    document.getElementById('left').style.display= prevEnable ? "block" : 'none';


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
                url:'user/includes/json/loadcalendar.php',
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
                        if(key == 'prevEnable' ){ prevEnable=value;}
                    });
                    document.getElementById('left').style.display= prevEnable ? "block" : 'none';


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
                var datmf = $(this).data('mf');var datmf = datmf.split(" - ");
                var idc = $(this).attr('id');

                var m1 = datmf[0].split("h"); var ma1=m1[1];var h1 = m1[0];
                var m2 = datmf[1].split("h");var ma2=m2[1];var h2 = m2[0];
               var dates = $(this).data('date');var dates = dates.replace(/-/g, "/");
                var date1 = dates+ " "+h1+":"+ma1;var date2 = dates+ " "+h2+":"+ma2;


                var ep = [];
            $.getJSON("https://api.ipify.org/?format=json", function(e) {
                //console.log(e.ip);
                ep.push(e.ip);

            });

            window.setTimeout(function() {

            $.cookie('ip', ep[0], { expires: 1, path: '/' });
            $.cookie('startrdv', date1, { expires: 1, path: '/' });
            $.cookie('endrdv', date2, { expires: 1, path: '/' });
            $.cookie('idconference', idc , { expires: 1, path: '/' }); },1000);





                return false;

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
                    url:'user/includes/json/loadrdv.php',
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
                                            '                                <tbody id="thebod">' + value  +
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
                url:'user/includes/json/reserve.php',
                data: {date1 : date1},
                dataType: 'json',
                async: false,
                success:function(data){
                    $.each(data, function(key, value){
                        if(key == 'suc' ){suc=value;}if(key == 'err' ){err=value;}
                        if(key == 'er' ){er=value;}if(key == 'dta' ){dta=value;}
                        if(key == 'dta2' ){dta2=value;}if(key == 'diff' ){diff=value;}
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
                url:'user/includes/json/json.php',
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
                url:'user/includes/json/json.php',
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
                url:'user/includes/json/hours.php',
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



    });
</script>
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
                            <a href="<?php echo $_COOKIE['usertype'] == 'client' ? 'user/reserver' : 'user/events' ; ?>" class="hb-btn hidden-xs mr-2"><?php echo $_COOKIE['usertype'] == 'client' ? 'Réserver un RDV' : 'ESPACE CLIENT' ; ?></a>


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

                            <!--<div class="hb-cartarea">-->
                            <!--<a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">-->
                            <!--<span class="icon_bag_alt"></span>-->
                            <!--</a>-->
                            <!--<ul class="list-unstyled dropdown-menu hb-cart right">-->
                            <!--<li>-->
                            <!--<figure><img src="images/cart-img01.jpg" alt="image description"></figure>-->
                            <!--<h3><span>$130.00 x 1</span>OIL MASSAGES</h3>-->
                            <!--<button><i class="ti-close"></i></button>-->
                            <!--</li>-->
                            <!--<li>-->
                            <!--<figure><img src="images/cart-img02.jpg" alt="image description"></figure>-->
                            <!--<h3><span>$130.00 x 1</span>OIL MASSAGES</h3>-->
                            <!--<button><i class="ti-close"></i></button>-->
                            <!--</li>-->
                            <!--<li>-->
                            <!--<span class="hb-total">total:<em>$460.00</em></span>-->
                            <!--</li>-->
                            <!--<li>-->
                            <!--<a href="javascript:void(0);" class="hb-btn hb-btn-lg  changehover">VIEW CARD</a>-->
                            <!--<a href="javascript:void(0);" class="hb-btn hb-btn-lg">CHECK OUT</a>-->
                            <!--</li>-->
                            <!--</ul>-->
                            <!--</div>-->
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


    include('user/includes/json/getdatas.php');
    function calluser($idp,$amount){
        if( isset($_GET['usertype']) ){echo '<a href="#" class="hb-btn changebtn" id="charge" data-price="90" data-id="'.$idp.'" >S\'abonner</a>';}
        else{echo '<a href="#" class="hb-btn changebtn" id="charge"  data-price="'.$amount.'" data-id="'.$idp.'" >S\'abonner</a>';}
    }



    ?>






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
        <!-- Modal utilisateur-->



        <section id="hb-services" class="hb-services hb-sectionspace hb-haslayout">
            <div class="container">
                <div class="row d-flex justify-content-center">
                    <div class=" col-xs-12 col-sm-12 col-sm-offset-0 col-md-8 col-md-offset-2 ">
                        <?php
                        function jourfr($jour){
                            $n = '';
                            switch ($jour) {case 'Mon':$n='Lundi';break;
                                case 'Tue':$n ='Mardi';break;
                                case 'Wed':$n='Mercredi';break;
                                case 'Thu':$n ='Jeudi';break;
                                case 'Fri':$n='Vendredi';break;
                                case 'Sat':$n ='Samedi';break;
                                case 'Sun':$n ='Dimanche';break;
                                default: $n='monday';}
                            return $n;
                        }

                        function journb($jour){
                            $n = '';
                            switch ($jour) {case 'Mon':$n=1;break;
                                case 'Tue':$n =2;break;
                                case 'Wed':$n=3;break;
                                case 'Thu':$n =4;break;
                                case 'Fri':$n=5;break;
                                case 'Sat':$n= 6;break;
                                case 'Sun':$n =7;break;
                                default: $n=1;}
                            return $n;
                        }

                        function moisfr($mois){
                            $n = '';
                            switch ($mois) {
                                case 'Jan':$n='Janvier';break;
                                case 'Feb':$n='Février';break;
                                case 'Mar':$n='Mars';break;
                                case 'Apr':$n ='Avril';break;
                                case 'May':$n='Mai';break;
                                case 'Jun':$n ='Juin';break;
                                case 'Jul':$n='Juillet';break;
                                case 'Aug':$n ='Août';break;
                                case 'Sep':$n ='septembre';break;
                                case 'Oct':$n ='Octobre';break;
                                case 'Nov':$n ='Novembre';break;
                                case 'Dec':$n ='Décembre';break;
                                default: $n=$mois;}
                            return $n;
                        }


                        ?>

                        <?php
                        $t = 1;
                        $date= date('m/d/Y');$year= date('Y');$max = intval(date('t', strtotime($date)));
                        $month= date('m', strtotime($date));  $month2= date('M', strtotime($date));  $day= date('D', strtotime($date));

                        $firsday = $month.'/01/'.$year;
                        $ladate = $year.'-'.$month.'-01';
                        $firstdayname =date('D', strtotime($firsday)); ?>

                        <table id="calendar1" class="booked-calendar">
                            <thead>
                            <tr>
                                <th class="row d-flex justify-content-center">

                                    <span id="left" class="fa fa-chevron-circle-left" style="float:left;margin:0px 0 10px 0;padding-left:10px;" ></span>
                                    <span class="month-name" onclick="left()"><?php echo moisfr($month2). ' '. $year;  ?></span>
                                    <span class="fa fa-chevron-circle-right"></span>
                                </th>
                                <script>

                                /*    function left(){ return ;
                                        var d = new Date();
                                        var m = <?php /*echo ($month);*/?>;
                                        var y = <?php /*echo $year;*/?>;
                                        if ((d.getMonth()+1)==m ){
                                            document.getElementById('left').style.display='none';
                                            console.log(m);
                                    }};

                                    $(document).ready(function(){  left() });*/

                                </script>
                            </tr>
                            <tr class="months">
                                <th>Lun</th>
                                <th>Mar</th>
                                <th>Mer</th>
                                <th>Jeu</th>
                                <th>Ven</th>
                                <th>Sam</th>
                                <th>Dim</th>
                            </tr>

                            </thead>

                            <?php
                            $t = 1;
                            $date= date('m/d/Y'); $year= date('Y');$max = intval(date('t', strtotime($date)));
                            $month= date('m', strtotime($date));  $month2= date('M', strtotime($date));  $day= date('D', strtotime($date));

                            $firsday = $month.'/01/'.$year;
                            $ladate = $year.'-'.$month.'-01';
                            $firstdayname =date('D', strtotime($firsday));


                            $nbjour =journb($firstdayname);
                            $start =journb($firstdayname);
                            $j = 0;
                            echo ' <tbody id="ladate" class="'.$ladate.'"> <tr id="t1">';
                            $k=0;for($i=1;$i<=$max;$i++){ if($nbjour > $i ){ $k = $k+1; } }
                            for($i=1;$i<=$max+$k;$i++){
                                if($nbjour > $i ){
                                    $j = $j+1;
                                    echo '<td id="vide" ><span> </span></td>';
                                }
                                else{
                                    if($start == 7){
                                        $ddd = ($i-$j) < 10 ? '0' . ($i-$j)  : ($i-$j) ;
                                        $t++;
                                        echo '<td class="" ><span style="" class="jour" data-date="'.$year.'-'.$month.'-'.$ddd.'" id="j'.$ddd.'">'.($i-$j).'</span></td></tr><tr id="t'.$t.'">';
                                        $start=1;
                                    }
                                    else{
                                        $ddd = ($i-$j) < 10 ? '0' . ($i-$j)  : ($i-$j) ;
                                        echo '<td class="" ><span style="" class="jour" data-date="'.$year.'-'.$month.'-'.$ddd.'" id="j'.$ddd.'">'.($i-$j).'</span></td>';
                                        $start++;
                                    }
                                }
                            }

                            if($start == 7){
                                echo '</tr>';
                            }

                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </main>




    <!--************************************
            Main End
    *************************************-->
    <?php include('templates/footer.php');?>
