<?php

require_once '../../assets/config/session-verification.php';
require '../../configuration/config.php';
require_once '../../../url.php';

if(isset($_POST['action'])){

    if($_POST['action']=='nombre_avis'){

            $nbravis=countdata("select count(*) from avis where validation='non valide'");
        echo $nbravis;
    }
    elseif($_POST['action']=='nombre_avis_valide'){

        $nbravis=countdata("select count(*) from avis where validation='validé'");
        echo $nbravis;

    }
    elseif($_POST['action']=='nombre_avis_attente'){

        $nbravis=countdata("select count(*) from avis where validation='en attente'");
        echo $nbravis;

    }
    elseif ($_POST['action']=="liste_avis"){


                $data=selectalldata("select * from avis order by date_avis desc");
                foreach ($data as $row):
                    $e=$row->etoiles;

                            ?>
                        <div class="card-box ribbon-box">
                            <div class="ribbon <?php if($row->validation=="en attente"){echo 'ribbon-warning ';}elseif($row->validation=="validé"){echo 'ribbon-success ';}else{echo 'ribbon-danger ';} ?>float-right">
                                <?=$row->validation?>
                            </div>
                            <div class="ribbon-content">
                                <div class="avisbox ">
                                    <div> <?php
                                        for ($i = 1; $i <= $e; $i++) {
                                            echo '<span id="etoileCochee"> </span>';
                                        }

                                        for ($i = $e; $i < 5; $i++) {
                                            echo '<span id="etoileNonCochee"> </span>';
                                        }
                                        ?>
                                    </div>
                                    <div class="flex content_boxavis">
                                        <div class="">
                                            <h3><?=htmlspecialchars($row->visiteur,ENT_QUOTES) ?></h3>
                                            <h5><a href="mailto:<?=$row->email?>"><?=$row->email?></a></h5>
                                            <h6><?=$row->date_avis ?></h6>
                                            <p><?=htmlspecialchars($row->avis,ENT_QUOTES) ?></p>
                                        </div>

                                    </div>
                                    <div class="trait_avis">
                                        <a href="#" style="color: white" onclick="supavis(<?=$row->id?>)" ><i class="fa fa-trash fa-2x"></i></a>
                                        <br>
                                        <?php
                                        if($row->validation=="validé"){?>
                                            <a href="#" class="red" onclick="valideravis(<?=$row->id?>,1)" ><i class="fa fa-times fa-2x"></i></a>
                                        <?php
                                        }elseif($row->validation=="non valide"){
                                            ?>
                                            <a href="#" onclick="valideravis(<?=$row->id?>,0)" class="green" ><i class="fa fa-check fa-2x"></i></a>
                                        <?php
                                        }elseif($row->validation=="en attente") {

                                            ?>
                                            <a href="#" class="green" onclick="valideravis(<?=$row->id?>,0)"><i class="fa fa-check fa-2x"></i></a>
                                            <br>
                                            <a href="#" class="red" onclick="valideravis(<?=$row->id?>,1)"><i class="fa fa-times fa-2x"></i></a>
                                            <?php
                                        }
                                        ?>
                                    </div>


                                </div>
                            </div>
                        </div> <!-- end card-box-->


                            <?php
                            endforeach;



    }
    elseif ($_POST['action']=="validation_avis"){

        $idavis=$_POST['id'];
        $etatavis=$_POST['etat'];

        if($etatavis==0){
            $validation="validé";
        }else{
            $validation="non valide";
        }

        updatedata("update avis set validation=:valid where id=:idavis", array("valid"=>$validation, "idavis"=>$idavis));


    }
    elseif ($_POST['action']=="supprimer_avis"){

        $idavis=$_POST['id'];
        deletedata("delete from avis where  id='$idavis'");

    }
    elseif ($_POST['action']=="liste_avis_etat"){

        $etat_avis=$_POST['etat'];
        $avis=selectalldata("select * from avis where validation='$etat_avis'");
        foreach ($avis as $item):

            $e=$item->etoiles;

            ?>
            <div class="card-box ribbon-box">
                <div class="ribbon <?php if($item->validation=="en attente"){echo 'ribbon-warning ';}elseif($item->validation=="validé"){echo 'ribbon-success ';}else{echo 'ribbon-danger ';} ?>float-right">
                    <?=$item->validation?>
                </div>
                <div class="ribbon-content">
                    <div class="avisbox ">
                        <div> <?php
                            for ($i = 1; $i <= $e; $i++) {
                                echo '<span id="etoileCochee"> </span>';
                            }

                            for ($i = $e; $i < 5; $i++) {
                                echo '<span id="etoileNonCochee"> </span>';
                            }
                            ?>
                        </div>
                        <div class="flex content_boxavis">
                            <div class="">
                                <h3><?=htmlspecialchars($item->visiteur,ENT_QUOTES) ?></h3>
                                <h5><a href="mailto:<?=$item->email?>"><?=$item->email?></a></h5>
                                <h6><?=$item->date_avis ?></h6>
                                <p><?=htmlspecialchars($item->avis,ENT_QUOTES) ?></p>
                            </div>

                        </div>
                        <div class="trait_avis">
                            <a href="#" style="color: white" onclick="supavis(<?=$item->id?>)" ><i class="fa fa-trash fa-2x"></i></a>
                            <br>
                            <?php
                            if($item->validation=="validé"){?>
                                <a href="#" class="red" onclick="valideravis(<?=$item->id?>,1)" ><i class="fa fa-times fa-2x"></i></a>
                                <?php
                            }elseif($item->validation=="non valide"){
                                ?>
                                <a href="#" onclick="valideravis(<?=$item->id?>,0)" class="green" ><i class="fa fa-check fa-2x"></i></a>
                                <?php
                            }elseif($item->validation=="en attente") {

                                ?>
                                <a href="#" class="green" onclick="valideravis(<?=$item->id?>,0)"><i class="fa fa-check fa-2x"></i></a>
                                <br>
                                <a href="#" class="red" onclick="valideravis(<?=$item->id?>,1)"><i class="fa fa-times fa-2x"></i></a>
                                <?php
                            }
                            ?>
                        </div>


                    </div>
                </div>
            </div> <!-- end card-box-->


        <?php
        endforeach;


    }
}

?>
