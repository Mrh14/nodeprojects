<?php

include('getdatas2.php');


if(isset($_POST['idv'])){
    $obj = json_decode($_POST["idv"]);
    $rdv = $obj->idv;
    $req1=$bdd->prepare('select * from reservations where idconference = ?');
    $req1->execute(array($rdv));
    $nbr = $req1->rowcount();
    $dta = '';
    if(intval($nbr) !=0 ){
        while($ar= $req1->fetch()){
            $dta = $dta . $ar['startrdv']. ' à '. $ar['endrdv']."\n";
        }
    }
    else{
            $dta = 'Aucune réservation a été trouvé';
    }

    echo json_encode(array('suc' =>  (string)$suc,'err' =>  (string)$err ,'er' =>  (string)$er,'dta' =>  $dta  ));
}

//l'evenement de choix de pack
if(isset($_POST['packChange'])){
    $obj = json_decode($_POST["packChange"]);
    $id = $obj->id;
    $rdvtype = $obj->rdvtype;

        $price = getPrice($id,$rdvtype);

    echo json_encode(array('suc' =>  (string)$suc,'err' =>  (string)$err ,'er' =>  (string)$er,'price' =>  $price  ));
}



//l'evenement de choix de typerdv

if(isset($_POST['typerdv'])){
    $obj = json_decode($_POST['typerdv']);
    $typerdv = $obj->typerdv;
    if( $typerdv=='visio') {
        $suc = '1';
        $er = '0';
        $err = '';
        $id = '';
        $rs='';

        //pour sa voir si il'y a un plan active
        $paid = 0;
        $nbpacks = 0;
        $hoursTotal = 0;
        $nbs = 0;$nbhr = 0;
        $newtabx = array(); $packs = array();
        foreach ($results1 as $key => $value) {
            $newtabx[$key] = $value;
            $newtab2 = array();

            foreach ($newtabx[$key] as $key2 => $value2) {
                $newtab2[$key2] = $value2;
            }
            //echo $newtab2['pnom'] . '<br>';
            $expiration = '';$jours = 0;$found = 0;
            $date = date('Y-m-d H:i:s');
            $datenow = date('Y-m-d H:i:s', strtotime($date));

                $nbMois = $newtab2['nbMois']; $nbJours = $newtab2['nbJours'];
                $expiration = date("Y-m-d H:i:s", strtotime("+$nbMois month", strtotime($newtab2['paid_at'])));
                $expiration =date("Y-m-d H:i:s", strtotime("+$nbJours day", strtotime($expiration)));
                if( strtotime($datenow) < strtotime($expiration) ) {$paid=1;$found=1;}
                if($found == 1){array_push($packs,$newtab2['pname']);$nbpacks = $nbpacks + intval($newtab2['nbvisio']); $nbhr = floatval($newtab2['hrvisio']);
                    $expiration = date("Y-m-d H:i:s", strtotime("+1 month", strtotime($newtab2['paid_at'])));}


            if ($found != 0) {
                $req2 = $bdd->prepare('select * from reservations where dateReservation >= ? and dateReservation <= ?   and idc = ? and paid = 1 and typerdv=?');
                $req2->execute(array($newtab2['paid_at'], $expiration, $_COOKIE['iduser'], 'visio'));

                $nbs = intval($req2->rowcount()) + $nbs;
                while ($arv = $req2->fetch()) {

                    $t1 = strtotime($arv['endrdv']);
                    $t2 = strtotime($arv['startrdv']);
                    $diff = $t1 - $t2;
                    $hours = $diff / (60 * 60);
                    $hoursTotal = $hours + $hoursTotal;
                }
            }


        }
        if($nbs >= $nbpacks || $hoursTotal >= $nbhr){$rs='0';}else{$rs='1';}
        echo json_encode(array('suc' => (string)$suc, 'err' => (string)$err, 'er' => (string)$er,'paid' => $paid ,'rs' => $rs));

    }












    else if( $typerdv=='public') {
        $suc = '1';
        $er = '0';
        $err = '';
        $id = '';
        //pour sa voir si il'y a un plan active
        $paid = 0;
        $nbpacks = 0;
        $hoursTotal = 0;
        $nbs = 0;$nbhr = 0;
        $newtabx = array(); $packs = array();
        foreach ($results1 as $key => $value) {
            $newtabx[$key] = $value;
            $newtab2 = array();

            foreach ($newtabx[$key] as $key2 => $value2) {
                $newtab2[$key2] = $value2;
            }
            //echo $newtab2['pnom'] . '<br>';
            $expiration = '';$jours = 0;$found = 0;
            $date = date('Y-m-d H:i:s');
            $datenow = date('Y-m-d H:i:s', strtotime($date));

            $nbMois = $newtab2['nbMois']; $nbJours = $newtab2['nbJours'];
            $expiration = date("Y-m-d H:i:s", strtotime("+$nbMois month", strtotime($newtab2['paid_at'])));
            $expiration =date("Y-m-d H:i:s", strtotime("+$nbJours day", strtotime($expiration)));
            if( strtotime($datenow) < strtotime($expiration) ) {$paid=1;$found=1;}
            if($found == 1){array_push($packs,$newtab2['pname']);$nbpacks = $nbpacks + intval($newtab2['nbvisio']); $nbhr = floatval($newtab2['hrvisio']);
                $expiration = date("Y-m-d H:i:s", strtotime("+1 month", strtotime($newtab2['paid_at'])));}


            if ($found != 0) {
                $req2 = $bdd->prepare('select * from reservations where dateReservation >= ? and dateReservation <= ?   and idc = ? and paid = 1 and typerdv=?');
                $req2->execute(array($newtab2['paid_at'], $expiration, $_COOKIE['iduser'], 'public'));

                $nbs = intval($req2->rowcount()) + $nbs;
                while ($arv = $req2->fetch()) {

                    $t1 = strtotime($arv['endrdv']);
                    $t2 = strtotime($arv['startrdv']);
                    $diff = $t1 - $t2;
                    $hours = $diff / (60 * 60);
                    $hoursTotal = $hours + $hoursTotal;
                }
            }


        }

        if($nbs >= $nbpacks || $hoursTotal >= $nbhr){$rs='0';}else{$rs='1';}
        echo json_encode(array('suc' => (string)$suc, 'err' => (string)$err, 'er' => (string)$er,'paid' => $paid ,'rs' => $rs));
    }








    else if( $typerdv=='domicile') {
        $suc = '1';
        $er = '0';
        $err = '';
        $id = '';
        //pour sa voir si il'y a un plan active
        $paid = 0;
        $nbpacks = 0;
        $hoursTotal = 0;
        $nbs = 0; $nbhr = 0;
        $newtabx = array(); $packs = array();
        foreach ($results1 as $key => $value) {
            $newtabx[$key] = $value;
            $newtab2 = array();

            foreach ($newtabx[$key] as $key2 => $value2) {
                $newtab2[$key2] = $value2;
            }
            //echo $newtab2['pnom'] . '<br>';
            $expiration = '';$jours = 0;$found = 0;
            $date = date('Y-m-d H:i:s');
            $datenow = date('Y-m-d H:i:s', strtotime($date));

            $nbMois = $newtab2['nbMois']; $nbJours = $newtab2['nbJours'];
            $expiration = date("Y-m-d H:i:s", strtotime("+$nbMois month", strtotime($newtab2['paid_at'])));
            $expiration =date("Y-m-d H:i:s", strtotime("+$nbJours day", strtotime($expiration)));
            if( strtotime($datenow) < strtotime($expiration) ) {$paid=1;$found=1;}
            if($found == 1){array_push($packs,$newtab2['pname']);$nbpacks = $nbpacks + intval($newtab2['nbvisio']); $nbhr = floatval($newtab2['hrvisio']);
                $expiration = date("Y-m-d H:i:s", strtotime("+1 month", strtotime($newtab2['paid_at'])));}


            if ($found != 0) {
                $req2 = $bdd->prepare('select * from reservations where dateReservation >= ? and dateReservation <= ?   and idc = ? and paid = 1 and typerdv=?');
                $req2->execute(array($newtab2['paid_at'], $expiration, $_COOKIE['iduser'], 'domicile'));

                $nbs = intval($req2->rowcount()) + $nbs;
                while ($arv = $req2->fetch()) {

                    $t1 = strtotime($arv['endrdv']);
                    $t2 = strtotime($arv['startrdv']);
                    $diff = $t1 - $t2;
                    $hours = $diff / (60 * 60);
                    $hoursTotal = $hours + $hoursTotal;
                }
            }


        }

        if($nbs >= $nbpacks || $hoursTotal >= $nbhr){$rs='0';}else{$rs='1';}
        echo json_encode(array('suc' => (string)$suc, 'err' => (string)$err, 'er' => (string)$er,'paid' => $paid ,'rs' => $rs));
    }


}