<?phpinclude('config.php');$suc ='1';$er='0';$err='';$iduser='';$role='';if(isset($_POST["datas"])){$obj = json_decode($_POST["datas"]);$email=trim(strip_tags($obj->email));$pass=$obj->pass;if(strlen($pass) < 2 ){        $err .= '<p>* Veuillez tapez Votre mot de passe</p><br />';        $er = '1';        $suc = '0';}if((!strstr($email , "@")) || (!strstr($email , "."))){    $err .= '<p>* l\'email entré n\'est pas correct</p><br />';    $er='1';    $suc = '0';}if($er == '0'){    $req1=$bdd->prepare('select * from users where email=? and pass=? ');    $req1->execute(array($email,md5($pass)));    $exist = $req1->rowcount();    while($ar = $req1->fetch()) {$iduser = strval($ar['idCompte']);$role = $ar['role'];}	    if(intval($exist) == 0 ){        $er = '1';        $suc='0';        $err ='Cet utilisateur n\'existe pas dans notre base de donnée';    }    else if(intval($exist) != 0 ){        $er = '0';        $suc = '1';    }}echo json_encode(array('suc' =>  (string)$suc,'err' =>  (string)$err ,'er' =>  (string)$er , 'iduser' =>  (string)$iduser, 'role'  =>  (string)$role ));}?>