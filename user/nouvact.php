<?php  include('includes/json/cgetdatas.php');

include('includes/cookie.php');
requisadmin('non','','login.php');


$ed=0;$vcontenu='';$vslug='';$hiden='';$vcat='';$vtitre='';$vallfiles='';$dfile='';
if(isset($_GET['edit']) and $_GET['edit']!='' ){$ed = 1;
    $edit = intval($_GET['edit']);
//liste des categories
    $reqz=$bdd->prepare('select * from actualites where idf=?');
    $reqz->execute(array($edit));$resultz3 = $reqz->fetchAll(\PDO::FETCH_ASSOC);
///
    $newtabx = array();foreach ($resultz3 as $key => $value) {$newtabx[$key] = $value;$newtab2 = array();

        foreach ($newtabx[$key] as $key2 => $value2) {
            $newtab2[$key2] = $value2;
        }
        $hiden ='<input type="hidden" id="idf" value="'.$newtab2['idf'].'" />';

        $vslug = $newtab2['slug'];
        $vtitre = $newtab2['atitre'];
        $vcat = $newtab2['cat'];
        $vcontenu = $newtab2['contenu'];
        $vallfiles = explode('/', $newtab2['allfiles']); $vallfiles = $vallfiles[1];
        $dfile ='<input type="hidden" id="dfile" value="assets/upload/'.$vallfiles.'" />';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <title>Digitaldata - nouvelle Actualité</title>
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
    Dropzone.autoDiscover = false;
    //poster la mission
    $('document').ready(function(){


        var imgtab = [];var berr =[];berr[0]=0;
        upfile();


        //// ajouter la formation
        $(document).on('click', '#poster', function() {
            //spinner loading start
            //end spinner loading
            $('#jsuc').hide() ;$('#jer').hide() ;
            //encapsulation de donne on object js
            var dataPost = {
                'titre' :  $("#titre").val(),
                'slug' :  $("#slug").val(),
                'contenu' :  tinyMCE.editors[$('#contenu').attr('id')].getContent(),
                'categorie' :  $("#formateur").val()
            };

            var dataContact = JSON.stringify(dataPost);   c = [];

            if($('#formateur').val() == '' ){derr = 1; $('#formateur').removeClass('is-valid');$('#formateur').addClass('is-invalid');}
            else{derr = 0; $('#formateur').addClass('is-valid');$('#formateur').removeClass('is-invalid');}checkinv('#titre');checkinv('#slug');


            if(tinyMCE.get('contenu').getContent()== '' ){$('<span class="error">Ecrivez le contenu de l\'actualité</span><br />').insertAfter($(tinyMCE.get('contenu').getContainer()));}


            for (i = 0; i < c.length; i++) {
                if(c[i] != 0){	derr = 1;}
            }
            //ajax request start
            if(derr != 1){

                if(berr[0] == 0){}
                else{  if(imgtab.length == 0){}
               else if(imgtab.length != 0){
                $.ajax({
                    type:'POST',
                    url:'includes/json/fposterjs.php',
                    data: {dtas : dataContact,tab1 : imgtab},
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
                });}}}
            return false;

        });





        //// modifier la formation
        $(document).on('click', '#poster2', function() {
            //spinner loading start
            //end spinner loading
            $('#jsuc').hide() ;$('#jer').hide() ;
            //encapsulation de donne on object js
            var dataPost = {
                'titre' :  $("#titre").val(),
                'idf' :  $("#idf").val(),
                'slug' :  $("#slug").val(),
                'contenu' :  tinyMCE.editors[$('#contenu').attr('id')].getContent(),
                'categorie' :  $("#formateur").val()
            };

            var dataContact = JSON.stringify(dataPost);   c = [];

            if($('#formateur').val() == '' ){derr = 1; $('#formateur').removeClass('is-valid');$('#formateur').addClass('is-invalid');}
            else{derr = 0; $('#formateur').addClass('is-valid');$('#formateur').removeClass('is-invalid');}checkinv('#titre');checkinv('#slug');


            if(tinyMCE.get('contenu').getContent()== '' ){$('<span class="error">Ecrivez le contenu de l\'actualité</span><br />').insertAfter($(tinyMCE.get('contenu').getContainer()));}


            for (i = 0; i < c.length; i++) {
                if(c[i] != 0){	derr = 1;}
            }
            //ajax request start
            if(derr != 1){
                    if(imgtab.length == 0 ){imgtab= [""];}
                    $.ajax({
                        type:'POST',
                        url:'includes/json/fposterjs.php',
                        data: {dtas2 : dataContact,tab1 : imgtab},
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

            //Dropzone class
            //upload les fichiers de la formation
        function upfile(){        var myDropzone = new Dropzone(".dropzone", {
            url: "includes/json/uploadfiles.php",
            paramName: "file",
            maxFilesize: 2,
            addRemoveLinks: true,
            maxFiles: 10,
            acceptedFiles: "image/*",
            init: function() {
                this.on("success", function(file,response) {
                    var obj = jQuery.parseJSON( response );
                    $.each(obj, function(key, value){
                        berr[0] = 1;
                        imgtab.push(value);
                    });
                });
                this.on("error", function(file, response) {
                    // do stuff here.
                    berr[0] =1;
                    alert(response);

                });
                this.on("removedfile", function (file) {
                    // do stuff here.
                    imgtab = [];

                });

            }
        });



        }



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
                                    <li class="breadcrumb-item"><a href="#">Actualités</a></li>
                                    <li class="breadcrumb-item active">Nouvelle Actualité</li>
                                </ol>
                            </div>
                            <h5 class="page-title">Nouvelle Actualités</h5>
                        </div>
                    </div>
                    <!-- end row -->

                    <div class="row" >
                        <div class="col-12">
                            <div class="card m-b-30">
                                <div class="card-body" >
                                    <div class="alert alert-success w-100" style="margin-left:0px;margin-left:0px;display:none;" role="alert" id="jsuc">
                                        <p>cette Actualité a été <?= $ed==0? 'Ajouté':'Modifié' ;?> avec succés. </p>
                                    </div>
                                    <div class="alert alert-danger w-100"  style="display:none;" role="alert" id="jer" >
                                        <h4 class="alert-heading">Erreur:</h4>
                                        <p>Veuillez corriger les erreurs suivantes:</p>
                                        <hr>
                                    </div>

                                    <div class="m-b-30" id="fort">
                                        <form action="#" class="dropzone">

                                            <?=$hiden;?>
                                            <h4 class="mt-0 header-title">Titre de l'actualités</h4>
                                            <input type="text" class="form-control" name="titre" id="titre" placeholder="Titre de l'actualité" value="<?=$vtitre;?>" />


                                            <br>
                                            <h4 class="mt-0 header-title">Slug l'actualités</h4>
                                            <input type="text" class="form-control" name="slug" id="slug" placeholder="slug de l'actualité" value="<?=$vslug;?>">


                                            <br>
                                            <h4 class="mt-0 header-title">Le Contenu</h4>
                                            <textarea id="contenu" name="contenu" placeholder="Contenu de l'actualité "  ><?=$vcontenu;?></textarea>

                                            <br>
                                            <h4 class="mt-0 header-title">Categorie</h4>
                                            <select name="formateur" id="formateur" class="form-control">
                                                <option value="">choisir la categorie</option>
                                                <?php $newtabx= array(); foreach($resultzz as $key => $value) {$newtabx[$key] = $value;$newtab2= array();
                                                    foreach ($newtabx[$key] as $key2 => $value2) {
                                                        $newtab2[$key2] = $value2;
                                                    }
                                                    if($newtab2['idcat'] == intval($vcat)){$selected='selected';}
                                                    echo ' <option  value="'.$newtab2['idcat'].'" '.$selected.' >'.utf8_encode($newtab2['nomcategorie']) .'</option>' ;
                                                } ?>
                                            </select>
                                            <?=$dfile;?>
                                            <br>
                                            <div class="dropzone" style="min-height:100px;">
                                                <div class="fallback">

                                                    <input name="file" type="file" multiple="multiple" id="file">
                                                </div>
                                            </div>

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
<script src="assets/plugins/tinymce/tinymce.min.js"></script>


<!-- App js -->
<script src="assets/js/app.js"></script>
<script>
    $(document).ready(function () {


        if($("#contenu").length > 0){
            tinymce.init({
                selector: "textarea#contenu",
                theme: "modern",
                height:200,
                plugins: [
                    "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
                    "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
                    "save table contextmenu directionality emoticons template paste textcolor"
                ],
                toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | l      ink image | print preview media fullpage | forecolor backcolor emoticons",
                style_formats: [
                    {title: 'Bold text', inline: 'b'},
                    {title: 'Red text', inline: 'span', styles: {color: '#ff0000'}},
                    {title: 'Red header', block: 'h1', styles: {color: '#ff0000'}},
                    {title: 'Example 1', inline: 'span', classes: 'example1'},
                    {title: 'Example 2', inline: 'span', classes: 'example2'},
                    {title: 'Table styles'},
                    {title: 'Table row 1', selector: 'tr', classes: 'tablerow1'}
                ]
            });
        }






    });
</script>



</body>
</html>