<?phpinclude('config.php');		$suc ='1';$er='0';$err='';$id ='';$json =[];if(isset($_POST['ficheall'])){    $iduser = $_COOKIE['iduser'];    if($_COOKIE['usertype']=='user'){        $req2=$bdd->prepare('select * from user_acl where iduser =?');        $req2->execute(array(intval($_COOKIE['iduser'])));        while($ar2 = $req2->fetch()){$iduser = $ar2['idadmin'];}    }    $sql = $_COOKIE['usertype'] == 'client' ? 'where ? <> 99999' : 'where idEmetteur = ?';    $req1 = $bdd->prepare("select * from rendezvous $sql");    $req1->execute(array($iduser));    while ($ar = $req1->fetch()) {        $datedebut = date('Y-m-d', strtotime($ar['dateStart']));        $datefin = date('Y-m-d', strtotime($ar['dateEnd']));        $hour1 = date('H:i:s', strtotime($ar['dateStart']));        $hour2 = date('H:i:s', strtotime($ar['dateEnd']));        $hr1 = strtotime($hour2) -  strtotime($hour1) ;        $trdv = 0;        //pour compter le total des heures de tous les rdv d'une certaine conference.        $req2 = $bdd->prepare("select * from reservations where idconference=?");        $req2->execute(array($ar['idr']));        while ($ar2 = $req2->fetch()) {            $rhr1 = date('H:i:s', strtotime($ar2['startrdv']));            $rhr2 = date('H:i:s', strtotime($ar2['endrdv']));            $trdv =$trdv +  (strtotime($rhr2) -  strtotime($rhr1)) ;        }        $result = ['id' => $ar['idr'], 'title' => $ar['titre'],            'start' => $datedebut . 'T' . $hour1,            'end' => $datefin . 'T' . $hour2,            'constraint' => 'businessHours',            'allDay' => false,            'color' => $hr1 <= $trdv ? 'red' : '#00ff00'];        array_push($json, $result);    }//$json  = ['id' => '7','title'=> 'Math',  'start'=> '2020-02-03T13:00:00', 'end'=> '2020-02-03T14:00:00','constraint' => 'businessHours','allDay' => false,'color'=> '#00ff00'];    echo json_encode(array('suc' => (string)$suc, 'err' => (string)$err, 'er' => (string)$er, 'dta' => $json));}if(isset($_POST['verify'])) {    $iduser = $_COOKIE['iduser'];    if($_COOKIE['usertype']=='user'){        $req2=$bdd->prepare('select * from user_acl where iduser =?');        $req2->execute(array(intval($_COOKIE['iduser'])));        while($ar2 = $req2->fetch()){$iduser = $ar2['idadmin'];}    }    $obj = json_decode($_POST['verify']);    $idevent = $obj->id;    $found =0;    $trdv = 0;    $sql = $_COOKIE['usertype'] == 'client' ? 'where ? <> 99999' : 'where idEmetteur = ?';    $req1 = $bdd->prepare("select * from rendezvous $sql and idr=?");    $req1->execute(array($iduser,$idevent));    while ($ar = $req1->fetch()) {        $hour1 = date('H:i:s', strtotime($ar['dateStart']));        $hour2 = date('H:i:s', strtotime($ar['dateEnd']));        $hr1 = strtotime($hour2) -  strtotime($hour1) ;    }    $req2 = $bdd->prepare("select * from reservations where idconference=?");    $req2->execute(array($idevent));    while ($ar2 = $req2->fetch()) {        $rhr1 = date('H:i:s', strtotime($ar2['startrdv']));        $rhr2 = date('H:i:s', strtotime($ar2['endrdv']));        $trdv = $trdv +  (strtotime($rhr2) -  strtotime($rhr1)) ;    }    $fnd = $hr1 <= $trdv ? '1' : '0';    $req1 = $bdd->prepare("select * from reservations where idconference=? and idc=?");    $req1->execute(array($idevent,$iduser));    $nbr2 = $req1->rowcount();    if(intval($nbr2) != 0){$found = 1;}//$json  = ['id' => '7','title'=> 'Math',  'start'=> '2020-02-03T13:00:00', 'end'=> '2020-02-03T14:00:00','constraint' => 'businessHours','allDay' => false,'color'=> '#00ff00'];    echo json_encode(array('suc' => (string)$suc, 'err' => (string)$err, 'er' => (string)$er, 'dta' => $found,'fnd' => $fnd ));}//avoir la date de RDV pour remplir les input start2 et end2if(isset($_POST['getrdvdate'])) {    //$iduser = $_COOKIE['iduser'];    $obj = json_decode($_POST['getrdvdate']);    $idevent = $obj->id;    $found =0;    $req = $bdd->prepare("select * from rendezvous where idr=?");    $req->execute(array($idevent));    $nbr = $req->rowcount();    while($ar = $req->fetch()){        $date1=$ar['dateStart'];        $date2=$ar['dateEnd'];    }//$json  = ['id' => '7','title'=> 'Math',  'start'=> '2020-02-03T13:00:00', 'end'=> '2020-02-03T14:00:00','constraint' => 'businessHours','allDay' => false,'color'=> '#00ff00'];    echo json_encode(array('suc' => (string)$suc, 'err' => (string)$err, 'er' => (string)$er, 'date1' => $date1,'date2' => $date2  ));}//avoir la date de RDV pour remplir les input start2 et end2if(isset($_POST['datav'])) {$suc='1';$er=0;    $ip = $_SERVER['REMOTE_ADDR'];    echo json_encode(array('suc' => (string)$suc, 'err' => (string)$err, 'er' => (string)$er ,'ip' => (string)$ip ));}//avoir la date de RDV pour remplir les input start2 et end2if(isset($_POST['datavw'])) {    if(isset($_COOKIE['iduser'])){        $iduser = $_COOKIE['iduser'];}    $idevent = $obj->id;    $found =0;    $req = $bdd->prepare("select * from paidpack where iduser=?");    $req->execute(array($iduser));    $nbr = $req->rowcount();//$json  = ['id' => '7','title'=> 'Math',  'start'=> '2020-02-03T13:00:00', 'end'=> '2020-02-03T14:00:00','constraint' => 'businessHours','allDay' => false,'color'=> '#00ff00'];    echo json_encode(array('suc' => (string)$suc, 'err' => (string)$err, 'er' => (string)$er ,'nbr' => $nbr ));}