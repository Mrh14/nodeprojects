<?phpinclude('config.php');$suc ='1';$er='0';$err='';if(isset($_FILES['file']['name'])) {    /* Getting file name */    $filename = $_FILES['file']['name'];    /* Location */    $startdate=strtotime(date('h:i:s'));    $location = "../../images/uploads/" .$startdate. $filename;	$location2 = $startdate. $filename;    $uploadOk = 1;    $imageFileType = pathinfo($location, PATHINFO_EXTENSION);    /* Valid Extensions */    $valid_extensions = array("jpg", "jpeg", "png");    /* Check file extension */    if (!in_array(strtolower($imageFileType), $valid_extensions)) {        $uploadOk = 0;    }    if ($uploadOk == 0) {        echo 0;    } else {        /* Upload file */        if (move_uploaded_file($_FILES['file']['tmp_name'], $location)) {            echo $location2;        } else {            echo 0;        }    }}//procedure enregistrement d'inscription d'une entrepriseif(isset($_POST["datas"])){    $obj = json_decode($_POST["datas"]);    $civilite=trim(strip_tags($obj->civilite));    $email=trim(strip_tags($obj->email));    $pass=md5(trim(strip_tags($obj->pass)));    $nom=trim(strip_tags($obj->nom));    $denom=trim(strip_tags($obj->denom));    $tel=trim(strip_tags($obj->tel));    $ville=trim(strip_tags($obj->ville));    $cp=trim(strip_tags($obj->cp));    $bio=trim(strip_tags($obj->bio));    $adresse=trim(strip_tags($obj->adresse));    $avatar=trim(strip_tags($obj->avatar));    $rcs=trim(strip_tags($obj->rcs));    $nrcs=trim(strip_tags($obj->nrcs));    $siren=trim(strip_tags($obj->siren));    $siret=trim(strip_tags($obj->siret));    $insee=trim(strip_tags($obj->insee));    $nafape=trim(strip_tags($obj->nafape));    $tva=trim(strip_tags($obj->tva));    $jform=trim(strip_tags($obj->jform));						    if($er == '0'){        $req1=$bdd->prepare('insert into entreprise(nom,denomination,email,tel,ville,cp,pass,bio,adresse,avatar,rcs,nrcs,siren,siret,insee,nafape,tva,jform,civilite) values(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)');        $req1->execute(array($nom,$denom,$email,$tel,$ville,$cp,$pass,$bio,$adresse,$avatar,$rcs,$nrcs,$siren,$siret,$insee,$nafape,$tva,$jform,$civilite));    }echo json_encode(array('suc' =>  (string)$suc,'err' =>  (string)$err ,'er' =>  (string)$er  ));}//procedure update mon compte d'une entrepriseif(isset($_POST["dtas"])){    $obj = json_decode($_POST["dtas"]);    $civilite=trim(strip_tags($obj->civilite));    $email=trim(strip_tags($obj->email));    $pass=trim(strip_tags($obj->pass));    $nom=trim(strip_tags($obj->nom));    $denom=trim(strip_tags($obj->denom));    $tel=trim(strip_tags($obj->tel));    $ville=trim(strip_tags($obj->ville));    $cp=trim(strip_tags($obj->cp));    $bio=trim(strip_tags($obj->bio));    $adresse=trim(strip_tags($obj->adresse));    $avatar=trim(strip_tags($obj->avatar));    $rcs=trim(strip_tags($obj->rcs));    $nrcs=trim(strip_tags($obj->nrcs));    $siren=trim(strip_tags($obj->siren));    $siret=trim(strip_tags($obj->siret));    $insee=trim(strip_tags($obj->insee));    $nafape=trim(strip_tags($obj->nafape));    $tva=trim(strip_tags($obj->tva));    $jform=trim(strip_tags($obj->jform));	$req2=$bdd->prepare("select * from entreprise where id = ?");				$req2->execute(array($_COOKIE['iduser']));				while($ar = $req2->fetch()){					$avatar2=$ar['avatar'];}			  if($avatar==''){$avatar = $avatar2;}    if($er == '0'){        if(strlen($pass) =='' ){    $req1=$bdd->prepare('update entreprise set nom=?,denomination=?,email=?,tel=?,ville=?,cp=?,bio=?,adresse=?, avatar=?, rcs=?,nrcs=?,siren=?,siret=?,insee=?,nafape=?,tva=?,jform=?,civilite=? where id=?');            $req1->execute(array($nom,$denom,$email,$tel,$ville,$cp,$bio,$adresse,$avatar,$rcs,$nrcs,$siren,$siret,$insee,$nafape,$tva,$jform,$civilite,$_COOKIE['iduser']));}        else{ $pass= md5($pass);            $req1=$bdd->prepare('update entreprise set nom=?,denomination=?,email=?,tel=?,ville=?,cp=?,pass=?,bio=?,adresse=?, avatar=?, rcs=?,nrcs=?,siren=?,siret=?,insee=?,nafape=?,tva=?,jform=?,civilite=? where id=?');            $req1->execute(array($nom,$denom,$email,$tel,$ville,$cp,$pass,$bio,$adresse,$avatar,$rcs,$nrcs,$siren,$siret,$insee,$nafape,$tva,$jform,$civilite,$_COOKIE['iduser']));}    }echo json_encode(array('suc' =>  (string)$suc,'err' =>  (string)$err ,'er' =>  (string)$er  ));}