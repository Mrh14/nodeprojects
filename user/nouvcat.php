<?php  include('includes/json/cgetdatas.php');
include('includes/cookie.php');
requisadmin('non','','login.php');
$ed=0;$vnomcat='';$vslug='';$hiden='';
if(isset($_GET['edit']) and $_GET['edit']!='' ){$ed = 1;
    $edit = intval($_GET['edit']);
//liste des categories
    $reqz=$bdd->prepare('select * from categories where id_cat=?');
    $reqz->execute(array($edit));$resultz3 = $reqz->fetchAll(\PDO::FETCH_ASSOC);
///

        $newtabx = array();foreach ($resultz3 as $key => $value) {$newtabx[$key] = $value;$newtab2 = array();

            foreach ($newtabx[$key] as $key2 => $value2) {
                $newtab2[$key2] = $value2;
            }
            $hiden ='<input type="hidden" id="idcat" value="'.$newtab2['id_cat'].'" />';
            $vslug = $newtab2['slug'];
            $vnomcat = $newtab2['categorie'];
        }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <title>Digitaldata - nouvelle Categorie</title>
    <meta content="Admin Dashboard" name="description" />
    <meta content="ThemeDesign" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <script src="assets/js/jquery.min.js"></script>
    <link rel="shortcut icon" href="assets/images/favicon.ico">

    <!-- Dropzone css -->
    <link href="assets/plugins/dropzone/dist/dropzone.css" rel="stylesheet" type="text/css">

    <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="assets/css/icons.css" rel="stylesheet" type="text/css">
    <link href="assets/css/style.css" rel="stylesheet" type="text/css">
    <!-- Dropzone js -->
    <script src="assets/plugins/dropzone/dist/dropzone.js"></script>

</head>


<body class="fixed-left">
<script>

    //poster la mission
    $('document').ready(function(){


        var imgtab = [];var berr =[];berr[0]=0;



        //// ajouter la formation
        $(document).on('click', '#poster', function() {
            //spinner loading start
            //end spinner loading
            $('#jsuc').hide() ;$('#jer').hide() ;
            //encapsulation de donne on object js
            var dataPost = {
                'slug' :  $("#slug").val(),
                'contenu' :  $("#contenu").val()
            };

            var dataContact = JSON.stringify(dataPost);   c = [];

            checkinv('#slug');checkinv('#contenu');


            if($("#contenu").val()== '' ){}

            var derr = 0;
            for (i = 0; i < c.length; i++) {
                if(c[i] != 0){	derr = 1;}
            }
            //ajax request start
            if(derr != 1){



                $.ajax({
                    type:'POST',
                    url:'includes/json/fposterjs.php',
                    data: {dtavs : dataContact},
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

                                $('#jsuc').show(); $('#jform').hide();
                                $('#fort').removeClass('d-block'); $('#fort').removeClass('d-inline'); $('#fort').removeClass('d-flex');$('#fort').addClass('d-none');
                                //$('#datatable').append(dta);
                            }
                        }
                        //cas d'erreur de validation de champs ou autres
                        else{ $('#jer').append(err); $('#jer').show() ;}
                    },error: function(data) {console.log(data);}
                });}
            return false;

        });



        //// ajouter la formation
        $(document).on('click', '#poster2', function() {
            //spinner loading start
            //end spinner loading
            $('#jsuc').hide() ;$('#jer').hide() ;
            //encapsulation de donne on object js
            var dataPost = {
                'slug' :  $("#slug").val(),
                'idcat' :  $("#idcat").val(),
                'contenu' : $("#contenu").val()
            };

            var dataContact = JSON.stringify(dataPost);   c = [];

            checkinv('#slug');  checkinv('#contenu');


            if($("#contenu").val()== '' ){}

            var derr = 0;
            for (i = 0; i < c.length; i++) {
                if(c[i] != 0){	derr = 1;}
            }
            //ajax request start
            if(derr != 1){



                $.ajax({
                    type:'POST',
                    url:'includes/json/fposterjs.php',
                    data: {dtavs2 : dataContact},
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

                                $('#jsuc').show(); $('#jform').hide();
                                $('#fort').removeClass('d-block'); $('#fort').removeClass('d-inline'); $('#fort').removeClass('d-flex');$('#fort').addClass('d-none');
                                //$('#datatable').append(dta);
                            }
                        }
                        //cas d'erreur de validation de champs ou autres
                        else{ $('#jer').append(err); $('#jer').show() ;}
                    },error: function(data) {console.log(data);}
                });}
            return false;

        });


        $(document).on('click', '#cg', function() {
            console.log(imgtab);


        });



        //formation de validation des champs
        function checkinv(champ){var g= 0;
            if($(champ).val().length >= 2){ g= 0; $(champ).removeClass('is-invalid'); $(champ).addClass('is-valid');}
            else{ g= 1; $(champ).removeClass('is-valid'); $(champ).addClass('is-invalid');}
            c.push(g);
            return g;
        }


    });
</script>

<script>
    //Disabling autoDiscover



</script>

<!-- Loader -->
<div id="preloader"><div id="status"><div class="spinner"></div></div></div>

<!-- Begin page -->
<div id="wrapper">


    <?php  include('includes/sidebar.php'); ?>
    <!-- Start right Content here -->

    <div class="content-page">
        <!-- Start content -->
        <div class="content">

            <!-- Top Bar Start -->
            <?php  include('includes/topbar.php'); ?>

            <!-- Top Bar End -->

            <div class="page-content-wrapper"  >

                <div class="container-fluid">

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="float-right page-breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="Categories">Categories</a></li>
                                    <li class="breadcrumb-item active">Nouvelle Categorie</li>
                                </ol>
                            </div>
                            <h5 class="page-title">Nouvelle Categorie</h5>
                        </div>
                    </div>
                    <!-- end row -->

                    <div class="row" >
                        <div class="col-12">
                            <div class="card m-b-30">
                                <div class="card-body" >
                                    <div class="alert alert-success w-100" style="margin-left:0px;margin-left:0px;display:none;" role="alert" id="jsuc">
                                        <p>cette Categorie a été <?= $ed==0? 'Ajouté':'Modifié' ;?> avec succés. </p>
                                    </div>
                                    <div class="alert alert-danger w-100"  style="display:none;" role="alert" id="jer" >
                                        <h4 class="alert-heading">Erreur:</h4>
                                        <p>Veuillez corriger les erreurs suivantes:</p>
                                        <hr>
                                    </div>

                                    <div class="m-b-30" id="fort">
                                        <form action="#" >

                                            <?=$hiden;?>
                                            <h4 class="mt-0 header-title">Slug de la catégorie</h4>
                                            <input type="text" class="form-control" name="slug" id="slug" value="<?=$vslug;?>" placeholder="slug de la Categorie">


                                            <br>
                                            <h4 class="mt-0 header-title">Nom de la Categorie</h4>
                                            <input type="text" id="contenu" class="form-control" name="contenu" placeholder="Nom de la catégorie" value="<?=$vnomcat;?>" />

                                            <br>


                                        </form>
                                        <div class="text-center m-t-15">
                                            <button type="button" id="<?= $ed==0? 'poster':'poster2' ;?>" class="btn btn-primary waves-effect waves-light"><?= $ed==0? 'Ajouter':'Sauvegarder' ;?></button>


                                        </div>

                                    </div>


                                </div>
                            </div>
                        </div> <!-- end col -->
                    </div> <!-- end row -->

                </div><!-- container fluid -->

            </div> <!-- Page content Wrapper -->

        </div> <!-- content -->

        <?php  include('includes/footer.php'); ?>
    </div>
    <!-- End Right content here -->

</div>
<!-- END wrapper -->



<script src="assets/js/bootstrap.bundle.min.js"></script>
<script src="assets/js/modernizr.min.js"></script>
<script src="assets/js/detect.js"></script>
<script src="assets/js/fastclick.js"></script>
<script src="assets/js/jquery.slimscroll.js"></script>
<script src="assets/js/jquery.blockUI.js"></script>
<script src="assets/js/waves.js"></script>
<script src="assets/js/jquery.nicescroll.js"></script>
<script src="assets/js/jquery.scrollTo.min.js"></script>

<!--Wysiwig js-->



<!-- App js -->
<script src="assets/js/app.js"></script>
<script>
    $(document).ready(function () {




    });
</script>



</body>
</html>